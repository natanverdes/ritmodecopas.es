<?php
	require_once 'config/config.php';
	require_once 'template/header.php';
	$musico = new Musico();
	$musico->comprobar_sesion();
	$musico->UsuDetails($_SESSION['cod_usu']);

	if(isset($_POST['apuntarconcierto'])){
		$musico->apuntar_a_concierto($_POST['id']);
	}
	if(isset($_POST['borrarapuntarconcierto'])){
		$musico->eliminar_apuntar_a_concierto($_POST['id']);
	}




	if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 0;
    }
?>
	<div id="main">
		<div id="lista-conciertos">
			<table>
				<thead>
				<tr>
					<td colspan="3">Conciertos propuestos</td>
				</tr>
				<tr>
					<td>Local</td>
					<td>Nombre del concierto</td>
					<td>Comentario</td>
					<td></td>
				</tr>
				</thead>
				<tbody>
					<?php $conciertos = $musico->ver_conciertos_por_apuntar($_SESSION['cod_gen'], $page);
						if(count($conciertos) < 1){ ?>

						<tr>
							<td colspan='4'>Sin resultados.</td>
						</tr>

					<?php } else {
						foreach ($conciertos as $concierto) { ?>
						<tr>
							<td><?php echo $concierto['direccion']; ?></td>
							<td><?php echo $concierto['nombre']; ?></td>
							<td><?php echo $concierto['comentarios']; ?></td>
							<td>
							<?php if($musico->saber_si_puede_apuntar($_SESSION['cod_usu'], $concierto['cod_con']) == true){ ?>
							<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
								<input type='hidden' name='id' value='<?php echo $concierto['cod_con']; ?>'>
								<input type="submit" name="apuntarconcierto" value="Apuntarse">
							</form>
							<?php } ?>
							</td></tr>
							<?php }} ?>
				<tr colspan="3">
					<td>
						<?php
						    $siguiente = $page+5;
    						$anterior = $page-5;
    						$query = "SELECT cod_con FROM concierto;";
   							$result = $musico->_db->query($query);
    						if($page!=0){
    							echo "<a href=admin_apunta_conciertos.php?page=".$anterior.">Anterior</a>";
    						}
    						if($siguiente<mysqli_num_rows($result)){
    							echo "<a href=admin_apunta_conciertos.php?page=".$siguiente.">Siguiente</a>";
    						}
						?>
					</td>
				</tr>
				</tbody>
			</table>
		</div>
		<div id="lista-conciertos-add">
			<table>
				<thead>
					<tr>
						<td colspan="3">Conciertos pedidos</td>
					</tr>
					<tr>
						<td>Local</td>
						<td>Estado de tu petición</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<?php $conciertos = $musico->ver_conciertos_apuntados($_SESSION['cod_usu']);
						if(count($conciertos) == 0){ ?>
				<tr>
					<td colspan='4'>Sin resultados.</td>
				</tr>
				<?php } else{ foreach ($conciertos as $concierto) { ?>
				 <tr>
				 	<td><?php echo $concierto['direccion']; ?></td>
				 	<td><?php echo $musico->imprimir_estado_apunta($concierto['estado']); ?></td>
				 	<td><form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
								<input type='hidden' name='id' value='<?php echo $concierto['cod_con']; ?>'>
								<input type="submit" name="borrarapuntarconcierto" value="Eliminar">
							</form></td>
				 </tr>
				 <?php }} ?>
				</tbody>
			</table>
		</div>
	</div>
<?php include 'template/footer.php'; ?>