<?php 
require_once("../../config/conexion.php");
$id=$_POST['id_cita'];
$doctor=$_POST['doctor'];
$nfecha=explode('/',$_POST['fecha_cita']);
$fecha ="{$nfecha[2]}-{$nfecha[1]}-{$nfecha[0]}";
  $weekday = date("w", strtotime($fecha)); 
$fecha2=$nfecha[0]."-".$nfecha[1];
$weekday = date("w", strtotime($fecha));
$hora=$_POST['hora']; 
$feriados  = array( 
                            '01-01', 
                            '10-04', 
                            '11-04', 
                            '01-05', 
                            '21-05', 
                            '29-06', 
                            '16-07', 
                            '15-08', 
                            '18-09', 
                            '19-09', 
                            '12-10', 
                            '31-10', 
                            '01-11', 
                            '08-12', 
                            '13-12', 
                            '25-12'); 

    if($weekday == 0 || $weekday == 6){ 
        echo '<script>swal("La fecha ingresada es un fin de semana","","error");</script>';
        return false; 

    }else if(in_array($fecha2, $feriados)){ 
            echo '<script>swal("La fecha Ingresada es un dia festivo","","error");</script>';
            return false; 
    }else{ 

$sql="UPDATE citas SET id_doctor='$doctor',fecha_cita='$fecha',hora='$hora' WHERE id_citas='$id'";
$result=$con->query($sql);

session_start();
$idUsuario=$_SESSION['id_usuario'];

$sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Update',Modifico una Cita,NOW())";
$result3=$con->query($sql3);


echo '<script>swal({
                        title: "Cita Modificada con exito",
                        text: "",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });

                var delay = 2000;
                setTimeout(function(){ window.location = "citas.php"; }, delay);</script>';
}
 ?>
