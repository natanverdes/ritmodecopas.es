<?php
class Usuario extends Modelo{
	public $FuncionEspecial;

	public $cod_usu;
	public $correo;
	private $contrasena;
	public $nombre_tipo_usu;
	public $tipo_usu;
	public $imagen;
	public $nombre;
	public $cod_ciu;
	public $cod_gen;
	public $nombre_genero;
	public $fecha_nacimiento;
	public $direccion;
	public $telefono;
	public $aforo;
	public $nombre_grupo;

	private static $opciones = array('cost' => 8, 'salt' => "A2daw3nKurd1st4nyArdaw5nKurd6stany");
	
	public function __construct($cod_usu = NULL){
		parent::__construct();
		if(func_num_args() == 1){
			$this->UsuDetails($cod_usu);
			switch ($this->nombre_tipo_usu) {
				case 'Fan':
					$this->FuncionEspecial = new Fan($this->cod_usu);
					break;
				
				case 'Local':
					$this->FuncionEspecial = new Local($this->cod_usu);
					break;
				case 'Músico':
					$this->FuncionEspecial = new Musico($this->cod_usu);
					break;
			}
		}
	}
	public function __destruct(){
		parent::__destruct();
	}

	public function UsuDetails($cod_usu){
		$query = "
			SELECT u.cod_usu, u.correo, u.contrasena, u.tipo_usu, u.imagen, u.nombre, u.cod_ciu, u.cod_gen, g.nombre as nombre_genero, u.fecha_nacimiento, u.direccion, u.telefono, u.aforo, u.nombre_grupo
			FROM Usuario u, Genero g
			WHERE u.cod_gen = g.cod_gen
			AND cod_usu = ".$cod_usu.";";
		
		$result = $this->_db->query($query);
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
		if(count($rows) == 1){
				$this->cod_usu = $rows[0]['cod_usu'];
				$this->correo = $rows[0]['correo'];
				$this->contrasena = $rows[0]['contrasena'];
				$this->tipo_usu = $rows[0]['tipo_usu'];
				$this->nombre_tipo_usu = $this->nombre_tipo($this->tipo_usu);
				$this->imagen = $rows[0]['imagen'];
				$this->nombre = $rows[0]['nombre'];
				$this->cod_ciu = $rows[0]['cod_ciu'];
				$this->cod_gen = $rows[0]['cod_gen'];
				$this->nombre_genero = $rows[0]['nombre_genero'];
				$this->fecha_nacimiento = $rows[0]['fecha_nacimiento'];
				$this->direccion = $rows[0]['direccion'];
				$this->telefono = $rows[0]['telefono'];
				$this->aforo = $rows[0]['aforo'];
				$this->nombre_grupo = $rows[0]['nombre_grupo'];
				return true;
		}
		else{
			return false;
		}
	}
	public function login($Pcorreo, $Pcontrasena){
		$this->correo = $Pcorreo;
		$this->password = password_hash($Pcontrasena, PASSWORD_BCRYPT, self::$opciones);
		
		$query = "
			SELECT * FROM Usuario
			WHERE correo= '" . $this->correo . "'
			AND contrasena= '" . $this->password . "'
			AND token is NULL;
			";


		/*$stmt = mysqli_prepare($this->_db, $query);
		mysqli_stmt_bind_param($stmt, 'ss', $this->correo, $this->password);
		mysqli_stmt_execute($stmt);

		$result = mysqli_stmt_get_result($stmt);*/

		$result = $this->_db->query($query);
		$i = 0;
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
			$i++;
		}
		if($i == 0){$rows = array();}

		if(count($rows) == 1){
			$this->cod_usu = $rows[0]['cod_usu'];
			$this->UsuDetails($this->cod_usu);

			return true;
		}
		else{
			return false;
		}
	}
	public function cambiarPassword($oldpass, $newpass){
		if($this->contrasena == password_hash($oldpass, PASSWORD_BCRYPT, self::$opciones)){

			$this->contrasena = password_hash($newpass, PASSWORD_BCRYPT, self::$opciones);
			$query = "UPDATE Usuario SET contrasena = '" . $this->contrasena . "' WHERE cod_usu = " . $this->cod_usu . ";";
			$this->_db->query($query);
			return true;
		}
		else{
			return false;
		}

	}


	public function IsRegisteredUser($correo){
		$query = "SELECT correo FROM Usuario WHERE correo = '".$correo."';";
		$result = $this->_db->query($query);
		if($result->num_rows >= 1){
			return true;
		}
		else{
			return false;
		}
	}




	//////////////////////////////////////////////
	///////////////// REGISTROS
	//////////////////////////////////////////////
	public function validarUsuario($token){
		$query = "UPDATE Usuario SET token = NULL WHERE token = '" . $token . "';";
		$result = $this->_db->query($query);
		echo $query;
	}

	public function RegistrarFan($correo, $contrasena, $nombre, $ciudad, $genero){
		$token = Mail::newValidationMail($correo);


		$query = "INSERT INTO Usuario (cod_usu, tipo_usu, correo, contrasena, nombre, cod_ciu, cod_gen, fecha_nacimiento, token)
					VALUES (NULL, 0, '".$correo."', '".password_hash($contrasena, PASSWORD_BCRYPT, self::$opciones)."', '".$nombre."', '".$ciudad."', '".$genero."', '".date_format(date_create($fecha_nacimiento), 'Y-m-d')."', '" . $token. "')";

		$this->_db->query($query);
		return true;
	}
	
	public function RegistrarLocal($correo, $contrasena, $nombre, $ciudad, $direccion, $aforo, $telefonoL){
		$token = Mail::newValidationMail($correo);

		$query = "INSERT INTO Usuario (cod_usu, tipo_usu, correo, contrasena, nombre, cod_ciu, direccion, aforo, telefono, cod_gen, token)
							VALUES (NULL, 1, '".$correo."', '".password_hash($contrasena, PASSWORD_BCRYPT, self::$opciones)."', '".$nombre."', '".$ciudad."', '".$direccion."', '".$aforo."', '".$telefonoL."', 19, '" . $token . "')";
		$this->_db->query($query);
		return true;
	}

	public function RegistrarMusico($correo, $contrasena, $nombre, $ciudad, $genero, $telefonoM, $nombre_grupo){
		$token = Mail::newValidationMail($correo);

		$query = "INSERT INTO Usuario (cod_usu, tipo_usu, correo, contrasena, nombre, cod_ciu, cod_gen, telefono, nombre_grupo, token)
							VALUES (NULL, 2, '".$correo."', '".password_hash($contrasena, PASSWORD_BCRYPT, self::$opciones)."', '".$nombre."', '".$ciudad."', '".$genero."', '".$telefonoM."', '".$nombre_grupo."', '" . $token . "')";
		$this->_db->query($query);
		return true;
	}









	public function nombre_tipo($tipo){
		switch ($tipo) {
			case 0:
				return "Fan";
				break;
			
			case 1:
				return "Local";
				break;
			case 2:
				return "Músico";
				break;
		}
	}
	public function comprobar_sesion(){
		if (!isset($_SESSION['cod_usu'])){
			header("Location: home_home.php");
		}
	}
	public function verGeneros(){
		$query = "SELECT cod_gen, nombre FROM Genero ORDER BY nombre asc;";
		$result = $this->_db->query($query);

		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
		return $rows;
	}
	public function verCiudades(){
		$query = "SELECT cod_ciu, nombre FROM Ciudad ORDER BY nombre asc;";
		$result = $this->_db->query($query);
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
		return $rows;
	}

	public function Buscar($POST){
		$tipo_busqueda = $POST['desplegable'];
		$query = "";
		switch ($tipo_busqueda) {
			case '1':
				$query = "SELECT * FROM Usuario WHERE tipo = 1";
				break;
			
			case '2':
				$query = "SELECT * FROM Usuario WHERE tipo = 2";
				break;
			case '3':
				$query = "SELECT * FROM Concierto WHERE 1 = 1";
			break;
		}
		if(!empty($POST['genero'])){
			$query = $query . "and cod_gen = " . $POST['genero'];
		}
		if(!empty($POST['nombre'])){
			$query = $query . " AND nombre like '%" . $POST['nombre'] . "%'";
		}
	}

}
?>