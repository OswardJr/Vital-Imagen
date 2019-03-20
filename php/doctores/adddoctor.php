<?php 
require_once("../../config/conexion.php");
$nacionalidad=$_POST['nacionalidad'];
$cedula=trim($_POST['cedula']);
$nombre=trim(strtoupper($_POST['nombre']));
$apellido=trim(strtoupper($_POST['apellido']));
$sexo=$_POST['sexo'];
$telefono=trim($_POST['telefono']);
$correo=trim($_POST['correo']);
$direccion=trim(strtoupper($_POST['direccion']));



 	$sql2="INSERT INTO doctores(nac_doctor,ced_doctor,nombres,apellidos,sexo,telefono,correo,direccion) VALUES ('$nacionalidad','$cedula','$nombre','$apellido','$sexo','$telefono','$correo','$direccion')";
 	$result2=$con->query($sql2);

 	session_start();
$idUsuario=$_SESSION['id_usuario'];

$sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Insertar','Agrego un Nuevo Nuevo Doctor',NOW())";
$result3=$con->query($sql3);

if($sql2){
 	echo '<script> swal({
                        title: "Doctor guardado con exito",
                        text: "",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });

                var delay = 2000;
                setTimeout(function(){ window.location = "doctores.php"; }, delay);</script>';
  }
 
 ?>
