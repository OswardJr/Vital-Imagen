<?php
require("conexion.php");
session_start();
$respuesta=$_POST['respuesta'];
$usuariopass=$_SESSION['recuperarPass'];
$sql="SELECT * FROM usuarios WHERE usuario='$usuariopass' AND respuesta_secreta='$respuesta'";
$result=$con->query($sql);
if($result->num_rows == 1){
	echo '<script> 
                 window.location = "nuevo_password.php"; 
          </script>';
}else{
	echo '<script>
                    swal("Error", "Respuesta incorrecta, ¡Por favor intente de nuevo!", "error");
		  </script>';
}

?>