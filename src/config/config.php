<?php
session_start();
define('FILEPATH', dirname(__FILE__));
define('HREFPATH', "http://localhost/DAM/ritmodecopas.es/www/");

$nombre_archivo = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
	strpos($nombre_archivo, '/');
	$nombre_archivo = array_pop(explode('/', $nombre_archivo));

    
// PASSWORD HASH
require_once 'password.php';

// CLASSES
require_once __DIR__."/../modelos/modelo.php";
	require_once __DIR__."/../modelos/usuario.php";
		require_once __DIR__."/../modelos/usuario/musico.php";
		require_once __DIR__."/../modelos/usuario/local.php";
		require_once __DIR__."/../modelos/usuario/fan.php";
	require_once __DIR__."/../modelos/concierto.php";
	require_once __DIR__."/../modelos/ciudad.php";
require_once __DIR__."/../modelos/mail.php";
?>