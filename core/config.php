<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

define('HOST', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'prototipo_homeoffice');

define('ROOT', 'http://localhost/_prototipos/home-office/');
define('PUBLIC_URI', ROOT . 'public/');

define('DATE_FORMAT_DB', 'Y-m-d');
define('DATE_FORMAT_READABLE', 'd/m/Y');

define('LIMITE_CONTAS', '889.90');

function dd($var) {
	var_dump($var);
	die();
}

function url($url) {
	return ROOT . $url;
}

function readableDate($date) {
	if (is_null($date) || $date == '')
		return '';
	return \DateTime::createFromFormat(DATE_FORMAT_DB, $date)
	                ->format(DATE_FORMAT_READABLE);
}

function formatNumber($value)
{
	return number_format($value, 2, ',', '.');
}

function formatNumberToDb($value)
{
	return str_replace(['.', ','], ['', '.'], $value);
}
