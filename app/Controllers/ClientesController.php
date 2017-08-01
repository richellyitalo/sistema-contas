<?php

namespace App\Controllers;

use App\AppController;

class ClientesController extends AppController
{

	public function index()
	{
		$model = $this->model('clientes');

		$clientes = $model->getAll();

		$this->view(
			'clientes/index',
			compact('clientes')
		);

	}

	public function add()
	{
		$model = $this->model('clientes');

		$cliente = $model->create();

		if (! empty($_POST)) {
			if ($cliente->save($_POST)) {
				$this->message('Cliente salvo com sucesso!');
				$this->redirect('clientes');
			} else {
				$this->message('Não foi possível salvar novo usuário');
			}
		}

		$this->view(
			'clientes/add',
			compact('cliente', 'mensagem')
		);
	}

	public function edit($id = null)
	{
		$model = $this->model('clientes');

		$cliente = $model->get($id);

		if (! empty($_POST)) {
			if ($cliente->save($_POST)) {
				$this->message('Cliente atualizado com sucesso!');
				$this->redirect('clientes/edit/' . $cliente->data['id']);
			} else {
				$this->message('Não foi possível atualizar novo usuário.');
			}
		}

		$this->view(
			'clientes/edit',
			compact('cliente', 'mensagem')
		);

	}

	public function delete()
	{
		if (! empty($_POST)) {
			$model = $this->model('clientes');

			if ($model->delete($_POST['id'])) {
				$this->message('Cliente foi removido!');
			} else {
				$this->message('Não foi possível remover o usuário!');
			}
		}

		$this->redirect($_SERVER['HTTP_REFERER']);
	}
}