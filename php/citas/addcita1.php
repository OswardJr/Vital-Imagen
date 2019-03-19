<?php 
require_once("../../config/conexion.php");
date_default_timezone_set('America/Caracas');
$ced=trim($_POST['cedula']);
$nacionalidad=$_POST['nacionalidad'];
$cedula=$nacionalidad.'-'.$ced;
$doctor=$_POST['id_doctor'];
$doctores=$con->query("SELECT COUNT(*) FROM citas INNER JOIN doctores ON citas.id_doctor=doctores.id_doctor WHERE citas.id_doctor='$doctor' AND doctor.status_atencin='Pendiente'");
$d=$con->query("SELECT * FROM doctores WHERE id_doctor='$doctor'");
$di=mysqli_fetch_assoc($d);
$nfecha=explode('/',$_POST['fecha_cita']);
$fecha ="{$nfecha[2]}-{$nfecha[1]}-{$nfecha[0]}";
$fecha2=$nfecha[0]."-".$nfecha[1];
$weekday = date("w", strtotime($fecha));
$hora=$_POST['hora']; 
$feriados  = array(  
                            '05-07','24-07','31-12'); 

    if($weekday == 0 || $weekday == 6){ 
        echo '<script>swal("La fecha ingresada es un fin de semana","","error");</script>';
        return false; 

    }else if(in_array($fecha2, $feriados)){ 
            echo '<script>swal("La fecha Ingresada es un dia festivo","","error");</script>';
            return false; 
    }else if($doctores[0]>$di['cantidad_citas']){
        echo '<script>swal("El doctor ha excedido la cantidad de citas por dia","","error");</script>';
        return false;
    }else{ 
       
$sql="INSERT INTO citas(ced_paciente,id_doctor,fecha_cita,hora) VALUES ('$cedula','$doctor','$fecha','$hora')";
$result=$con->query($sql);

session_start();
$idUsuario=$_SESSION['id_usuario'];

$sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Insertar','Inserto una nueva Cita',NOW())";
$result3=$con->query($sql3);

echo '<script>swal({
                        title: "Cita guardada con exito",
                        text: "",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });

                var delay = 2000;
                setTimeout(function(){ window.location = "citas.php"; }, delay);</script>';
    }
 ?>