<?php 
require_once("../../config/conexion.php");
$id=$_POST['id'];
$nombre=trim(strtoupper($_POST['nombre']));
$descripcion=trim(strtoupper($_POST['descripcion']));
$status=$_POST['status'];

$sql2="UPDATE servicios SET nombre_servicio='$nombre',descripcion='$descripcion',status='$status' WHERE id_servicio='$id'";
$result2=$con->query($sql2);

session_start();
$idUsuario=$_SESSION['id_usuario'];

$sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Insertar','Edito un servicio',NOW())";
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
                setTimeout(function(){ window.location = "servicios.php"; }, delay);</script>';
  } 
 ?>
