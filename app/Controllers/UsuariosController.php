<?php

namespace App\Controllers;

use App\AppController;

class UsuariosController extends AppController
{

	public function index()
	{
		$model = $this->model('usuarios');

		$usuarios = $model->getAll();

		$this->view(
			'usuarios/index',
			compact('usuarios')
		);

	}

	public function add()
	{
		$model = $this->model('usuarios');

		$usuario = $model->create();

		if (! empty($_POST)) {
			if ($usuario->save($_POST)) {
				$this->message('Usuário salvo com sucesso!');
				$this->redirect('usuarios');
			} else {
				$this->message('Não foi possível salvar novo usuário');
			}
		}

		$this->view(
			'usuarios/add',
			compact('usuario', 'mensagem')
		);
	}

	public function edit($id = null)
	{
		$model = $this->model('usuarios');

		$usuario = $model->get($id);

		if (! empty($_POST)) {
			// definindo nova senha
			if (! empty($_POST['nova_senha']))
				$usuario->setField('senha', md5($_POST['nova_senha']));
			if ($usuario->save($_POST)) {
				$this->message('Usuário atualizado com sucesso!');
			} else {
				$this->message('Não foi possível atualizar novo usuário.');
			}
		}

		$this->view(
			'usuarios/edit',
			compact('usuario', 'mensagem')
		);

	}

	public function delete()
	{
		if (! empty($_POST)) {
			$model = $this->model('usuarios');

			if ($model->delete($_POST['id'])) {
				$this->message('Usuário foi removido!');
			} else {
				$this->message('Não foi possível remover o usuário!');
			}
		}

		$this->redirect($_SERVER['HTTP_REFERER']);
	}

	public function login()
	{
		$this->setTemplate('login');
		$model = $this->model('usuarios');

		if (! empty($_POST)) {
			if (empty($_POST['email']) || empty($_POST['senha'])) {
				$this->message('Todos os campos devem ser preenchidos!');
			} else {
				if ($model->login($_POST['email'], $_POST['senha'])) {
					$this->redirect('');
				} else {
					$this->message('E-mail ou senha inválidos');
				}
			}
		}

		$this->view('usuarios/login');
	}

	public function logout()
	{
		if ($this->model('usuarios')->logout()) {
			$this->redirect('usuarios/login');
		}
	}
}