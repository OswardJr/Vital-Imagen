<?php 
require("../../config/conexion.php");
$parroquia=$_POST['municipio'];
$estados=$con->query("SELECT * FROM parroquias WHERE id_municipio='$parroquia'");
	while($row=$estados->fetch_array(MYSQLI_ASSOC)){
		$parroquias .= "<option value='$row[id_parroquia]'>$row[parroquia]</option>"; 	
	}
	echo $parroquias;
 ?>