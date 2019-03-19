<?php 
require("../../config/conexion.php");
$estado=$_POST['estado'];
$estados=$con->query("SELECT * FROM municipios WHERE id_estado='$estado'");
	while($row=$estados->fetch_array(MYSQLI_ASSOC)){
		$municipios .= "<option value='$row[id_municipio]'>$row[municipio]</option>"; 	
	}
	echo $municipios;
 ?>
