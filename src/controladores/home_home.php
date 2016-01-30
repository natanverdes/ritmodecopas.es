<?php

	if(isset($_POST['buscar'])){
		switch ($_POST['tipo_busqueda']) {
			case 1:
				header("Location: lista_musicos.php?" . http_build_query(array("query" => $_POST['nombre'])));
				break;
			
			case 2:
				header("Location: lista_locales.php?" . http_build_query(array("query" => $_POST['nombre'])));
				break;
			case 3:
				header("Location: lista_conciertos.php?" . http_build_query(array("query" => $_POST['nombre'])));
				break;
		}

	}
?>