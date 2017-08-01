<?php
namespace App\Models;

use App\AppTable;

class FornecedoresModel extends AppTable {

	public $table = 'fornecedores';

	protected $fields = [
		'nome' => true,
		'razao_social' => true,
		'endereco' => true
	];

	public function getAll()
	{
		$res = $this->db
			->query('SELECT * FROM fornecedores');

		return $res;
	}

}