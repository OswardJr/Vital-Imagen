<?php 
require("../../config/conexion.php");


foreach ($_POST['idconsulta'] as $ids) {
	$diagnostico=mysqli_real_escape_string($con,$_POST['diagnostico'][$ids]);
	$idconsulta=mysqli_real_escape_string($con,$_POST['idconsulta'][$ids]);



	$sql="UPDATE consultas SET diagnostico='$diagnostico' WHERE id_consulta='$ids'";
	$r=$con->query($sql);

}

echo '<script>swal("Historial Guardado con exito","","success");</script>';
