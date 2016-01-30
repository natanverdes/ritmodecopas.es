<?php
	require_once 'config/config.php';
	require_once 'controladores/home_iniciar_sesion.php';
	require_once 'template/header.php';
?>
	<div id="main" class="login">
		<div>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<table>

				<?php if(isset($error_index_login)){ ?>
					<tr>
						<td colspan='2'>
						ERROR: Correo electrónico o usuario no válido.
						</td>
					</tr>
				<?php }?>

				<?php if(isset($_SESSION['register'])){ ?>
					<tr>
						<td colspan='2'>
						Registro completado. Verifique su email para iniciar sesión.
						</td>
					</tr>
				<?php } unset($_SESSION['register']); ?>
				<tr>
					<td><label for="user">Correo electrónico:</label></td>
					<td><input type="text" name="user"></td>
				</tr>
				<tr>
					<td>Contraseña:</td>
					<td><input type="password" name="password"></td>
				</tr>
				<tr>
					<td></td>
					<td><input class="submit" type="submit" name="submit" value="Entrar" style="float: right;"></td>
				</tr>
			</table>
		</form>
		</div>
	</div>
<?php include 'template/footer.php'; ?>