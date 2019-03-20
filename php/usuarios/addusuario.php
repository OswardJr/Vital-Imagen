<?php 
require_once("../../config/conexion.php");
$nombre=trim($_POST['nombre']);
$apellido=trim($_POST['apellido']);
$sexo=trim($_POST['sexo']);
$usuario=trim($_POST['usuario']);
$password=trim($_POST['password']);
$sha1=sha1($password);
$pregunta=trim($_POST['pregunta']);
$respuesta=trim($_POST['respuesta']);
$correo=trim($_POST['correo']);
$sha1=sha1($password);
$confirmar=trim($_POST['confirm_password']);

$sql="SELECT * FROM usuarios WHERE usuario='$usuario'";
$result=$con->query($sql);
$rows=$result->num_rows;
 if($rows==0){
	$sql2="INSERT INTO usuarios(nombre,apellido,sexo,correo,usuario,password,pregunta_secreta,respuesta_secreta) VALUES('$nombre','$apellido','$sexo','$correo','$usuario','$sha1','$pregunta','$respuesta')";
	$result2=$con->query($sql2);
	echo '<script> swal({
                        title: "Usuario guardado con exito",
                        text: "",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });

                var delay = 2000;
                setTimeout(function(){ window.location = "usuarios.php"; }, delay);</script>';
}else{
	echo '<script>swal("El nombre de usuario ingresado ya se encuentra registrado. Intenta de nuevo","","error");</script>';
}

 ?>