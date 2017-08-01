<?php
namespace App\Models;

use App\AppTable;

class ClientesModel extends AppTable {

	public $table = 'clientes';

	protected $fields = [
		'nome' => true,
		'telefone' => true,
		'endereco' => true
	];

	/**
	 * Retorna todos os registros
	 *
	 * @return \PDOStatement
	 */
	public function getAll()
	{
		$res = $this->db
			->query('SELECT * FROM clientes');

		return $res;
	}

}