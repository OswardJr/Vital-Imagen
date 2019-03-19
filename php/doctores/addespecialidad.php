<?php
session_start();
$idUsuario=$_SESSION['id_usuario'];
require_once("../../config/conexion.php");
$nombre=$_POST['nombre_especialidad'];

$sql="INSERT INTO especialidades(nombre_especialidad) VALUES ('$nombre')";

$sql2="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Insertar','Agrego una especialidad',NOW())";

$result=$con->query($sql);
$result2=$con->query($sql2);


echo '<script> swal({
                        title: "Especialidad guardada con exito",
                        text: "",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });

                var delay = 2000;
                setTimeout(function(){ window.location = "especialidades1.php"; }, delay);</script>';
