<?php

namespace App\Controllers;

use App\AppController;

class ContasPagarController extends AppController
{

	public function index()
	{
		$model = $this->model('contasPagar');

		$lancamentos = $model->query(
			'SELECT
				c.*, f.nome FROM contas_pagar c
			INNER JOIN 
				fornecedores f ON f.id = c.fornecedor_id
			WHERE parent_id IS NULL'
		);

		$this->view(
			'contaspagar/index',
			compact('lancamentos')
		);

	}

	public function lancamento()
	{
		$model = $this->model('contasPagar');

		$lancamento = $model->create();
		$fornecedores = $this->model('fornecedores')->getAll();
		$descontos = [];

		if (! empty($_POST)) {
			if (isset($_POST['descontos'])) {
				$descontos = $_POST['descontos'];
			}

			if ($lancamento->save($_POST)) {
				$this->message('Lançamento salvo com sucesso!');
				$this->redirect('contasPagar');
			} else {
				$this->message('Não foi possível lançar esta conta.');
			}
		}

		$this->view(
			'contaspagar/lancamento',
			compact('lancamento', 'fornecedores', 'descontos')
		);
	}

	public function edit($id = null)
	{
		$model = $this->model('contasPagar');

		$lancamento = $model->get($id);

		$fornecedores = $this->model('fornecedores')->getAll();
		$descontos = $model->getDescontos();
		if (isset($_POST['descontos']))
			$descontos = $_POST['descontos'];

		if (! empty($_POST)) {
			if ($lancamento->save($_POST)) {
				$this->message('Lançamento atualizado com sucesso!');
				$this->redirect('contasPagar/edit/' . $id);
			} else {
				$this->message('Não foi possível lançar esta conta.');
			}
		}

		$this->view(
			'contaspagar/edit',
			compact('lancamento', 'fornecedores', 'descontos')
		);

	}

	public function delete()
	{
		if (! empty($_POST)) {
			$model = $this->model('contasPagar');

			if ($model->delete($_POST['id'])) {
				$this->message('Lançamento foi removido!');
			} else {
				$this->message('Não foi possível remover o fornecedor!');
			}
		}

		$this->redirect($_SERVER['HTTP_REFERER']);
	}
}