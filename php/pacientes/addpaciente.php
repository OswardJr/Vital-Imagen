<?php 
require_once("../../config/conexion.php");

$nac_paciente=$_POST['nacionalidad'];
$ced_paciente=trim($_POST['cedula']);
$nombres=trim(strtoupper($_POST['nombres']));
$apellidos=trim(strtoupper($_POST['apellidos']));
$sexo=$_POST['sexo'];
$fecha=trim($_POST['fecha_nacimiento']);
$direccion=strtoupper($_POST['direccion']);
$telefono_local=$_POST['telefono_local'];
$telefono_movil=$_POST['telefono_movil'];
$estado=$_POST['estado'];
$ciudad=$_POST['ciudad'];
$parroquia=$_POST['parroquia'];

$sql="SELECT * FROM pacientes WHERE nac_paciente='$nac_paciente' AND ced_paciente='$cedula'";
$result=$con->query($sql);
$rows=$result->num_rows;

if($rows==0){
$sql2="INSERT INTO pacientes(nac_paciente,ced_paciente,nombres,apellidos,sexo,fecha_nacimiento,telefono_local,telefono_movil,id_estado,id_ciudad,id_parroquia,direccion) VALUES('$nac_paciente','$ced_paciente','$nombres','$apellidos','$sexo','$fecha','$telefono_local','$telefono_movil','$estado','$ciudad','$parroquia','$direccion')";
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
	echo "<script>swal('La cedula ingresada ya se encuentra regitrada, intentalo de nuevo','','error')</script>";
}
?>
