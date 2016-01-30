<?php
require_once "config/config.php";
	if(isset($_GET['token'])){
		$user = new Usuario();
		$result = $user->validarUsuario($_GET['token']);
			header("Location: home_iniciar_sesion.php");
	}
	else{
			header("Location: home_home.php");
	}

?>