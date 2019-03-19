<?php 
require_once("../../config/conexion.php");
$ced=$_POST['cedula'];
$nfecha=explode('-', $_POST['fecha_actual']);
$fecha=$nfecha[2].'-'.$nfecha[1].'-'.$nfecha[0];
$nacionalidad=$_POST['nacionalidad'];
$cedula=$nacionalidad.'-'.$ced;
$intervencion=$_POST['intervencion'];
$d_vencimiento=$_POST['d_vencimiento'];

$sql=$con->query("INSERT INTO presupuestos(ced_paciente,fecha_presupuesto,tipo_intervencion,d_vencimiento) VALUES ('$cedula','$fecha','$intervencion','$d_vencimiento')");
$nro_presupuesto=mysqli_insert_id($con);

if($sql){
	echo "<script>swal({
  title: 'Presupuesto Guardado con exito',
  text: '¿Desea Imprimir el presupuesto?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si',
  cancelButtonText: 'No',
  confirmButtonClass: 'btn btn-primary',
  cancelButtonClass: 'btn btn-warning',
  buttonsStyling: false
}).then(function () {
           window.location='../reportes/presupuestos/presupuestos.php?nro_presupuesto=".$nro_presupuesto."';
            return true;    
}, function (dismiss) {
	window.location='presupuesto.php';
})</script>";

}

 ?>