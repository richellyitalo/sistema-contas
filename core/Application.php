<?php

require 'vendor/autoload.php';

require_once 'config.php';

class Application
{

	/**
	 * @var null
	 */
	private $_controller = 'home';

	/**
	 * @var string
	 */
	private $_method = 'index';

	/**
	 * @var null
	 */
	private $_param = null;


	/**
	 * Início da aplicação
	 *
	 * Definido os parametros com base na url no padrão: `/{controller}/{método}/{parâmetro}`
	 */
	public function start()
	{
		$this->_parseUrl();

		$controllerName = ucfirst($this->_controller) . 'Controller';

		if (file_exists('./app/Controllers/' . $controllerName . '.php')) {
			//require './app/controllers/' . $controllerName . '.php';
			$controllerNamespace = '\App\Controllers\\' . $controllerName;

			$this->_controller = new $controllerNamespace ();

			if (isset($this->_param)) {
				$this
					->_controller
					->{$this->_method}
					($this->_param);

			} else {
				$this
					->_controller
					->{$this->_method}
					();

			}
		} else {
			$home = new \App\Controllers\HomeController();
			$home->index();
		}
	}

	/**
	 * Construção dos parametros pegando da url gerada no .htaccess
	 */
	private function _parseUrl()
	{
		if (isset($_GET['url'])) {
			$url = rtrim($_GET['url'], '/');
			$url = explode('/', $url);

			if (isset($url[0]))
				$this->_controller = $url[0];
			if (isset($url[1]))
				$this->_method = $url[1];
			if (isset($url[2]))
				$this->_param = $url[2];
		}
	}
}
