<?php
	$musico = new Musico();
	if(isset($_GET['genero'])){
		if($_GET['genero'] != ""){
			$genero = $_GET['genero'];
		}
		else{
			$genero = NULL;
		}
	}
	else{
		$genero = NULL;
	}

	if(isset($_GET['query'])){
		$query = $_GET['query'];
	}
	else{
		$query = NULL;
	}


	$rows = $musico->print_last_musics($genero, $query);
?>