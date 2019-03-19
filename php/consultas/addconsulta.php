<?php 
require("../../config/conexion.php");
$cedula=$_POST['cedula'];
$consulta=$_POST['consulta'];
$doctor=$_POST['doctor'];
$fecha_cita=$_POST['fecha_cita'];
$hora=$_POST['hora'];
$tratamiento=$_POST['tratamiento'];
$diagnostico=$_POST['diagnostico'];
$indicaciones=$_POST['indicaciones'];
$pago=$_POST['precio'];
$id_cita=$_POST['id_cita'];
$total=$_POST['total'];
$cancelar=$total+$pago;


$sql="INSERT INTO consultas( ced_paciente,id_doctor, consulta_por,tratamiento, diagnostico, indicaciones, pago_consulta,fecha_actual,hora_actual) VALUES ('$cedula','$doctor','$consulta','$tratamiento','$diagnostico','$indicaciones','$cancelar','$fecha_cita','$hora')";
$consulta=$con->query($sql);

$id_consulta=mysqli_insert_id($con);

$citas=$con->query("UPDATE citas SET status_atencion='Atendido' WHERE id_citas='$id_cita'");



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


  