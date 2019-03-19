<?php 
sleep(1);
require("../../config/conexion.php");
if($_REQUEST) {
    $ced = $_REQUEST['cedula'];
    $nacionalidad=$_REQUEST['nacionalidad'];
    $cedula=$nacionalidad.'-'.$ced;
    $query = "SELECT * FROM doctores WHERE cedula = '".strtolower($cedula)."'";
    $results = $con->query($query);

    if($results->num_rows > 0){
        echo "<script>swal('La Cedula ingresada ya existe','','error');</script>";
    	return false;
    }else{
          echo "<script>swal('La Cedula Ingresada esta disponible','','success');";
          return false;
      }
}
 ?>