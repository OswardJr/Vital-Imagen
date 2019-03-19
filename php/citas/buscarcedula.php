<?php
require_once("../../config/conexion.php"); 
$ced=$_POST['cedula'];
$nacionalidad=$_POST['nacionalidad'];
$cedula=$nacionalidad.'-'.$ced;
$sql="SELECT * FROM pacientes WHERE ced_paciente='$cedula' AND status='Activo'";
$result=$con->query($sql);
$data=$result->fetch_assoc();
$rows=$result->num_rows;
 echo json_encode($data);
 ?>
