<?php
	require_once 'config/config.php';
	require_once 'controladores/home_home.php';
	require_once 'template/header.php';
	$concierto = new Concierto();
	$ultimos_conciertos = $concierto->ultimos_conciertos();
?>
	<div id="home-home" class="container">
		<div class="searcher">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<label for="tipo_busqueda">Qué quieres buscar:</label>
				<select name="tipo_busqueda">
					<option value="1">Musico</option>
					<option value="2">Local</option>
					<option value="3" selected>Concierto</option>
				</select>
				<label for="nombre">Nombre:</label>
				<input type="text" name="nombre">
				<input type="submit" name="buscar" value="Enviar">
			</form>
		</div>
		<div class="lastconcerts">
			<div class="title">
					Últimos conciertos
			</div>
			<img src='img/home_subrayado.png' />
			<div class="list">
				<?php if(count($ultimos_conciertos) > 0){ foreach ($ultimos_conciertos as $concierto) { ?>
				<table>
					<tr>
						<td>Nombre:</td>
						<td><?php echo $concierto['nombre']; ?></td>
					</tr>
					<tr>
						<td>Fecha:</td>
						<td><?php echo $concierto['fecha']; ?></td>
					</tr>
					<tr>
						<td>Local:</td>
						<td><?php echo $concierto['local']; ?></td>
					</tr>
					<tr>
						<td>Músico:</td>
						<td><?php echo $concierto['musico']; ?></td>
					</tr>
				</table>
				<?php }} else{ ?>
				Sin conciertos.
				<?php } ?>
				
			</div>
		</div>
		<div class="top">
			<a href="lista_locales.php"><img src="img/top_local.png" alt="Top Local"></a>
			<a href="lista_musicos.php"><img src="img/top_musico.png" alt="Top músico"></a>
			<a href="lista_conciertos.php"><img src="img/top_concierto.png" alt="Top concierto"></a>
		</div>
	</div>
<?php include 'template/footer.php'; ?>