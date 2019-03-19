<?php 
require_once("../../config/conexion.php");
$nacionalidad=$_POST['nacionalidad'];
$ced=trim($_POST['cedula']);
$cedula=$nacionalidad.'-'.$ced;
$nombres=trim($_POST['nombres']);
$apellidos=trim($_POST['apellidos']);
$sexo=$_POST['sexo'];
$nfecha=explode('/',$_POST['fecha_nacimiento']);
$fecha = "{$nfecha[2]}-{$nfecha[1]}-{$nfecha[0]}";
$edad=$_POST['edad'];
$direccion=trim($_POST['direccion']);
$telefono=trim($_POST['telefono']);
$ciudad=$_POST['ciudad'];
$parroquia=$_POST['parroquia'];
$responsable=trim($_POST['responsable']);

$sql="SELECT * FROM pacientes WHERE ced_paciente='$cedula'";
$result=$con->query($sql);
$rows=$result->num_rows;

if($rows==0){
$sql2="INSERT INTO pacientes(ced_paciente,nombres,apellidos,sexo,fecha_nacimiento,edad,telefono,id_ciudad,id_parroquia,direccion,responsable) VALUES('$cedula','$nombres','$apellidos','$sexo','$fecha','$edad','$telefono','$ciudad','$parroquia','$direccion','$responsable')";
	$result2=$con->query($sql2);

session_start();
$idUsuario=$_SESSION['id_usuario'];

$sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Insertar','Agrego un Nuevo Paciente',NOW())";
$result3=$con->query($sql3);


	echo '<script> swal({
                        title: "Paciente guardado con exito",
                        text: "",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });

                var delay = 2000;
                setTimeout(function(){ window.location = "pacientes.php"; }, delay);</script>';
}else{
	echo "<script>swal('La cedula Ingresada ya se encuentra regitrada Intentelo de nuevo','','error')</script>";
}


?>
