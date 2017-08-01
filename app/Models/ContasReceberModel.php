<?php
namespace App\Models;

use App\AppTable;

class ContasReceberModel extends AppTable {

	public $table = 'contas_receber';

	protected $fields = [
		'parent_id' => false,
		'numero_titulo' => true,
		'cliente_id' => true,
		'vencimento' => true,
		'valor' => true,
		'valor_final' => true,
		'recorrente' => true,
		'recorrente_data_final' => false
	];

	public function getAll()
	{
		$res = $this->db
			->query('SELECT * FROM contas_receber');

		return $res;
	}

	public function getDescontos()
	{
		$res = $this->db
			->query('SELECT * FROM contas_receber_descontos WHERE conta_receber_id = ' . $this->id);

		return $res;
	}

	public function custom($node)
	{
		$data = [];

		$vencimentoReadable = $this->data['vencimento'];
		if (! is_null($vencimentoReadable)) {
			$vencimentoReadable = \DateTime::createFromFormat(DATE_FORMAT_DB, $this->data['vencimento'])
                ->format(DATE_FORMAT_READABLE);
		}

		$recorrenteDataFinal = $this->data['recorrente_data_final'];
		if (! is_null($recorrenteDataFinal) && ! empty($recorrenteDataFinal)) {
			$recorrenteDataFinal = \DateTime::createFromFormat(DATE_FORMAT_DB, $this->data['recorrente_data_final'])
                ->format('d/m/Y');
		}

		$data['recorrente_data_final'] = $recorrenteDataFinal;
		$data['vencimento'] = $vencimentoReadable;
		$data['valor'] = formatNumber($this->data['valor']);
		$data['valor_final'] = formatNumber($this->data['valor_final']);

		return $data[$node];
	}

	protected function beforeMarshal()
	{
		// campo vencimento
		$vencimento = $this->getField('vencimento');
		$novoVencimento = \DateTime::createFromFormat(DATE_FORMAT_READABLE, $vencimento)->format(DATE_FORMAT_DB);
		$this->setField('vencimento', $novoVencimento);

		$vencimentoRecorrente = $this->getField('recorrente_data_final');

		if (! is_null($vencimentoRecorrente) && ! empty($vencimentoRecorrente)) {
			$novoVencimentoRecorrente = \DateTime::createFromFormat('d/m/Y', $vencimentoRecorrente)->format(DATE_FORMAT_DB);
			$this->setField('recorrente_data_final', $novoVencimentoRecorrente);
		} else {
			$this->setField('recorrente_data_final', null);
		}

		$valor = $this->getField('valor');
		$this->setField('valor', formatNumberToDb($valor));
		$valorFinal = $this->getField('valor_final');
		$this->setField('valor_final', formatNumberToDb($valorFinal));

	}

	protected function beforeValidate()
	{
		if ($this->data['valor'] > LIMITE_CONTAS) {
			$this->setError('valor', 'Não é possível lançar conta com valor superior a ' . formatNumber(LIMITE_CONTAS));
		}
		if ($this->data['valor_final'] < 0) {
			$this->setError('valor final', 'Defina um desconto inferior ao valor');
		}
		if ($this->data['recorrente'] == true) {
			if (empty($this->data['recorrente_data_final'])) {
				$this->setError('recorrente', 'Determine uma data final para o lançamento recorrente');
			}

			if (date_create($this->data['recorrente_data_final']) < date_create($this->data['vencimento'])) {
				$this->setError('vencimento', 'Defina uma data final posterior ao vencimento');
			}

			$interval = \DateInterval::createFromDateString('1 month');
			$period  = new \DatePeriod(date_create($this->data['vencimento']), $interval, date_create($this->data['recorrente_data_final'] . '-01'));

			if (iterator_count($period) <= 1) {
				$this->setError('vencimento', 'Defina uma data final somando um mês');
			}
		}
	}

	protected function beforeSave($data = null)
	{
		if (! $this->isNew()) {
			$this->query(
				sprintf('DELETE FROM contas_receber WHERE parent_id = %s', $this->id)
			);
		}
	}

	protected function afterDelete($id = null)
	{
		$this->query(
			sprintf('DELETE FROM contas_receber WHERE parent_id = %s', $id)
		);
	}

	protected function afterSave($data = null, $entity = null)
	{
		if (! $this->isNew()) {
			$this->query(
				sprintf('DELETE FROM contas_receber_descontos WHERE conta_receber_id = %s', $entity->id)
			);
		}

		if (isset($data['descontos'])) {
			foreach ($data['descontos'] as $desconto) {
				$valor = formatNumberToDb($desconto['valor']);
				$this->query(
					sprintf(
						"
						INSERT INTO 
							contas_receber_descontos (conta_receber_id, descricao, valor)
						VALUES(%s, '%s', %s)
						",
						$entity->id,
						$desconto['descricao'],
						$valor
					)
				);
			}
		}

		if ($this->data['recorrente'] == true) {
			$interval = \DateInterval::createFromDateString('1 month');
			$vencimento = date_create($this->data['vencimento']);
			$periodo   = new \DatePeriod($vencimento, $interval, date_create($this->data['recorrente_data_final']));

			$i = 1;
			foreach ($periodo as $dt) {
				if ($i++ > 1) {
					$model = clone($this);
					$newLancamento = $model->create();

					$newLancamento->setField('numero_titulo', $this->numero_titulo);
					$newLancamento->setField('valor', $this->valor);
					$newLancamento->setField('cliente_id', $this->cliente_id);
					$newLancamento->setField('vencimento', $dt->format(DATE_FORMAT_DB));
					$newLancamento->setField('recorrente', 0);
					$newLancamento->setField('recorrente_data_final', null);
					$newLancamento->setField('parent_id', $this->id);
					$newLancamento->setField('valor_final', $this->valor_final  );
					$newLancamento->save();
				}
			}
		}

	}

}