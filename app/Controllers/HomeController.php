<?php
namespace App\Controllers;

use App\AppController;

class HomeController extends AppController
{

	public function index()
	{
		$this->view(
			'inicio/index'
		);
	}
}