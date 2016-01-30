<?php
if(isset($_POST['submit'])){

		$usuario = new Usuario();

		if ($usuario->login(
			$_POST['user'],
			$_POST['password']
			)
			== false) {
		    $error_index_login = 1;
		}
		else {
		    $_SESSION['cod_usu'] = $usuario->cod_usu;
		    $_SESSION['nombre_usu'] = $usuario->nombre;
		    $_SESSION['tipo_usu'] = $usuario->tipo_usu;
		   	$_SESSION['cod_gen'] = $usuario->cod_gen;

		    header("Location: admin_config_user.php");
		}
	}
?>