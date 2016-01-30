<?php
$local = new Local();
if(isset($_POST['add'])){
	$local->crearConcierto($_SESSION['cod_usu'], $_POST['genero'], $_POST['nombre'], $_POST['comentario'], $_POST['fecha']);
}
if(isset($_POST['contratar'])){
	$local->contratarMusico($_POST['contr_id_mus'], $_POST['contr_id_con']);
}
if(isset($_POST['eliminarconcierto'])){
	$local->borrarConcierto($_POST['id']);
}

$local->comprobar_sesion();

$imprimir_generos = $local->verGeneros();

$imprimir_sus_conciertos = $local->verSusConciertos($_SESSION['cod_usu']);

?>