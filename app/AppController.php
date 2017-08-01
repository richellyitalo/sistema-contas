<?php
namespace App;

if (!session_id())
	session_start();

class AppController
{

	private $_template = 'default';

	public $db = null;

	function __construct()
	{
		$this->getConnection();
	}

	public function getConnection()
	{
		// $this->db = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
		try {
			$this->db = new \PDO(
				sprintf('mysql:host=%s;dbname=%s;charset=utf8', HOST, DATABASE),
				USERNAME,
				PASSWORD
			);
		} catch(PDOException $e) {
			echo "Erro ao conectar. \nErro: " .$e;
		}

	}

	public function model($model)
	{
		$modelName = ucfirst($model) . 'Model';
		$modelNamespace = '\App\Models\\' . $modelName;

		return new $modelNamespace($this->db);
	}

	public function setTemplate($template)
	{
		$this->_template = $template;
	}

	public function view($templateUri, $data = null)
	{
		if (!is_null($data))
			extract($data);

		ob_start();
		include './app/views/' . $templateUri . '.php';
		$content = ob_get_clean();

		require './template/' . $this->_template . '.php';
	}

	public function redirect($url)
	{
		if (strpos($url, 'http') === false)
			$url = ROOT . $url;

		header('Location: ' . $url);
		die();
	}

	public function hasMessage()
	{
		return (bool) isset($_SESSION['message']) && ! empty(isset($_SESSION['message']));
	}

	public function getMessage()
	{
		$message = $this->hasMessage() ? $_SESSION['message'] : '';
		unset($_SESSION['message']);

		return $message;
	}

	public function message($msg)
	{
		$_SESSION['message'] = $msg;
	}
}