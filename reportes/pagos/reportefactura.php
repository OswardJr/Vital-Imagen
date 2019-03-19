<?php 
require("../../config/conexion.php");
require("header.php");
$pdf=new PDF();
$cedula=$_GET['cedula'];
$nro_pago=$_GET['id_pago'];

$pago=$con->query("SELECT * FROM pagos INNER JOIN pacientes ON pagos.ced_paciente=pacientes.ced_paciente INNER JOIN usuarios ON pagos.id_usuario=usuarios.id_usuario WHERE pagos.nro_pago='$nro_pago'");
$r=mysqli_fetch_assoc($pago);
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont("Times","B",16);
$pdf->Cell(190,10,"Factura",0,1,"C");
$pdf->Ln(5);

//Datos Generales
$pdf->SetFont("Times","",10);
$pdf->Cell(140,10,"Nro de Factura:".$r['nro_pago'],0,0,"L");
$pdf->Cell(40,10,"Fecha:".$r['fecha'],0,1,"L");
$pdf->Cell(140,10,"Nombre del cliente:".$r['nombres'],0,0,"L");
$pdf->Cell(40,10,"Hora:".$r['hora'],0,1,"L");
$pdf->Cell(140,10,"Vendedor:".$r['usuario'],0,0,"L");
$pdf->Ln(5);
//Consultas
$pdf->Cell(190,10,"Detalle de la Factura",0,1,"C");
$pdf->Cell(140,5,"Concepto",1,0,"C");
$pdf->Cell(50,5,"Importe",1,1,"C");

$detalle=$con->query("SELECT * FROM detalle_factura INNER JOIN pagos ON detalle_factura.id_pago=pagos.nro_pago INNER JOIN consultas ON detalle_factura.id_consulta=consultas.id_consulta INNER JOIN pacientes ON consultas.ced_paciente=pacientes.ced_paciente INNER JOIN doctores ON consultas.id_doctor=doctores.id_doctor INNER JOIN especialidades ON doctores.id_especialidad=especialidades.id_especialidad WHERE detalle_factura.id_pago='$nro_pago' ");

while($p=mysqli_fetch_array($detalle)){
$pdf->SetFont("Times","",9);
$pdf->Cell(140,5,"Doctor: ". $p['nombre']. " Especialidad: " . $p['nombre_especialidad'],1,0,"C");
$pdf->Cell(50,5,$p['pago_consulta'],1,1,"C");
$toti =+ $p['pago_consulta'];

}


$pdf->Ln(120);
$pdf->Cell(150,10,"",0,0);
$pdf->Cell(40,10,"Subtotal: ". $toti . " Bs",1,1);
$pdf->Cell(150,10,"",0,0);
$tot=$r['total_cancelar'];
$iva=$toti*0.12;
$pdf->Cell(40,10,"IVA: " . $iva . " Bs",1,1);
$pdf->Cell(150,10,"",0,0);
$pdf->Cell(40,10,"Total: " . $r['total_cancelar'] . " Bs",1,1);

$pdf->Output();
 ?>
