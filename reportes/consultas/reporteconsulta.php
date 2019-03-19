<?php 
require("../../config/conexion.php");
require("header.php");
$pdf=new PDF();
$id_consulta=$_POST['id_consulta'];
$consulta=$con->query("SELECT * FROM consultas INNER JOIN pacientes ON consultas.ced_paciente=pacientes.ced_paciente INNER JOIN doctores ON doctores.id_doctor=consultas.id_doctor INNER JOIN especialidades ON doctores.id_especialidad=especialidades.id_especialidad WHERE consultas.id_consulta='$id_consulta'");
$detalle_consulta=$con->query("SELECT * FROM detalle_consulta INNER JOIN consultas ON detalle_consulta.id_consulta=consultas.id_consulta INNER JOIN productos ON detalle_consulta.id_producto=productos.id_producto INNER JOIN categorias ON productos.categorias_id=categorias.id_categoria WHERE detalle_consulta.id_consulta='$id_consulta'");
$c=mysqli_fetch_assoc($consulta);
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont("Times","B",14);
$pdf->Cell(190,10,"DETALLES DE LA CONSULTA",0,1,"C");
$pdf->Ln(5);

$pdf->SetFont("Times","B",12);
$pdf->Cell(70,10,"Paciente: ".$c['nombres'],0,0,"L");
$pdf->Cell(70,10,"Especialidad: ".$c['nombre_especialidad'],0,0,"L");
$pdf->Cell(50,10,"Doctor: ".$c['nombre'],0,0,"L");
$pdf->Ln(10);
//Datos Generales
$pdf->SetFont("Times","B",12);
$pdf->Cell(190,10,"Consulta por",0,1,"C");
$pdf->Ln(2);
$pdf->SetFont("Times","B",11);
$pdf->Cell(190,10,utf8_decode($c['consulta_por']),1,1,"L");
$pdf->Ln(2);

$pdf->SetFont("Times","B",12);
$pdf->Cell(190,10,"Tratamiento",0,1,"C");
$pdf->SetFont("Times","B",11);
$pdf->Cell(190,10,utf8_decode($c['tratamiento']),1,1,"L");
$pdf->Ln(2);

$pdf->SetFont("Times","B",12);
$pdf->Cell(190,10,"Diagnostico",0,1,"C");
$pdf->SetFont("Times","B",11);
$pdf->Cell(190,10,utf8_decode($c['diagnostico']),1,1,"L");
$pdf->Ln(2);

$pdf->SetFont("Times","B",12);
$pdf->Cell(190,10,"Indicaciones",0,1,"C");
$pdf->SetFont("Times","B",11);
$pdf->Cell(190,10,utf8_decode($c['indicaciones']),1,1,"L");
$pdf->Ln(2);

if($detalle_consulta->num_rows>0){

while($dc=mysqli_fetch_array($detalle_consulta)){
$pdf->SetFont("Times","B",12);
$pdf->Cell(70,10,"Producto",1,0,"C");
$pdf->Cell(70,10,"Categoria",1,0,"C");
$pdf->Cell(50,10,"Cantidad",1,0,"C");
}

}else{

}

$pdf->Output();
 ?>
