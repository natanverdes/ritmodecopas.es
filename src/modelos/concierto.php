<?php
class Concierto extends Modelo{
	protected $modelo;

	public function __construct(){
		parent::__construct();
	}

	public function __destruct(){
		parent::__destruct();
	}

	public function print_last_concerts($buscar = NULL){
		$query = "
			SELECT u1.direccion, u1.aforo, u2.nombre_grupo, g.nombre, c.nombre as nombre_concierto, c.fecha, c.comentarios
			FROM Usuario u1, Usuario u2, Genero g, Concierto c
			WHERE c.cod_usu_local = u1.cod_usu
				AND c.cod_usu_mus = u2.cod_usu
				AND c.cod_gen = g.cod_gen
				AND c.estado = 1;";
		if(isset($buscar)){
			$query = "
			SELECT u1.direccion, u1.aforo, u2.nombre_grupo, g.nombre, c.nombre as nombre_concierto, c.fecha, c.comentarios
			FROM Usuario u1, Usuario u2, Genero g, Concierto c
			WHERE c.cod_usu_local = u1.cod_usu
				AND c.cod_usu_mus = u2.cod_usu
				AND c.cod_gen = g.cod_gen
				AND c.estado = 1
				AND c.nombre LIKE '%" . $buscar . "%' ORDER BY c.nombre;";
		}


		$result = $this->_db->query($query);
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
		

		$rows = (isset($rows)) ? $rows : array();

		return $rows;
	}
	public function ultimos_conciertos(){
		$query = "
			SELECT c.nombre, c.fecha, u1.direccion as local, u2.nombre_grupo as musico
			FROM Usuario u1, Usuario u2, Genero g, Concierto c
			WHERE c.cod_usu_local = u1.cod_usu
				AND c.cod_usu_mus = u2.cod_usu
				AND c.cod_gen = g.cod_gen
				AND c.estado = 1;";
		$result = $this->_db->query($query);
		$i = 0;
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
			$i++;
		}
		if($i == 0){
			$rows = array();
		}

		return $rows;
	}



	public function imprimir_estado_concierto($estado){
	switch ($estado) {
		case 1:
			return "Confirmado";
			break;
		
		case 0:
			return "Por confirmar";
			break;
	}
}
}

?>

