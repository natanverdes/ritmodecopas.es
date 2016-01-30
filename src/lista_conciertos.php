<?php
	include_once 'config/config.php';

	include_once 'controladores/lista_conciertos.php';
	
	include_once 'template/header.php';
?>
<div id="main">
	<table class="alltable">
		<thead>
			<tr>
				<td>Nombre del concierto</td>
				<td>Fecha</td>
				<td>Dirección del Local</td>
				<td>Aforo</td>
				<td>Músico</td>
				<td>Género</td>
				<td>Comentario</td>
			</tr>
		</thead>
		<tbody>
		<?php if(count($rows) == 0){ ?>
			<tr>
				<td colspan='7'>
					Sin resultados.
				</td>
			</tr>
		<?php } else{ foreach ($rows as $row) {?>
			<tr>
			 			<td><?php echo $row['nombre_concierto']; ?></td>
			 			<td><?php echo date("d-m-y h:m", strtotime($row['fecha'])); ?></td>
			 			<td><?php echo $row['direccion']; ?></td>
			 			<td><?php echo $row['aforo']; ?></td>
			 			<td><?php echo $row['nombre_grupo']; ?></td>
			 			<td><?php echo $row['nombre']; ?></td>
			 			<td><?php echo $row['comentarios']; ?></td>
			 		</tr>
		<?php }} ?>
	</tbody>
	</table>
</div>

<?php
	include_once 'template/footer.php';
?>