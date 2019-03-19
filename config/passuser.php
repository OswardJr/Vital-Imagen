<?php
require("conexion.php");
session_start();
$usuario=$_POST['usuario'];
$sql="SELECT * FROM usuarios WHERE usuario='$usuario'";
$result=$con->query($sql);
if($result->num_rows == 1){
	$_SESSION['recuperarPass']=$usuario;
	echo '<script> 
                 window.location = "preguntas-pass.php"; 
          </script>';
}else{
	echo '<script>
                    swal("Error", "Nombre de Usuario ingresado no coincide con los registros, por vavor ingrese un correo existente.", "error");
		  </script>';
}

?>