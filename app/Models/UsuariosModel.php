<?php
namespace App\Models;

use App\AppTable;

class UsuariosModel extends AppTable {

	public $table = 'usuarios';

	protected $fields = [
		'nome' => true,
		'email' => true,
		'senha' => true
	];

	public function get($id)
	{
		$st = $this->db
			->prepare('SELECT * FROM usuarios WHERE id = ?');
		$st->execute([$id]);

		$this->setData($st->fetch());
		return $this;
	}

	public function login($email, $password)
	{
		$sql = "SELECT id, nome, email FROM usuarios WHERE email = :email AND senha = :senha";
		$stmt = $this->db->prepare($sql);

		$password = md5($password);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':senha', $password);

		$stmt->execute();
		$usuario = $stmt->fetch();

		if (empty($usuario))
			return false;
		else {
			$_SESSION['logged'] = true;
			$_SESSION['auth']['id'] = $usuario['id'];
			$_SESSION['auth']['name'] = $usuario['nome'];
			$_SESSION['auth']['email'] = $usuario['email'];

			return true;
		}
	}


	public function logout()
	{
		$_SESSION['logged'] = false;
		unset($_SESSION['auth']);

		return true;
	}

	public function getAll()
	{
		$res = $this->db
			->query('SELECT * FROM usuarios');

		return $res;
	}

	protected function beforeMarshal()
	{

	}

	protected function beforeSave($data = null)
	{
		$this->setField('senha', md5($this->getField('senha')));
	}

	protected function beforeValidate()
	{
		if ($this->isNew()) {
			$query = $this->db->query(
				sprintf('SELECT * FROM usuarios WHERE email = \'%s\'', $this->getField('email'))
			);

			if ((bool)$query->fetch()) {
 			    $this->errors['email'] = 'Esse e-mail já existe';
			}
		}
	}

}