<?php 
require("../../config/conexion.php");
require("header.php");
$pdf=new PDF();

$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont("Times","B",14);
$pdf->Cell(190,10,"LISTADO DE PRODUCTOS",0,1,"C");
$pdf->Ln(5);
$pdf->SetFont("Times","B",10);
$pdf->Cell(40,10,"Nombre",1,0,"C");
$pdf->Cell(30,10,"Stock",1,0,"C");
$pdf->Cell(30,10,"Precio de entrada",1,0,"C");
$pdf->Cell(30,10,"Precio de venta",1,0,"C");
$pdf->Cell(50,10,"Categoria",1,1,"C");
$sql=$con->query("SELECT * FROM PRODUCTOS INNER JOIN categorias ON productos.categorias_id=categorias.id_categoria");

while($row=mysqli_fetch_array($sql)){

$pdf->SetFont("Times","I",10);

$pdf->Cell(40,10,$row['nombre_producto'],1,0);
$pdf->Cell(30,10,$row['stock'],1,0);
$pdf->Cell(30,10,$row['precio_entrada'],1,0);
$pdf->Cell(30,10,$row['precio'],1,0);
$pdf->Cell(50,10,$row['nombre_categoria'],1,1);

}

$pdf->Output();
 ?>
