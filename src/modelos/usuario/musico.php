<?php
class Musico extends Usuario{ 
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

	public function print_last_musics($genero = NULL, $buscar = NULL){
		if(isset($genero)){
			$query = "
			SELECT u.cod_usu, u.nombre_grupo, g.nombre
			FROM Usuario u, Genero g
			WHERE u.cod_gen = g.cod_gen
				AND tipo_usu = 2
				AND u.cod_gen = " . $genero . ";";
		}
		else{
			$query = "
			SELECT u.cod_usu, u.nombre_grupo, g.nombre
			FROM Usuario u, Genero g
			WHERE u.cod_gen = g.cod_gen
				AND tipo_usu = 2;";
		}

		if(isset($buscar)){
			$query = "
			SELECT u.cod_usu, u.nombre_grupo, g.nombre
			FROM Usuario u, Genero g
			WHERE u.cod_gen = g.cod_gen
				AND tipo_usu = 2
				AND u.nombre_grupo LIKE '%" . $buscar . "%' ORDER BY u.nombre_grupo;";
		}
		
		$result = $this->_db->query($query);
		$i = 0;
		while ($row = $result->fetch_assoc()) {
				$query = "SELECT AVG(puntuacion) FROM Votacion_Usuario WHERE cod_usu_mus = " . $row['cod_usu'] . ";";
				$resultB = $this->_db->query($query);
				$puntuacion = $resultB->fetch_assoc();
			
			$rows[$i] = $row;
			if(isset($puntuacion)){
				$rows[$i]['puntuacion'] = round($puntuacion['AVG(puntuacion)']);
				if(round($puntuacion['AVG(puntuacion)']) == 0){
					$rows[$i]['puntuacion'] = "-";
				}
			}
			else{
				$rows[$i]['puntuacion'] = "-";
			}
			
			$i++;
		}
		if(isset($rows)){
			return $rows;
		}
		else{
			return array();
		}
		
	}
	public function ver_conciertos_por_apuntar($cod_gen, $page){
		$query = "
					SELECT c.cod_con, c.nombre, u.direccion, c.comentarios, c.estado
					FROM Concierto c, Usuario u
					WHERE u.cod_usu = c.cod_usu_local
					AND c.estado = 0
					AND c.cod_gen = ".$cod_gen."
					LIMIT ". $page .", 5;
						";
		$result = $this->_db->query($query);
		if ($result) {
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
		} else{
			$rows = NULL;
		}
		$rows = (isset($rows)) ? $rows : array();
		return $rows;
	}
	public function saber_si_puede_apuntar($cod_usu, $cod_con){
		$query = "
					SELECT cod_usu_mus, cod_con
					FROM Musico_Apunta
					WHERE cod_usu_mus = ".$cod_usu."
					AND cod_con = ".$cod_con.";";
				$result = $this->_db->query($query);
				while ($row = $result->fetch_assoc()) {
					$rows[] = $row;
				}
				$rows = (isset($rows)) ? $rows : array();
				if(count($rows) == 0){
					return true;
				}
				else{
					return false;
				}
	}
	public function ver_conciertos_apuntados($cod_usu){
		$query = "
			SELECT u.direccion, mu.estado, c.cod_con
			FROM Musico_Apunta mu, Concierto c, Usuario u
			WHERE mu.cod_con = c.cod_con
			AND c.cod_usu_local = u.cod_usu
			AND mu.cod_usu_mus = ".$cod_usu.";
		";
		$result = $this->_db->query($query);
		if ($result) {
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
		} else{
			$rows = NULL;
		}
		$rows = (isset($rows)) ? $rows : array();
		return $rows;
	}

	public function apuntar_a_concierto($id_con){
		$query = "
			INSERT INTO Musico_Apunta (cod_usu_mus, cod_con, estado)
			VALUES (".$this->cod_usu.", ".$_POST['id'].", 0);
		";
		$this->_db->query($query);
		return true;
	}
	public function eliminar_apuntar_a_concierto($id_con){
		$query = "
			DELETE FROM Musico_Apunta WHERE cod_usu_mus = " . $this->cod_usu. " AND cod_con = ".$id_con.";
		";
		$this->_db->query($query);
		return true;
	}
	public function comprobar_sesion(){
		parent::comprobar_sesion();
		if ($_SESSION['tipo_usu'] != 2){
			header("Location: home_home.php");
		}
	}

	public function imprimir_estado_apunta($estado){
		switch ($estado){
			case 0:
				return "En espera";
				break;
			case 1:
				return "Confirmado";
				break;
			case 2:
				return "Rechazado";
				break;
		}
	}
	public function imprimir_votaciones(){
		$query = "
			SELECT v.puntuacion, v.comentario, u.correo as usuario_fan
			FROM Votacion_Usuario v, Usuario u, Usuario o
			WHERE v.cod_usu_fan = u.cod_usu
			AND v.cod_usu_mus = o.cod_usu
			AND cod_usu_mus = " . $this->cod_usu . ";";
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
	public function estrellas_medias(){
		$query = "SELECT AVG(puntuacion) FROM Votacion_Usuario WHERE cod_usu_mus = " . $this->cod_usu . ";";
		$result = $this->_db->query($query);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
			
		} else{
			$rows = NULL;
		}
		if(round($rows[0]['AVG(puntuacion)']) > 0){
			return round($rows[0]['AVG(puntuacion)']);
		}
		else{
			return "-";
		}

		
	}
}

?>