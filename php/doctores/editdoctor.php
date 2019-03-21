<?php
require_once("../../config/conexion.php");
$id=$_POST['id_doctor'];
$nombre=trim(strtoupper($_POST['nombre']));
$apellido=trim(strtoupper($_POST['apellido']));
$sexo=$_POST['sexo'];
$telefono=trim($_POST['telefono']);
$correo=trim($_POST['correo']);
$direccion=trim(strtoupper($_POST['direccion']));
$status=$_POST['status'];

 
 	$sql2="UPDATE doctores SET nombres='$nombre',apellidos='$apellido',sexo='$sexo',telefono='$telefono',correo='$correo',direccion='$direccion',status='$status' WHERE id_doctor='$id'";
 	$result2=$con->query($sql2);

 	session_start();
$idUsuario=$_SESSION['id_usuario'];

$sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Update','Modifico un Doctor',NOW())";
$result3=$con->query($sql3);

if($result2){
 	echo '<script> swal({
                        title: "Datos guardados con exito",
                        text: "",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });

                var delay = 2000;
                setTimeout(function(){ window.location = "doctores.php"; }, delay);</script>';
 }
 ?>