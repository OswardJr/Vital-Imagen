<?php 
require_once("../../config/conexion.php");
$id=$_POST['id_usuario'];
$nombre=trim($_POST['nombre']);
$apellido=trim($_POST['apellido']);
$sexo=trim($_POST['sexo']);
$usuario=trim($_POST['usuario']);
$password=trim($_POST['password']);
$pregunta=trim($_POST['pregunta']);
$respuesta=trim($_POST['respuesta']);
$correo=trim($_POST['correo']);
$sha1=sha1($password);
$confirmar=trim($_POST['confirm_password']);
$id_tipo=$_POST['id_tipo'];
$status=$_POST['status'];

$sql2="SELECT * FROM usuarios WHERE usuario='$usuario'";
$result2=$con->query($sql2);
$rows=$result2->num_rows;

	$sql="UPDATE usuarios SET nombre='$nombre',apellido='$apellido',sexo='$sexo',correo='$correo',usuario='$usuario',password='$sha1',pregunta_secreta='$pregunta',respuesta_secreta='$respuesta',status='$status',id_tipo='$id_tipo' WHERE id_usuario='$id'";
$result=$con->query($sql);
	echo '<script> swal({
                        title: "Datos del usuario modificado con Exito",
                        text: "",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });

                var delay = 2000;
                setTimeout(function(){ window.location = "usuarios.php"; }, delay);</script>';


?>
