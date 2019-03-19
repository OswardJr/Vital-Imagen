<?php 
require_once("../../config/conexion.php");
$nacionalidad=$_POST['nacionalidad'];
$ced=trim($_POST['cedula']);
$cedula=$nacionalidad.'-'.$ced;
$nombre=$_POST['nombre'];
$apellido=trim($_POST['apellido']);
$sexo=$_POST['sexo'];
$telefono=trim($_POST['telefono']);
$correo=trim($_POST['correo']);
$direccion=trim($_POST['direccion']);
$especialidad=$_POST['especialidad'];
$cantidad_citas=$_POST['cantidad'];



 	$sql2="INSERT INTO doctores(cedula,nombre,apellido,sexo,telefono,correo,direccion,cantidad_citas,id_especialidad) VALUES ('$cedula','$nombre','$apellido','$sexo','$telefono','$correo','$direccion','$cantidad_citas','$especialidad')";
 	$result2=$con->query($sql2);

 	session_start();
$idUsuario=$_SESSION['id_usuario'];

$sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Insertar','Agrego un Nuevo Nuevo Doctor',NOW())";
$result3=$con->query($sql3);


 	echo '<script> swal({
                        title: "Doctor guardado con exito",
                        text: "",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });

                var delay = 2000;
                setTimeout(function(){ window.location = "doctores.php"; }, delay);</script>';
 
 ?>
