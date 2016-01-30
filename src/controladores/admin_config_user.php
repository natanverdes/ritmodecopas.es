<?php
	$user = new Usuario();
	$user->comprobar_sesion();
	$user->UsuDetails($_SESSION['cod_usu']);
	if(isset($_POST['changepassword'])){

		if($_POST['password_n'] == $_POST['password_n_d']){
			$result = $user->cambiarPassword($_POST['password'], $_POST['password_n']);
			if($result){
				$error = "Editado correctamente";
			}
			else{
				$error = "Error: Password Incorrecto";
			}
		}
		else{
			$error = "Error: Los passwords no coinciden";
		}
		
	}

	
?>