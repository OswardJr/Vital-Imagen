<?php 
require_once("../../config/conexion.php");
session_start();
date_default_timezone_set('America/Caracas');
    $idUsuario=$_SESSION['id_usuario'];
    $cedula=$_POST['ced_paciente'];
    $fecha=date('Y-m-d');
    $hora=date('H:i:s');
    $total=$_POST['total'];
    $consulta=$con->query("UPDATE consultas SET status_pago='cancelado' WHERE ced_paciente='$cedula'");
    $pago=$con->query("INSERT INTO pagos(id_usuario,ced_paciente,fecha,hora,total_cancelar) VALUES('$idUsuario','$cedula','$fecha','$hora','$total')");
    $ultimo_pago=mysqli_insert_id($con);
      foreach ($_POST['id_consulta'] as $ids) {
          $id_consulta=mysqli_escape_string($con,$_POST['id_consulta'][$ids]);
          $in=$con->query("INSERT INTO detalle_factura(id_pago,id_consulta,fecha_actual,hora) VALUES ('$ultimo_pago','$id_consulta',NOW(),'$hora')");
      }


 	echo "<script>swal({
  title: 'Factura Guardada con exito',
  text: '¿Desea Imprimir la Factura?',
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
           window.location='../reportes/pagos/reportefactura.php?cedula=".$cedula."&&id_pago=".$ultimo_pago."';
            return true;    
}, function (dismiss) {
    window.location='caja.php';
})</script>";

 ?>