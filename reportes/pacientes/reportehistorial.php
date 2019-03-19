<?php 
require("../../config/conexion.php");
require("header2.php");
$pdf=new PDF();
$cedula=$_GET['cedula'];

$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont("Times","B",14);
$pdf->Cell(190,10,"HISTORIAL DEL PACIENTE",0,1,"C");
$pdf->Ln(5);

$sql=$con->query("SELECT * FROM pacientes INNER JOIN ciudades ON pacientes.id_ciudad=ciudades.id_ciudad INNER JOIN estados ON ciudades.id_estado=estados.id_estado INNER JOIN municipios ON estados.id_estado=municipios.id_estado INNER JOIN parroquias ON municipios.id_municipio=parroquias.id_municipio ORDER BY nro_historia ASC");
$row=mysqli_fetch_assoc($sql);
//Datos Generales
$pdf->SetFont("Times","B",10);
$pdf->Cell(30,10,"Nro Historia: ".$row['nro_historia'],1,0);
$pdf->Cell(40,10,"Cedula: " .$row['ced_paciente'],1,0);
$pdf->Cell(60,10,"Nombres: " .utf8_decode($row['nombres']),1,0);
$pdf->Cell(60,10,"Apellidos: " .utf8_decode($row['apellidos']),1,1);
$pdf->Cell(30,10,"Sexo: " .$row['sexo'],1,0);
$pdf->Cell(60,10,"Fecha de Nacimiento: " .$row['fecha_nacimiento'],1,0);
$pdf->Cell(50,10,utf8_decode("Teléfono: ") .$row['telefono'],1,0);
$pdf->Cell(50,10,"Estado : " .utf8_decode($row['estado']),1,1);
$pdf->Cell(70,10,"Ciudad : " .utf8_decode($row['ciudad']),1,0);
$pdf->Cell(60,10,"Municipio : " .utf8_decode($row['municipio']),1,0);
$pdf->Cell(60,10,"Parroquia : " .utf8_decode($row['parroquia']),1,1);
$pdf->Cell(100,10,"Direccion: " .utf8_decode($row['direccion']),1,0);
$pdf->Cell(90,10,"Responsable: " .$row['responsable'],1,1);

//Consultas
$consulta=$con->query("SELECT* FROM consultas INNER JOIN pacientes ON consultas.ced_paciente=pacientes.ced_paciente INNER JOIN doctores ON consultas.id_doctor=doctores.id_doctor INNER JOIN especialidades ON doctores.id_especialidad=especialidades.id_especialidad WHERE pacientes.ced_paciente='$cedula'");
$rows=mysqli_num_rows($consulta);
$pdf->Ln(10);
$pdf->SetFont("Times","B",12);
$pdf->Cell(190,10,"Consultas Realizadas",0,1,"C");

if($rows>0){
$pdf->SetFont("Times","B",10);
$pdf->Cell(40,10,"Fecha & Hora",1,0,"C");
$pdf->Cell(30,10,"Doctor",1,0,"C");
$pdf->Cell(60,10,"Consulta Por",1,0,"C");
$pdf->Cell(60,10,"Diagnostico",1,1,"C");

while($c=mysqli_fetch_array($consulta)){
	$pdf->Cell(40,10,$c['fecha_actual'].'/'.$c['hora_actual'],1,0,"L");
	$pdf->Cell(30,10,$c['nombre'],1,0,"L");
	$pdf->Cell(60,10,$c['consulta_por'],1,0,"L");
	$pdf->Cell(60,10,$c['diagnostico'],1,1,"L");
}

}else{
	$pdf->Ln(4);
	$pdf->SetFont("Times","I",12);
	$pdf->Cell(190,10,"No posee Consultas ",0,0,'C');
}

$pdf->Output();
 ?>
