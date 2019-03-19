<?php
require_once("../../config/conexion.php"); 
$sql="SELECT p.*,c.id_citas,c.fecha_cita,c.hora FROM pacientes AS p INNER JOIN citas AS c ON p.ced_paciente=c.ced_paciente WHERE c.status_atencion='Pendiente'";
$result=$con->query($sql);
$data=[];
while($resultado = $result->fetch_assoc())
{
	$data[] = [
'title'=>$resultado['hora'] ." ".$resultado['nombres'],
'date'=> $resultado['fecha_cita'],
'url'=> 'nuevaconsulta.php?id='.$resultado['id_citas']
	];
}

 echo json_encode($data);
 ?>