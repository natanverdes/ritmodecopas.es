<?php
function error_vacio($post, $err){
	global $error;
	if ($_POST[$post] == ""){
		$error[] = $err;
	}
}

function controlar_errores(){
	global $error;
	if(isset($error)){
				$i = 0;
				while ($i < count($error)) {
					echo "
					<tr colspan='2'>
						<td>".$error[$i]."</td>
					</tr>";
					$i++;
				}
			unset($error);
		}
}
$usuario = new Usuario();
$ciudades = $usuario->verCiudades();
$generos = $usuario->verGeneros();

/* EN CASO DE QUE SE PRESIONE A SUBMIT */
if (isset($_POST['fan']) || isset($_POST['local']) || isset($_POST['musico'])) {
	/* CONTROL DE ERRORES */
	/* PARA TODOS*/
	error_vacio("correo", "El campo Correo electrónico debe estar completo");
	error_vacio("contrasena", "El campo Contraseña debe estar completo");
	error_vacio("nombre", "Debes insertar tu nombre.");
	error_vacio("ciudad", "Debe elegir una ciudad.");

	if ($_POST['correo'] != $_POST['confirm_correo']){
		$error[] = "Los correos electrónicos introducidos no son iguales";}
	if ($_POST['contrasena'] != $_POST['confirm_contrasena']){
		$error[] = "Las contraseñas introducidas no son iguales";}

	/* PARA FAN */
	if(isset($_POST['fan'])){
		error_vacio("genero", "Debes elegir tu género favorito.");
		error_vacio("fecha_nacimiento", "Debes completar tu fecha de nacimiento.");
	}

	/* PARA LOCAL */
	else if(isset($_POST['local'])){
		error_vacio("direccion", "Debes completar la dirección de tu local.");
		error_vacio("aforo", "Debes completar el campo de aforo.");
		error_vacio("telefonoL", "Debes completar el campo de teléfono.");
	}

	/* PARA MUSICO */
	else if(isset($_POST['musico'])){
		error_vacio("genero", "Debes elegir el género de tu banda.");
		error_vacio("telefonoM", "Debes añadir un teléfono de contacto.");
		error_vacio("nombre_grupo", "Debes completar el campo Nombre de tu grupo.");
	}
	
	if(!isset($error)){
		/*COMPROBAR QUE EL CORREO NO ESTÁ REPETIDO*/
		if ($usuario->IsRegisteredUser($_POST['correo'])) {
		    $error[] = "El correo electrónico introducido ya está registrado.";
		}
		if(!isset($error)){
			if(isset($_POST['fan'])){
				$usuario->RegistrarFan($_POST['correo'], $_POST['contrasena'], $_POST['nombre'], $_POST['ciudad'], $_POST['genero'], $_POST['fecha_nacimiento']);
			}
			else if(isset($_POST['local'])){
				$usuario->RegistrarLocal($_POST['correo'], $_POST['contrasena'], $_POST['nombre'], $_POST['ciudad'], $_POST['direccion'], $_POST['aforo'], $_POST['telefonoL']);
				
			}
			else if(isset($_POST['musico'])){
				$usuario->RegistrarMusico($_POST['correo'], $_POST['contrasena'], $_POST['nombre'], $_POST['ciudad'], $_POST['genero'], $_POST['telefonoM'], $_POST['nombre_grupo']);
			}

			/* REGISTRO COMPLETO */
			$_SESSION['register'] = 1;
			header("Location: home_iniciar_sesion.php");
		}		
		}
		

}
?>