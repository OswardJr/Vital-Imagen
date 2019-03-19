<?php 
require_once("../../config/conexion.php");
date_default_timezone_set('America/Caracas');
$cedula=trim($_POST['cedula']);
$doctor=trim($_POST['id_doctor']);
$nfecha=explode('/',$_POST['fecha_cita']);
$d=date();
$fecha ="{$nfecha[2]}-{$nfecha[1]}-{$nfecha[0]}";
$fecha2=$nfecha[0]."-".$nfecha[1];
$weekday = date("w", strtotime($fecha));
$hora=$_POST['hora']; 
$feriados  = array( 
                            '01-01', 
                            '10-04', 
                            '11-04', 
                            '01-05'); 

    if($weekday == 0 || $weekday == 6){ 
        echo '<script>swal("La fecha ingresada es un fin de semana","","error");</script>';
        return false; 

    }else if(in_array($fecha2, $feriados)){ 
            echo '<script>swal("La fecha Ingresada es un dia festivo","","error");</script>';
            return false; 
    }else if($fecha ==! $d){
        echo'<script>swal("La fecha ingresada ya no esta disponible","","error");</script>';
        return false;
    }else if(){



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
 ?>