<?php 
require_once("../../config/conexion.php");
$id=$_POST['id'];
$nombres=trim($_POST['nombres']);
$apellidos=trim($_POST['apellidos']);
$sexo=$_POST['sexo'];
$status=$_POST['status'];
$fecha=$_POST['fecha_nacimiento'];
$direccion=trim($_POST['direccion']);
$telefono_local=trim($_POST['telefono_local']);
$telefono_movil=trim($_POST['telefono_movil']);
$ciudad=$_POST['ciudad'];
$parroquia=$_POST['parroquia'];

$sql="UPDATE pacientes SET nombres='$nombres',apellidos='$apellidos',sexo='$sexo',fecha_nacimiento='$fecha',telefono_local='$telefono_local','$telefono_movil',id_ciudad='$ciudad',id_parroquia='$parroquia',direccion='$direccion',status='$status' WHERE nro_historia='$id'";
    $result2=$con->query($sql);

session_start();
$idUsuario=$_SESSION['id_usuario'];

$sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Update','Modifico un Paciente',NOW())";
$result3=$con->query($sql3);


    echo '<script> swal({
                        title: "Datos Modificados con exito",
                        text: "",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });

                var delay = 2000;
                setTimeout(function(){ window.location = "pacientes.php"; }, delay);</script>';

?>



