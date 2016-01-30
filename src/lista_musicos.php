<?php
	include_once 'config/config.php';
	
	include_once 'controladores/lista_musicos.php';

	include_once 'template/header.php';
	$usuario = new Usuario();
	$generos = $usuario->verGeneros();
?>
<div id="lista-musicos">
	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="GET">
		<select name="genero">
			<option value="">Todos los géneros</option>
			<?php foreach ($generos as $genero) { ?>

			<?php $selected = ""; if(isset($_GET['genero'])){
					if($genero['cod_gen'] == $_GET['genero']){
						$selected = "selected";
					}}
			?>
				<option <?php echo $selected; ?> value="<?php echo $genero['cod_gen']; ?>"><?php echo $genero['nombre']; ?></option>
			<?php } ?>
		</select>
		<input type="submit" value="Enviar">
	</form>

	<table class="alltable">
		<thead>
			<tr>
				<td>Nombre del Grupo</td>
				<td>Género</td>
				<td>Puntuación (1-5)</td>
			</tr>
		</thead>
		<?php if(count($rows) == 0){ ?>
			<tr>
				<td colspan='3'>Sin resultados.</td>
			</tr>
		<?php } else{ foreach ($rows as $row) { ?>
			<tr>
				<td><a href="home_perfil.php?id=<?php echo $row['cod_usu']; ?>"><?php echo $row['nombre_grupo']; ?></a></td>
			 	<td><?php echo $row['nombre']; ?></td>
			 	<td><?php echo $row['puntuacion']; ?></td>
			</tr>
		<?php }} ?>
	</table>
</div>

<?php
	include_once 'template/footer.php';
?>