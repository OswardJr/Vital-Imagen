<?php 
require("../../config/conexion.php");
require("header.php");
$nro_presupuesto=$_GET['id'];

$select=$con->query("SELECT * FROM presupuestos WHERE nro_presupuesto='$nro_presupuesto'");
$s=mysqli_fetch_assoc($select);
$id=$s['tipo_intervencion'];
$n='0000'.$nro_presupuesto;
$profesionales=$con->query("SELECT * FROM presupuesto_intervencion INNER JOIN doctores ON presupuesto_intervencion.id_doctor=doctores.id_doctor INNER JOIN especialidades ON doctores.id_especialidad=especialidades.id_especialidad INNER JOIN intervencion ON presupuesto_intervencion.id_intervencion=intervencion.id_intervencion WHERE presupuesto_intervencion.id_intervencion='$id'");
$productos=$con->query("SELECT * FROM presupuesto_intervencion INNER JOIN intervencion ON presupuesto_intervencion.id_intervencion=intervencion.id_intervencion INNER JOIN productos ON presupuesto_intervencion.id_producto=productos.id_producto WHERE presupuesto_intervencion.id_intervencion='$id'");
$intervencion=$con->query("SELECT * FROM intervencion WHERE id_intervencion='$id'");
$presupuestos=$con->query("SELECT * FROM presupuestos INNER JOIN pacientes ON presupuestos.ced_paciente=pacientes.ced_paciente WHERE presupuestos.nro_presupuesto='$nro_presupuesto'");
$p=mysqli_fetch_assoc($presupuestos);
$i=mysqli_fetch_assoc($intervencion);
$pdf=new PDF();

$pdf->AddPage();
$pdf->SetFont("Times","B",12);
$pdf->Cell(190,10,utf8_decode("DETALLES DE LA INTERVENCIÓN"),0,0,"C");

$pdf->SetFont("Times","B",10);
$pdf->Cell(190,10,utf8_decode("Datos de la intervención"),0,1,"C");

$pdf->SetFont("Times","B",10);
$pdf->Cell(95,10,utf8_decode("Nro Presupuesto: ".$n),1,0,"L");
$pdf->Cell(95,10,utf8_decode("Nombre del Paciente: ".$p['nombres']),1,1,"L");
$pdf->Cell(95,10,utf8_decode("Nombre de la intervención: ".$i['nombre_intervencion']),1,0,"L");
$pdf->Cell(95,10,utf8_decode("Descripción: ".$i['descripcion_intervencion']),1,1,"L");
$pdf->Ln(5);

$pdf->Cell(150,10,"Detalle ",0,0,"L");
$pdf->Cell(40,10,"Importe ",0,1,"L");

if($profesionales->num_rows>0){
	$pdf->Cell(190,10,"Honorarios Profesionales",1,1,"L");
	while($p=mysqli_fetch_array($profesionales)){
	$pdf->SetFont("Times","B",10);
	$pdf->Cell(60,10,utf8_decode($p['nombre_especialidad']),1,0,"L");
	$pdf->Cell(80,10,utf8_decode($p['nombre']),1,0,"L");
	$pdf->Cell(50,10,utf8_decode($p['precio_doctor']),1,1,"C");
	$pdf->Ln(5);
	}
}
if($productos->num_rows>0){
	$pdf->Cell(60,10,"Material Medico Quirurgico",1,0,"L");
	$pdf->Cell(130,10,"Cantidad",1,1,"L");
	$pdf->SetFont("Times","B",10);
	while($p=mysqli_fetch_array($productos)){
		$tproducto=$p['precio'];
		$total=$tproducto*$p['cantidad_producto'];
	$pdf->Cell(60,10,utf8_decode($p['nombre_producto']),1,0,"L");
	$pdf->Cell(80,10,utf8_decode($p['cantidad_producto']),1,0,"L");
	$pdf->Cell(50,10,utf8_decode($total),1,1,"C");
	$pdf->Ln(5);
	}
}
$pdf->Cell(60,10,"Intervencion",1,0,"L");
$pdf->Cell(130,10,"Cantidad",1,1,"L");
$pdf->SetFont("Times","B",10);
$pdf->Cell(60,10,utf8_decode("Quirofano 1hr"),1,0,"L");
$pdf->Cell(80,10,utf8_decode($i['cantidad_quirofano']),1,0,"L");
$pdf->Cell(50,10,utf8_decode($i['importe_quirofano']),1,1,"C");
$pdf->Cell(60,10,utf8_decode("Oxigeno"),1,0,"L");
$pdf->Cell(80,10,utf8_decode($i['cantidad_oxigeno']),1,0,"L");
$pdf->Cell(50,10,utf8_decode($i['importe_oxigeno']),1,1,"C");
$pdf->Cell(60,10,utf8_decode("Reten"),1,0,"L");
$pdf->Cell(80,10,utf8_decode($i['cantidad_reten']),1,0,"L");
$pdf->Cell(50,10,utf8_decode($i['importe_reten']),1,1,"C");
$pdf->Ln(5);

$pdf->Cell(60,10,utf8_decode("Hospitalizacion Recuperación"),1,0,"L");
$pdf->Cell(130,10,"Cantidad",1,1,"L");
$pdf->SetFont("Times","B",10);
$pdf->Cell(60,10,utf8_decode("Hospitalizacion clinica dia 24hr"),1,0,"L");
$pdf->Cell(80,10,utf8_decode($i['cantidad_hospitalizacion']),1,0,"L");
$pdf->Cell(50,10,utf8_decode($i['importe_hospitalizacion']),1,1,"C");
$pdf->Cell(60,10,utf8_decode("Medico Residente"),1,0,"L");
$pdf->Cell(80,10,utf8_decode($i['cantidad_medico']),1,0,"L");
$pdf->Cell(50,10,utf8_decode($i['importe_medico']),1,1,"C");
$pdf->Cell(60,10,utf8_decode("Enfermera"),1,0,"L");
$pdf->Cell(80,10,utf8_decode($i['cantidad_enfermera']),1,0,"L");
$pdf->Cell(50,10,utf8_decode($i['importe_enfermera']),1,1,"C");
$pdf->Cell(60,10,utf8_decode("Alimentacion Balanceada"),1,0,"L");
$pdf->Cell(80,10,utf8_decode($i['cantidad_alimentacion']),1,0,"L");
$pdf->Cell(50,10,utf8_decode($i['importe_alimentacion']),1,1,"C");

$subtotal=$i['precio_total'];
$iva=$subtotal*0.12;
$total=$subtotal+$iva;
$pdf->Ln(5);

$pdf->Cell(140,10,"",0,0,"C");
$pdf->Cell(50,10,"SUBTOTAL: ".$i['precio_total'],1,1,"L");
$pdf->Cell(140,10,"",0,0,"C");
$pdf->Cell(50,10,"+12 IVA: ".$iva,1,1,"L");
$pdf->Cell(140,10,"",0,0,"C");
$pdf->Cell(50,10,"TOTAL: ".$total,1,1,"L");


$pdf->Output();
