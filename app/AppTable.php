<?php

namespace App;

class AppTable
{

	function __construct(\PDO $db) {
		$this->db = $db;
	}

	public $table;

	protected $fields = [];

	private $data;

	protected $valid = false;

	protected $errors = [];

	public function __get($name)
	{
		if ($name == 'data')
			return $this->data;

		if (array_key_exists($name, $this->data))
			return $this->data[$name];
	}


	public function create()
	{
		foreach($this->fields as $field => $required) {
			$this->setField($field, null);
		}
		foreach ($this->data as $field => $value) {
			if (!array_key_exists($field, $this->fields)) {
				unset($this->data[$field]);
			}
		}

		return $this;
	}

	public function setError($node, $msg)
	{
		$this->errors[$node] = $msg;
	}

	public function isNew()
	{
		return ! isset($this->data['id']);
	}

	public function setNew()
	{
		unset($this->data['id']);
	}

	public function get($id)
	{
		$st = $this->db
			->prepare("SELECT * FROM {$this->table} WHERE id = ?");
		$st->execute([$id]);

		$this->setData($st->fetch());
		return $this;
	}

	public function save($data = null)
	{
		if (!is_null($data)) {
			$this->patch($data);
		}

		if ($this->valid) {
			$this->beforeSave($data);

			$sqlArray = [];
			$arrayInsert = [];

			if ($this->isNew()) {
				$sql = "INSERT INTO {$this->table} SET ";

				foreach ($this->data as $key => $value) {
					$sqlArray[] = "{$key} = :{$key}";
					$arrayInsert[":{$key}"] = $value;
				}
				$sql .= implode(', ', $sqlArray);
				$st = $this->db->prepare($sql);
			} else {
				$sql = "UPDATE {$this->table} SET ";

				$newData = [];
				// montando o array de atualização
				foreach ($this->data as $field => $value) {
					if (array_key_exists($field, $this->fields)) {
						$newData[$field] = $value;
					}
				}
				foreach ($newData as $key => $value) {
					$sqlArray[] = "{$key} = :{$key}";
					$arrayInsert[":{$key}"] = $value;
				}
				$arrayInsert[':id'] =  $this->data['id'];
				$sql .= implode(', ', $sqlArray);
				$sql .= ' WHERE id = :id';

				$st = $this->db->prepare($sql);
			}
			$stResult = $st->execute($arrayInsert);

			if ($this->isNew())
				$this->data['id'] = $this->db->lastInsertId();

			$this->afterSave($data, $this);

			return $stResult;
		} else {
			return false;
		}
	}

	public function query($query)
	{
		return $this->db->query($query);
	}

	public function fetch($query)
	{
		$sth = $this->db->prepare($query);
		$sth->execute();

		return $sth->fetch();
	}

	public function fetchAll($query)
	{
		$sth = $this->db->prepare($query);
		$sth->execute();

		return $sth->fetchAll();
	}

	public function queryWithData($preparySql, $data)
	{
		$st = $this->db->prepare($preparySql);
		return $st->execute($data);
	}

	public function patch($data)
	{
		foreach ($data as $key => $value) {
			if(array_key_exists($key, $this->fields)) {
				$this->setField($key, $value);
			}
		}
		$this->validate();

		return $this->data;
	}

	public function validate()
	{
		$this->valid = true;
		$this->beforeMarshal();

		$this->beforeValidate();

		foreach ($this->fields as $field => $required) {

			if (
				$required
				&& (
					!isset($this->data[$field]) ||
					trim($this->data[$field]) === ''
				)
			) {
				$this->errors[$field] =  'Campo obrigatório';
			}
		}

		if (!empty($this->errors))
			$this->valid = false;

		return $this->valid;
	}

	public function isValid()
	{
		return (bool) $this->valid;
	}

	public function setData($data)
	{
		$this->data = $data;
	}

	public function getData()
	{
		return $this->data;
	}

	public function setField($field, $value)
	{
		if (array_key_exists($field, $this->fields))
			return $this->data[$field] = $value;
		return false;
	}

	public function getField($field)
	{
		if (array_key_exists($field, $this->fields))
			return $this->data[$field];
		return false;
	}

	public function getErrors()
	{
		return $this->errors;
	}

	public function delete($id = null)
	{
		if (is_null($id) && isset($this->data['id']))
			$id = $this->data['id'];

		$st = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
		$st->bindParam(':id', $id);
		$st->execute();

		$this->afterDelete($id);

		return $st->rowCount();
	}

	protected function beforeSave($data = null) {}

	protected function afterSave($data = null, $entity = null) {}

	protected function beforeMarshal() {}

	protected function beforeValidate() {}

	protected function afterDelete($id = null) {}

}