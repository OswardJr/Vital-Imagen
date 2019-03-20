<?php 
sleep(1);
require("../../config/conexion.php");
if($_REQUEST) {
    $cedula = $_REQUEST['cedula'];
    $nacionalidad=$_REQUEST['nacionalidad'];
    $query = "SELECT * FROM doctores WHERE nac_doctor = '$nacionalidad' AND ced_doctor='$cedula'";
    $results = $con->query($query);

    if($results->num_rows > 0){
        echo "<script>swal('La cedula ingresada ya existe','','error');</script>";
    	return false;
    }else{
          echo "<script>swal('La cedula ingresada esta disponible','','success');";
          return false;
      }
}
 ?>