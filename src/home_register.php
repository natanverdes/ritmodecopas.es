<?php
	include_once 'config/config.php';
	include_once 'controladores/home_register.php';
	include_once 'template/header.php';
?>
<div id="main">
	<div id="register-form">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<div id="register-form-general">
				<table>
					<?php controlar_errores(); ?>
					<tr>
						<td><label for="correo">Correo electrónico:</label></td>
						<td><input type="email" name="correo"></td>
					</tr>
					<tr>
						<td><label for="confirm_correo">Confirmar Correo electrónico:</label></td>
						<td><input type="email" name="confirm_correo"></td>
					</tr>
					<tr>
						<td><label for="contrasena">Contraseña:</label></td>
						<td><input type="password" name="contrasena"></td>
					</tr>
					<tr>
						<td><label for="confirm_contrasena">Confirmar Contraseña:</label></td>
						<td><input type="password" name="confirm_contrasena"></td>
					</tr>
					<?php /*<tr>
						<td><label for="imagen">Imagen: (No obligatoria)</label></td>
						<td><input type="file" name="imagen">
						</td>
					</tr> */ ?>
					<tr>
						<td><label for="nombre">Nombre:</label></td>
						<td><input type="text" name="nombre"></td>
					</tr>
					<tr>
						<td><label for="ciudad">Provincia:</label></td>
						<td>
							<select name="ciudad">
								<option value="" selected></option>
								<?php foreach ($ciudades as $ciudad) { ?>
									<option value="<?php echo $ciudad['cod_ciu']; ?>"><?php echo $ciudad['nombre']; ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2" id="select-register-container">
							<p id="select-register">*Seleccione una de las tres tipos de cuentas disponibles para registrar.
						</p></td>
					</tr>
				</table>
			</div>
			<div id="register-form-specific">
				<div id="local-form" onclick="
								$('#select-register').hide();

								$('#local-form').addClass('selected');
								$('#local-form input, #local-form option').prop('disabled', false);

								$('#fan-form, #music-form').removeClass('selected');
								$('#fan-form input, #fan-form option, #music-form input, #music-form option').prop('disabled', true);
								">
					<table>
						<tr>
							<td>
								<h1>LOCAL</h1>
							</td>
						</tr>
						<tr>
							<td><label for="direccion">Dirección exacta:</label></td>
							<td><input type="text" name="direccion" disabled></td>
						</tr>
						<tr>
							<td><label for="telefono">Teléfono:</label></td>
							<td><input type="number" name="telefonoL" disabled></td>
						</tr>
						<tr>
							<td><label for="aforo">Aforo:</label></td>
							<td><input type="number" name="aforo" disabled></td>
						</tr>
						<tr>
							<td colspan="2"><div class="button"><input type="submit" name="local" value="Enviar" disabled></div></td>
						</tr>
					</table>
				</div>
				<div id="fan-form" onclick="
							$('#select-register').hide();

								$('#fan-form').addClass('selected');
								$('#fan-form input, #fan-form option').prop('disabled', false);

								$('#local-form, #music-form').removeClass('selected');
								$('#local-form input, #local-form option, #music-form input, #music-form option').prop('disabled', true);
								">
					<table>
						<tr>
							<td colspan="2"><h1>FAN</h1></td></tr>
						<tr>
							<td><label for="genero">Género preferido:</label></td>
							<td><select name="genero">
								<option value="" selected></option>
								<?php foreach ($generos as $genero) { ?>
									<option value="<?php echo $genero['cod_gen']; ?>"><?php echo $genero['nombre']; ?></option>
								<?php } ?>
								</select></td>
						</tr>
						<tr>
							<td><label for="fecha_nacimiento">Fecha de nacimiento</label></td>
							<td>
							<input type="text" id="datepicker" name="fecha_nacimiento" disabled></td>
						</tr>
						<tr>
							<div class="button"><input type="submit" name="fan" value="Enviar" disabled></div>
					</table>
				</div>
				<div id="music-form" onclick="
							$('#select-register').hide();

								$('#music-form').addClass('selected');
								$('#music-form input, #music-form option').prop('disabled', false);

								$('#local-form, #fan-form').removeClass('selected');
								$('#local-form input, #local-form option, #fan-form input, #fan-form option').prop('disabled', true);
							">
					<table>
						<tr>
							<td>
								<h1>MUSICO</h1>
							</td>
						</tr>
						<tr>
							<td><label for="nombre_grupo">Nombre del grupo:</label></td>
							<td><input type="text" name="nombre_grupo" disabled></td>
						</tr>
						<tr>
							<td><label for="genero">Género que tocas:</label></td>
							<td><select name="genero">
									<option value="#" selected></option>
									<?php foreach ($generos as $genero) { ?>
										<option value="<?php echo $genero['cod_gen']; ?>">
											<?php echo $genero['nombre']; ?>
										</option>
									<?php } ?>
								</select></td>
						</tr>
						<tr>
							<td><label for="telefonoM">Teléfono:</label></td>
							<td><input type="number" name="telefonoM" disabled></td>
						</tr>

						<tr>
							<td colspan="2"><div class="button"><input type="submit" name="musico" value="Enviar" disabled></div></td>
						</tr>
					</table>
				</div>
			</div>
		</form>
	</div>
</div>
<?php
	include_once 'template/footer.php';
?>