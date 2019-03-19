<?php 
require_once("../../config/conexion.php");
$id=$_POST['id'];
$nombre_especialidad=$_POST['nombre_especialidad'];
$descripcion_especialidad=$_POST['descripcion_especialidad'];
$sql="UPDATE especialidades SET nombre_especialidad='$nombre_especialidad' WHERE id_especialidad='$id'";
$result=$con->query($sql);

session_start();
$idUsuario=$_SESSION['id_usuario'];

$sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Update','Modifico los datos de una especialidad',NOW())";
$result3=$con->query($sql3);


echo '<script> swal({
                        title: "Especialidad modificada con exito",
                        text: "",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });

                var delay = 2000;
                setTimeout(function(){ window.location = "especialidades1.php"; }, delay);</script>';
 ?>