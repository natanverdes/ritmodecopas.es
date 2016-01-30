<?php
class Fan extends Usuario{ 
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
			if ($_SESSION['tipo_usu'] != 0){
				header("Location: home_home.php");
			}
	}
	public function PublicarVotacion($cod_mus, $valoracion, $comentario){
		$query = "INSERT INTO Votacion_Usuario VALUES (" . $this->cod_usu . ", " . $cod_mus . ", " . $valoracion . ", '" . $comentario . "');";
		$this->_db->query($query);
	}
	public function HaVotado($cod_mus){
		$query = "SELECT cod_usu_mus FROM Votacion_Usuario WHERE cod_usu_fan = " . $this->cod_usu . ";";
		$result = $this->_db->query($query);
		if($result->num_rows > 0){
			return true;
		}
		else{
			return false;
		}
	}
}

?>