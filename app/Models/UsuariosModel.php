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

	public function getAll()
	{
		$res = $this->db
			->query('SELECT * FROM usuarios');

		return $res;
	}

	protected function beforeMarshal()
	{

	}

	protected function beforeSave()
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