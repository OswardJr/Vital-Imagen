<?php 
require("../../config/conexion.php");
require("header.php");
$pdf=new PDF();

$pdf->AddPage('L');
$pdf->AliasNbPages();
$pdf->SetFont("Times","B",14);
$pdf->Cell(290,10,"Lista de Pacientes",0,1,"C");
$pdf->Ln(5);

$sql=$con->query("SELECT * FROM pacientes");
//Datos Generales
$pdf->SetFont("Times","B",10);
$pdf->Cell(30,10,"Cedula",1,0,"C");
$pdf->Cell(40,10,"Nombre",1,0,"C");
$pdf->Cell(40,10,"Apellido",1,0,"C");
$pdf->Cell(40,10,"Fecha de Nacimiento",1,0,"C");
$pdf->Cell(50,10,utf8_decode("Teléfono"),1,0,"C");
$pdf->Cell(70,10,utf8_decode("Dirección"),1,1,"C");

while($p=mysqli_fetch_array($sql)){
$pdf->SetFont("Times","B",10);
$pdf->Cell(30,10,utf8_decode($p['ced_paciente']),1,0,"C");
$pdf->Cell(40,10,utf8_decode($p['nombres']),1,0,"C");
$pdf->Cell(40,10,utf8_decode($p['apellidos']),1,0,"C");
$pdf->Cell(40,10,utf8_decode($p['fecha_nacimiento']),1,0,"C");
$pdf->Cell(50,10,utf8_decode($p['telefono']),1,0,"C");
$pdf->Cell(70,10,utf8_decode($p['direccion']),1,1,"C");

}
$pdf->Output();
 ?>
