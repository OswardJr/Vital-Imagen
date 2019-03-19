<?php
require_once("../../config/conexion.php");
$id=$_POST['id_doctor'];
$nombre=trim($_POST['nombre']);
$status=$_POST['status'];
$apellido=trim($_POST['apellido']);
$sexo=$_POST['sexo'];
$telefono=trim($_POST['telefono']);
$correo=trim($_POST['correo']);
$direccion=trim($_POST['direccion']);
$id_especialidad=$_POST['especialidad'];
$cantidad_citas=$_POST['cantidad'];
 
 	$sql2="UPDATE doctores SET nombre='$nombre',apellido='$apellido',sexo='$sexo',telefono='$telefono',correo='$correo',direccion='$direccion',cantidad_citas='$cantidad_citas',status='$status',id_especialidad='$id_especialidad' WHERE id_doctor='$id'";
 	$result2=$con->query($sql2);

 	session_start();
$idUsuario=$_SESSION['id_usuario'];

$sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Update','Modifico un Doctor',NOW())";
$result3=$con->query($sql3);


 	echo '<script> swal({
                        title: "Datos del doctor modificados con Exito",
                        text: "",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });

                var delay = 2000;
                setTimeout(function(){ window.location = "doctores.php"; }, delay);</script>';
 
 ?>