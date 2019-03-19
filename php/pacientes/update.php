<?php 
require_once("../../config/conexion.php");
$cedula=$_POST['cedula'];
$nombres=trim($_POST['nombres']);
$apellidos=trim($_POST['apellidos']);
$sexo=$_POST['sexo'];
$status=$_POST['status'];
$nfecha=explode('/',$_POST['fecha_nacimiento']);
$fecha = "{$nfecha[2]}-{$nfecha[1]}-{$nfecha[0]}";
$edad=trim($_POST['edad']);
$direccion=trim($_POST['direccion']);
$telefono=trim($_POST['telefono']);
$ciudad=$_POST['ciudad'];
$parroquia=$_POST['parroquia'];
$responsable=trim($_POST['responsable']);

$sql="UPDATE pacientes SET nombres='$nombres',apellidos='$apellidos',sexo='$sexo',fecha_nacimiento='$fecha',edad='$fecha',telefono='$telefono',id_ciudad='$ciudad',id_parroquia='$parroquia',direccion='$direccion',responsable='$responsable',status='$status' WHERE ced_paciente='$cedula'";
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



