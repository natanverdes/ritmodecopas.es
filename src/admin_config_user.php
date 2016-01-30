<?php
	require_once 'config/config.php';

	require_once 'controladores/admin_config_user.php';

	require_once 'template/header.php';
?>
<div id="main" style="padding-top: 50px;">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<table style="width: 50%; margin: 0 auto;">
	<?php if(isset($error)){ ?>
	<tr>
		<td colspan="2"><?php echo $error; ?></td>
	</tr>
	<?php } ?>
	<tr>
		<td>Tu usuario:</td>
		<td><?php echo $user->correo; ?></td>
	</tr>
	<tr>
		<td>Tipo de cuenta:</td>
		<td><?php echo $user->nombre_tipo_usu; ?></td>
	</tr>

	<tr>
		<td>Tu estilo de música:</td>
		<td><?php echo $user->nombre_genero; ?></td>
	</tr>
<?php if($user->tipo_usu = 0){ ?>
	<tr>
		<td><label for=""></label></td>
		<td></td>
	</tr>
<?php } ?>
<?php if($user->tipo_usu == 1){ ?>
	<tr>
		<td><label for=""></label></td>
		<td></td>
	</tr>
<?php } ?>
<?php if($user->tipo_usu == 2){ ?>
	<tr>
		<td><label for=""></label></td>
		<td></td>
	</tr>
<?php } ?>
	<tr>
		<td><label for="password">Contraseña actual</label></td>
		<td><input type="password" name="password"></td>
	</tr>
	<tr>
		<td><label for="password_n">Nueva contraseña</label></td>
		<td><input type="password" name="password_n"></td>
	</tr>
	<tr>
		<td><label for="password_n_d">Repite nueva contraseña</label></td>
		<td><input type="password" name="password_n_d"></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" name="changepassword" value="Enviar"></td>
	</tr>
</table>
</form>
</div>
<?php include 'template/footer.php'; ?>