<?php
class Local extends Usuario{
	public $cod_usu;

	
	public function __construct($cod_usu = NULL){
		Modelo::__construct();
		if(func_num_args() == 1){
			$this->cod_usu = $cod_usu;
		}
		
	}
		public function __destruct(){
		parent::__destruct();
	}
	public function comprobar_sesion(){
			parent::comprobar_sesion();
			if ($_SESSION['tipo_usu'] != 1){
				header("Location: home_home.php");
			}
	}
	public function crearConcierto($cod_usu_local, $cod_gen, $nombre, $comentario, $fecha){
		$query = "
			INSERT INTO Concierto (cod_usu_local, cod_gen, estado, comentarios, nombre, fecha)
			VALUES (?, ?, 0, ?, ?, ?);";
		$stmt = mysqli_prepare($this->_db, $query);
		mysqli_stmt_bind_param($stmt, 'iisss', $cod_usu_local, $cod_gen, $comentario, $nombre, $fecha);
		mysqli_stmt_execute($stmt);
	}
	public function borrarConcierto($cod_con){
		$query = "DELETE FROM Concierto WHERE cod_con = " . $cod_con . ";";
		$query2 = "DELETE FROM Musico_Apunta WHERE cod_con = " . $cod_con . ";";
		$this->_db->query($query);
		return true;
	}


	public function contratarMusico($contr_id_mus, $contr_id_con){
		$query = "UPDATE Musico_Apunta SET estado = 1 WHERE cod_usu_mus = ? AND cod_con = ?;";
		$query2 = "UPDATE Concierto SET estado = 1, cod_usu_mus = ? WHERE cod_con = ?;";


		$stmt = mysqli_prepare($this->_db, $query);
		mysqli_stmt_bind_param($stmt, 'ii', $contr_id_mus, $contr_id_con);
		mysqli_stmt_execute($stmt);

		$stmt2 = mysqli_prepare($this->_db, $query2);
		mysqli_stmt_bind_param($stmt2, 'ii', $contr_id_mus, $contr_id_con);
		mysqli_stmt_execute($stmt2);

	}
	public function verSusConciertos($id){
		$query = "
					SELECT cod_con, c.nombre, g.nombre as nombre_genero, estado, comentarios, fecha
					FROM Concierto c, Genero g
					WHERE c.cod_gen = g.cod_gen
					AND cod_usu_local = ".$id.";
				";


		$result = $this->_db->query($query);
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
		$rows = (isset($rows)) ? $rows : array();
		return $rows;
	}
	public function verSusConfirmaciones($id){
		$query = "
			 		SELECT u.nombre_grupo, u.cod_usu, m.estado
			 		FROM Usuario u, Musico_Apunta m
			 		WHERE u.cod_usu = m.cod_usu_mus
			 		AND m.cod_con = ".$id.";";
		$result = $this->_db->query($query);
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
		$rows = (isset($rows)) ? $rows : array();
		return $rows;
	}
	public function isVoted($cod_mus){
		
	}

	public function print_last_locales($ciudad = NULL, $buscar = NULL){
		if(isset($ciudad)){
			$query = "
			SELECT u.nombre, u.direccion, u.aforo, c.nombre as nombre_ciudad
			FROM Usuario u, Ciudad c
			WHERE c.cod_ciu = u.cod_ciu
				AND tipo_usu = 1
				AND c.cod_ciu = " . $ciudad . ";";
		}
		else{
			$query = "
			SELECT u.nombre, u.direccion, u.aforo, c.nombre as nombre_ciudad
			FROM Usuario u, Ciudad c
			WHERE c.cod_ciu = u.cod_ciu
				AND tipo_usu = 1;";
		}

		if(isset($buscar)){
			$query = "
			SELECT u.nombre, u.direccion, u.aforo, c.nombre as nombre_ciudad
			FROM Usuario u, Ciudad c
			WHERE c.cod_ciu = u.cod_ciu
				AND tipo_usu = 1
			AND u.nombre LIKE '%" . $buscar . "%' ORDER BY u.nombre;";
		}

		$result = $this->_db->query($query);
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
		$rows = (isset($rows)) ? $rows : array();
		return $rows;
	}


}

?>