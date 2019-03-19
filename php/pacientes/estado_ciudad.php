<?php 
require("../../config/conexion.php");
$estado=$_POST['estado'];
$estados=$con->query("SELECT * FROM ciudades WHERE id_estado='$estado'");
	while($row=$estados->fetch_array(MYSQLI_ASSOC)){
		$ciudades .= "<option value='$row[id_ciudad]'>$row[ciudad]</option>"; 	
	}
	echo $ciudades;
 ?>
