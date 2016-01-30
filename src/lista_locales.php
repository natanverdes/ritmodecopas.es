<?php
	include_once 'config/config.php';

	$local = new Local();
	if(isset($_GET['ciudad'])){
		if($_GET['ciudad'] != ""){
			$ciudad = $_GET['ciudad'];
		}
		else{
			$ciudad = NULL;
		}
	}
	else{
		$ciudad = NULL;
	}

	if(isset($_GET['query'])){
		$query = $_GET['query'];
	}
	else{
		$query = NULL;
	}


	$rows = $local->print_last_locales($ciudad, $query);
	$usuario = new Usuario();
	$ciudades = $usuario->verCiudades();


	include_once 'template/header.php';
?>
<div id="lista-locales">
	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="GET">
					<select name="ciudad">
								<option value="" selected>Todas las provincias</option>
								<?php foreach ($ciudades as $ciudad) { ?>
									<option value="<?php echo $ciudad['cod_ciu']; ?>"><?php echo $ciudad['nombre']; ?></option>
								<?php } ?>
								</select>
					<input type="submit" value="Enviar">
				</form>
	<table class="alltable">
		<thead>
			<tr>
				<td>Nombre del local</td>
				<td>Dirección del Local</td>
				<td>Aforo</td>
				<td>Ciudad</td>
			</tr>
		</thead>
		<tbody>
		<?php if(count($rows) == 0){ ?>
			<tr>
				<td colspan='4'>
					Sin resultados.
				</td>
			</tr>
		<?php } else{ foreach ($rows as $row) {?>
			<tr>
			 			<td><?php echo $row['nombre']; ?></td>
			 			<td><?php echo $row['direccion']; ?></td>
			 			<td><?php echo $row['aforo']; ?></td>
			 			<td><?php echo $row['nombre_ciudad']; ?></td>
			 		</tr>
		<?php }} ?>
	</tbody>
	</table>
</div>

<?php
	include_once 'template/footer.php';
?>

