<?php 
sleep(1);
require("../../config/conexion.php");
if($_REQUEST) {
    $cedula = $_REQUEST['cedula'];
    $nacionalidad=$_REQUEST['nacionalidad'];
    $query = "SELECT * FROM pacientes WHERE nac_paciente='$nacionalidad' AND ced_paciente='$cedula'";
    $results = $con->query($query);

    if($results->num_rows > 0){
        echo "<script>swal('La cedula ingresada ya existe','','error');</script>";
    	return false;
    }else{
          echo "<script>swal('La cedula Ingresada esta disponible','','success');";
          return false;
      }
}
 ?>