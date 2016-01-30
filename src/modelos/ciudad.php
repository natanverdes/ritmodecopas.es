<?php
class Ciudad extends Modelo{
	function imprimir_ciudades($con){
		$query = "SELECT cod_ciu, nombre FROM Ciudad ORDER BY nombre asc;";
		$resultado = mysqli_query($con, $query);
		mysqli_num_rows($resultado);
		while($row = mysqli_fetch_assoc($resultado)){
			echo "<option value='".$row['cod_ciu']."'>".$row['nombre']."</option>";
		}
	}
}
?>