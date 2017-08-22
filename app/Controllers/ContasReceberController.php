<?php

namespace App\Controllers;

use App\AppController;

class ContasReceberController extends AppController
{

	public function index()
	{
		$model = $this->model('contasReceber');

		$lancamentos = $model->query(
			'SELECT
				c.*, f.nome FROM contas_receber c
			INNER JOIN 
				clientes f ON f.id = c.cliente_id
			WHERE parent_id IS NULL'
		);

		$this->view(
			'contas_receber/index',
			compact('lancamentos')
		);

	}

	public function lancamento()
	{
		$model = $this->model('contasReceber');

		$lancamento = $model->create();
		$clientes = $this->model('clientes')->getAll();
		$descontos = [];

		if (! empty($_POST)) {
			if (isset($_POST['descontos'])) {
				$descontos = $_POST['descontos'];
			}

			if ($lancamento->save($_POST)) {
				$this->message('Lançamento salvo com sucesso!');
				$this->redirect('contasReceber');
			} else {
				$this->message('Não foi possível lançar esta conta.');
			}
		}

		$this->view(
			'contas_receber/lancamento',
			compact('lancamento', 'clientes', 'descontos')
		);
	}

	public function edit($id = null)
	{
		$model = $this->model('contasReceber');

		$lancamento = $model->get($id);

		$clientes = $this->model('clientes')->getAll();
		$descontos = $model->getDescontos();

		if (isset($_POST['descontos']))
			$descontos = $_POST['descontos'];

		if (! empty($_POST)) {
			if ($lancamento->save($_POST)) {
				$this->message('Lançamento atualizado com sucesso!');
				$this->redirect('contasReceber/edit/' . $id);
			} else {
				$this->message('Não foi possível lançar esta conta.');
			}
		}

		$this->view(
			'contas_receber/edit',
			compact('lancamento', 'clientes', 'descontos')
		);

	}

	public function delete()
	{
		if (! empty($_POST)) {
			$model = $this->model('contasReceber');

			if ($model->delete($_POST['id'])) {
				$this->message('Lançamento foi removido!');
			} else {
				$this->message('Não foi possível remover o fornecedor!');
			}
		}

		$this->redirect($_SERVER['HTTP_REFERER']);
	}
}