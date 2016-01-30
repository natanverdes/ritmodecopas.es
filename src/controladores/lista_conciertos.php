<?php
	$concierto = new Concierto();
	if(isset($_GET['query'])){
		$query = $_GET['query'];
	}
	else{
		$query = NULL;
	}
	$rows = $concierto->print_last_concerts($query);

?>