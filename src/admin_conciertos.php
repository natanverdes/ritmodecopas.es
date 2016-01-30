<?php
	require_once 'config/config.php';
	require_once 'controladores/admin_conciertos.php';
	require_once 'template/header.php';
?>
	<div id="main" style="padding-top: 50px;">
		<div id="crear-concierto">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<table style="width: 50%; margin: 0 auto;">
					<tr>
						<td colspan="2">Añadir Concierto</td>
					</tr>
					<tr>
						<td><label for="genero">Género:</label></td>
						<td><select name="genero">
								<option value="#" selected></option>
								<?php foreach ($imprimir_generos as $genero_imprimido) { ?>
								<option value="<?php echo $genero_imprimido['cod_gen']; ?>">
									<?php echo $genero_imprimido['nombre']; ?>
								</option>
								<?php } ?>

							</select>
						</td>
					</tr>
					<tr>
						<td><label for="nombre">Nombre:</label></td>
						<td><input type="text" name="nombre"></td>
					</tr>
					<tr>
						<td><label for="comentario">Comentario:</label></td>
						<td><input type="text" name="comentario"></td>
					</tr>
					<tr>
						<td><label for="fecha">Fecha:</label></td>
						<td><input type="text" id="datetimepicker" name="fecha"></td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" name="add" value="Añadir">
						</td>
					</tr>
				</table>
			</form>
		</div>
		<div id="lista-tus-conciertos">
				<table style="width: 50%; margin: 0 auto;">
					<thead>
					<tr>
						<td>Nombre del concierto</td>
						<td>Fecha</td>
						<td>Género</td>
						<td>Comentario</td>
						<td>Estado</td>
						<td></td>
					</tr>
					</thead>
					<tbody>

						<?php if(count($imprimir_sus_conciertos) == 0){ ?>



							<tr>
								<td colspan='4'>Sin resultados.</td>
							</tr>
							<?php } else{ foreach ($imprimir_sus_conciertos as $concierto) { ?>
								<tr>
									<td><?php echo $concierto['nombre']; ?></td>
									<td><?php echo $concierto['fecha']; ?></td>
						 			<td><?php echo $concierto['nombre_genero']; ?></td>
						 			<td><?php echo $concierto['comentarios']; ?></td>
						 			<td><?php echo ($concierto['estado'] == 0) ? "En espera" : "Confirmado"; ?></td>
						 			<td>
						 				<?php if($concierto['estado'] == 0){ ?>
						 				<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post"><input type="hidden" name="id" value="<?php echo $concierto['cod_con']; ?>"><input type="submit" name="eliminarconcierto" value="Eliminar"></form>
						 				<?php } ?>
						 			</td>
						 		</tr>
								<?php $musicos_apuntados = $local->verSusConfirmaciones($concierto['cod_con']); if(count($musicos_apuntados) > 0){ ?>
									<tr>
										<td colspan='5'>
											<table style='margin-left: 35px;'>
											<thead>
												<tr>
													<td>Nombre del grupo apuntado</td>
													<td>¿Contratar?</td>
												</tr>
											</thead>
											<tbody>
									<?php foreach ($musicos_apuntados as $musico) { ?>
											<tr>
												<td><?php echo $musico['nombre_grupo']; ?></td>
													<?php if($musico['estado'] == 0 && $musico['estado'] == 0){ ?>
															<td>
															<form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post'>
																<input type='hidden' name='contr_id_mus' value='<?php echo $musico['cod_usu']; ?>'>
																<input type='hidden' name='contr_id_con' value='<?php echo $concierto['cod_con']; ?>'>
																<input type='submit' name='contratar' value='Contratar'>
															</form>
															</td>
															
													<?php } else if($musico['estado'] == 1){ ?>
														 	<td>¡Contratado!</td>
													<?php } else{ ?>
															<td>No contratado</td>
													<?php } ?>
											</tr>
												<?php } ?>
										</tbody></table></td></tr>
									<?php } ?>
							<?php } ?>
						<?php } ?>
					</tbody>
				</table>
		</div>
	</div>
<?php include 'template/footer.php'; ?>