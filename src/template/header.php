<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/index.css">
	<?php
		/* CSS SELECTOR DEPENDIENDO DE LA PÁGINA */
		switch ($nombre_archivo) {

			/* TODOS LOS USUARIOS */
			case 'home_home.php':
				$css = "home_home.css";
				break;
			case 'home_register.php':
				$css = "home_register.css";
				break;
			case 'home_iniciar_sesion.php':
				$css = "home_iniciar_sesion.css";
				break;



			case 'lista_conciertos.php':
				$css = "lista_conciertos.css";
				break;
			case 'lista_musicos.php':
				$css = "lista_musicos.css";
				break;


			/* USUARIO LOGUEADO */
			case 'admin_config_user.php':
				$css = "admin_config_user.css";
				break;
			case 'admin_suscripciones.php':
				$css = "admin_suscripciones.css";
				break;
			case 'admin_conciertos.php':
				$css = "admin_conciertos.css";
				break;
			case 'admin_apunta_conciertos.php':
				$css = "admin_apunta_conciertos.css";
				break;
			case 'home_perfil.php':
				$css = "home_perfil.css";
				break;
			default:
				$css = "";
				break;
		}
		echo "<link rel='stylesheet' href='css/".$css."'>";
	?>

	<link href='http://fonts.googleapis.com/css?family=Chelsea+Market' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>



	<?php /*JQUERY*/ ?>
	<script src="js/jquery.min.js"></script>
	<script>
	  $(function() {
	    $( "#datepicker" ).datepicker({
	      changeMonth: true,
	      changeYear: true
	    });
	    jQuery('#datetimepicker').datetimepicker();
	  });
  </script>
	<?php /*DATEPICKER*/ ?>
	<link rel="stylesheet" href="css/jquery-ui.css">
	<link rel="stylesheet" href="css/jquery.datetimepicker.css">
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery.datetimepicker.js"></script>
	<script src="js/jquery-ui.js"></script>

	<title>Ritmo De Copas</title>
	<style>
		@media (min-width: 700px){
			header > nav > ul > li{
				<?php if(!isset($_SESSION['cod_usu'])){ ?>
				width: calc(20% - 5px);
				<?php } else{ ?>
				width: calc(16.66% - 5px);
				<?php } ?>
			}
		}
	</style>
</head>
<body>
	<header>
		<?php /*<a href="home_home.php"><center><img src="img/mainlogo-ritmodecopas.png" alt="Ritmo De Copas" style="width: 50%;"></center></a>*/ ?>
		<a href="home_home.php"><img src="img/header.png" alt="Ritmo de Copas" class="logo" border="0"></a>
		<nav>
			<ul>
				<li><a href="lista_conciertos.php">conciertos</a></li>
				<li><a href="lista_musicos.php">músicos</a></li>
				<li><a href="lista_locales.php">locales</a></li>
				<?php
				/* OPCIONES PERSONALIZADAS */
				if(isset($_SESSION['tipo_usu'])){
					switch ($_SESSION['tipo_usu']){
					/* SI ES FAN */
					case 0:
						echo "<li><a href='lista_musicos.php'><div>votar musicos</div></a></li>";
						break;

					/* SI ES LOCAL */
					case 1:
						echo "<li><a href='admin_conciertos.php'><div>crear</div></a></li>";
						break;

					/* SI ES MUSICO */
					case 2:
						echo "<li><a href='admin_apunta_conciertos.php'><div>apuntarme</div></a></li>";
						break;
					}
				}
				/* LOGIN - LOGOUT - REGISTRARSE*/
				if(!isset($_SESSION['cod_usu'])){
					echo "
					<li><a href='home_register.php'><div>registrarse</div></a></li>
					<li><a href='home_iniciar_sesion.php'><div>iniciar sesión</div></a></li>";
				}
				else{
					echo"
					<li><a href='admin_config_user.php'><div>mi cuenta</div></a></li>
					<li><a href='logout.php'><div>cerrar sesión</div></a></li>";
				}				
				?>

			</ul>
			<span class="last"></span>
		</nav>

	</header>
	<div id="in-main">