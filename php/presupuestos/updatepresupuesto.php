<?php 
require_once("../../config/conexion.php");
$nro_presupuesto=$_POST['nro_presupuesto'];
$intervencion=$_POST['intervencion'];
$d_vencimiento=$_POST['d_vencimiento'];

$sql=$con->query("UPDATE presupuestos SET tipo_intervencion='$intervencion',d_vencimiento='$d_vencimiento' WHERE nro_presupuesto='$nro_presupuesto'");
$nro_presupuesto=mysqli_insert_id($con);

if($sql){
    echo '<script> swal({
                        title: "Presupuesto editado con exito",
                        text: ".",
                        type: "success",
                        timer: 1000,
                        showConfirmButton: false
                    });

                var delay = 1000;
                setTimeout(function(){ window.location = "presupuesto.php"; }, delay);</script>';

}

 ?>