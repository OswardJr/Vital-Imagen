<?php 
require("../../config/conexion.php");
require("header.php");
$pdf=new PDF();

$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont("Times","B",14);
$pdf->Cell(190,10,"LISTADO DE DOCTORES",0,1,"C");
$pdf->Ln(5);
$pdf->SetFont("Times","B",10);
$pdf->Cell(10,10,"ID",1,0,"C");
$pdf->Cell(25,10,"Cedula",1,0,"C");
$pdf->Cell(25,10,"Nombres ",1,0,"C");
$pdf->Cell(30,10,"Apellidos",1,0,"C");
$pdf->Cell(40,10,"Direccion",1,0,"C");
$pdf->Cell(30,10,"Telefono",1,0,"C");
$pdf->Cell(30,10,"Especialidad",1,1,"C");

$sql=$con->query("SELECT * FROM doctores INNER JOIN especialidades ON doctores.id_especialidad=especialidades.id_especialidad");

while($row=mysqli_fetch_array($sql)){

$pdf->SetFont("Times","I",10);

$pdf->Cell(10,10,$row['id_doctor'],1,0);
$pdf->Cell(25,10,$row['cedula'],1,0);
$pdf->Cell(25,10,$row['nombre'],1,0);
$pdf->Cell(30,10,$row['apellido'],1,0);
$pdf->Cell(40,10,$row['direccion'],1,0);
$pdf->Cell(30,10,$row['telefono'],1,0);
$pdf->Cell(30,10,$row['nombre_especialidad'],1,1);

}

$pdf->Output();
 ?>
