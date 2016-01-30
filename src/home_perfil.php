<?php
	include_once 'config/config.php';

	include_once 'template/header.php';
	$ViewedUser = new Usuario($_GET['id']);

	if(isset($_SESSION['cod_usu'])){
		$ViewingUser = new Usuario($_SESSION['cod_usu']);
		if(isset($_POST['enviar_valoracion'])){
			$ViewingUser->FuncionEspecial->PublicarVotacion($ViewedUser->cod_usu, $_POST['estrellas'], $_POST['comentario']);
		}
	}

	

?>
<div id="main">
	<div id="imagen">
		
	</div>
	<div id="tipo">
		<?php echo $ViewedUser->nombre_tipo_usu; ?>
	</div>
	<div id="nombre">
		<?php switch ($ViewedUser->tipo_usu) {
			case 0:
				echo $ViewedUser->correo;
				break;
			case 1:
				echo $ViewedUser->direccion;
				break;
			case 2:
				echo $ViewedUser->nombre_grupo;
				break;
		}?>
	</div>
	<div id="genero">
		<?php echo $ViewedUser->nombre_genero; ?>
	</div>
	<?php if($ViewedUser->tipo_usu == 2){ ?>
	<div id="estrellas-medias">
		Estrellas: <?php echo $ViewedUser->FuncionEspecial->estrellas_medias(); ?>
	</div>
	<div id="votos">
		<?php $votos = $ViewedUser->FuncionEspecial->imprimir_votaciones();
		if(count($votos) > 0){
			foreach ($votos as $voto) { ?>
			<div class="voto">
				<div class="estrellas">Estrellas: <?php echo $voto['puntuacion']; ?></div>
				<div class="usuario">Usuario: <?php echo $voto['usuario_fan']; ?></div>
				<div class="comentario">Comentario: <?php echo $voto['comentario']; ?></div>
			</div>
		<?php }}else{ ?>
		<div class="voto">
			Músico sin votos
		</div>
		<?php } ?>
	</div>
	<?php } ?>
	<?php
		if(isset($ViewingUser)){
			if($ViewedUser->tipo_usu == 2 && $ViewingUser->tipo_usu == 0){
				if($ViewingUser->FuncionEspecial->HaVotado($ViewingUser->cod_usu) == false){ ?>
	<div id="votar">
		<form action="<?php echo $_SERVER['PHP_SELF'] . "?id=" . $_GET['id'] ; ?>" method="post">
			<label for="estrellas">Estrellas (1-5)</label>
			<input name="estrellas" type="range" name="points" min="1" max="5"><br />
			<textarea name="comentario" rows="10" cols="40"></textarea>
  			<input type="submit" name="enviar_valoracion" value="Enviar valoración">
		</form>
	</div>
	<?php }}else{ ?>
	<div>
		Solo los Fans pueden votar.
	</div>
	<?php }}else{ ?>
	<div>
		Inicia sesión para votar.
	</div>
	<?php } ?>
</div>
<?php
	include_once 'template/footer.php';
?>