<?php
namespace App\Controllers;

use App\AppController;

class HomeController extends AppController
{

	public function index()
	{
		$this->view(
			'inicio/index'
		);
	}

	public function filtrar()
	{
		$this->setTemplate('json');

		$contasPagarModel = $this->model('contasPagar');
		$contasReceberModel = $this->model('contasReceber');
		$res = [];
		$resGraph = [];

		$where = '';

		if (! empty($_POST['de'])) {
			$dataDe = \DateTime::createFromFormat(DATE_FORMAT_READABLE, $_POST['de'])
			                         ->format(DATE_FORMAT_DB);
			$where = sprintf("vencimento >= '%s'",  $dataDe);

		}

		if (! empty($_POST['ate'])) {
			if (! empty($where))
				$where .= ' AND ';
			$dataAte = \DateTime::createFromFormat(DATE_FORMAT_READABLE, $_POST['ate'])
			                    ->format(DATE_FORMAT_DB);
			$where .= sprintf("vencimento <= '%s'", $dataAte);
		}

		$where = !empty($where) ? 'WHERE ' . $where : '';

		$contasPagarGroup = $contasPagarModel->fetchAll(
			"SELECT
				DATE(c.vencimento) as vencimento, SUM(c.valor_final) as valor
			FROM contas_pagar c 
			{$where}
			GROUP BY DATE(c.vencimento) ORDER BY DATE(c.vencimento)"
		);
		$contasPagarRes = $contasPagarModel->fetchAll(
			"SELECT
				c.*, f.nome FROM contas_pagar c
			INNER JOIN 
				fornecedores f ON f.id = c.fornecedor_id
			{$where}"
		);

		foreach ($contasPagarGroup as $contaPagar) {
			$resGraph[$contaPagar['vencimento']] = [
				'data' => $contaPagar['vencimento'],
				'pagar' => $contaPagar['valor']
			];
		}

		$contasReceberGroup = $contasReceberModel->fetchAll(
			"SELECT
				DATE(c.vencimento) as vencimento, SUM(c.valor_final) as valor
			FROM contas_receber c
			{$where}
			GROUP BY DATE(c.vencimento) ORDER BY DATE(c.vencimento)"
		);
		$contasReceberRes = $contasReceberModel->fetchAll(
			"SELECT
				c.*, f.nome FROM contas_receber c
			INNER JOIN 
				clientes f ON f.id = c.cliente_id
			{$where}"
		);

		foreach ($contasReceberGroup as $contaReceber) {
			if (isset($resGraph[$contaReceber['vencimento']])) {
				$resGraph[$contaReceber['vencimento']]['receber'] = $contaReceber['valor'];
			} else {
				$resGraph[$contaReceber['vencimento']] = [
					'data' => $contaReceber['vencimento'],
					'receber' => $contaReceber['valor']
				];
			}
		}

		$this->view(
			'inicio/filtrar',
			compact('contasPagarRes', 'contasReceberRes', 'resGraph')
		);
	}
}