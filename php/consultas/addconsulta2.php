<?php 
require("../../config/conexion.php");
date_default_timezone_set('America/Caracas');
$script_tz = date_default_timezone_get();
$fecha_actual=date('Y-m-d');
$hora_actual=date('H:i:s');
$ced=$_POST['cedula'];
$nacionalidad=$_POST['nacionalidad'];
$cedula=$nacionalidad.'-'.$ced;
$consulta=$_POST['consulta'];
$id_doctor=$_POST['id_doctor'];
$tratamiento=$_POST['tratamiento'];
$diagnostico=$_POST['diagnostico'];
$indicaciones=$_POST['indicaciones'];
$pago=$_POST['precio'];
$total=$_POST['total'];
$cancelar=$total+$pago;

$sql="INSERT INTO consultas( ced_paciente,id_doctor, consulta_por,tratamiento, diagnostico, indicaciones, pago_consulta,fecha_actual,hora_actual) VALUES ('$cedula','$id_doctor','$consulta','$tratamiento','$diagnostico','$indicaciones','$cancelar','$fecha_actual','$hora_actual')";
$consulta=$con->query($sql);


$id_consulta=mysqli_insert_id($con);

if(isset($_POST['id_pro'])){
	foreach ($_POST['id_pro'] as $ids) {
	$id_producto=mysqli_real_escape_string($con,$_POST['id_pro'][$ids]);
	$cantidad=mysqli_real_escape_string($con,$_POST['cantidad'][$ids]);
   	

   	$producto_ingresado=$con->query("INSERT INTO detalle_consulta(id_consulta,id_producto,cantidad) VALUES('$id_consulta','$id_producto','$cantidad')");
   	$delete=$con->query("DELETE FROM temp_productos WHERE id_producto='$id_producto'");
    $update=$con->query("UPDATE productos SET stock=stock-'$cantidad' WHERE id_producto='$id_producto'");
}
}

echo '<script>swal({
                        title: "Consulta guardada con exito",
                        text: "",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });

                var delay = 2000;
                setTimeout(function(){ window.location = "citascalendario.php"; }, delay);</script>';
