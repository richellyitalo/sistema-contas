<?php

namespace App\Controllers;

use App\AppController;

class FornecedoresController extends AppController
{

	public function index()
	{
		$model = $this->model('fornecedores');

		$fornecedores = $model->getAll();

		$this->view(
			'fornecedores/index',
			compact('fornecedores')
		);

	}

	public function add()
	{
		$model = $this->model('fornecedores');

		$fornecedor = $model->create();

		if (! empty($_POST)) {
			if ($fornecedor->save($_POST)) {
				$this->message('Fornecedor salvo com sucesso!');
				$this->redirect('fornecedores');
			} else {
				$this->message('Não foi possível salvar novo usuário');
			}
		}

		$this->view(
			'fornecedores/add',
			compact('fornecedor')
		);
	}

	public function edit($id = null)
	{
		$model = $this->model('fornecedores');

		$fornecedor = $model->get($id);

		if (! empty($_POST)) {
			if ($fornecedor->save($_POST)) {
				$this->message('Fornecedor atualizado com sucesso!');
				$this->redirect('fornecedores/edit/' . $fornecedor->data['id']);
			} else {
				$this->message('Não foi possível atualizar o fornecedor.');
			}
		}

		$this->view(
			'fornecedores/edit',
			compact('fornecedor', 'mensagem')
		);

	}

	public function delete()
	{
		if (! empty($_POST)) {
			$model = $this->model('fornecedores');

			if ($model->delete($_POST['id'])) {
				$this->message('Fornecedor foi removido!');
			} else {
				$this->message('Não foi possível remover o fornecedor!');
			}
		}

		$this->redirect($_SERVER['HTTP_REFERER']);
	}
}