<?php
	require("../PHPExcel/Classes/PHPExcel.php");
	require("../../config/conexion.php");
	date_default_timezone_set('America/Caracas');
	$cedula=$_GET['cedula'];
	//Consulta
	$sql = "SELECT * FROM pacientes WHERE ced_paciente='$cedula'";
	$resultado = $con->query($sql);
	$res=$con->query("SELECT * FROM consultas INNER JOIN pacientes ON consultas.ced_paciente=pacientes.ced_paciente INNER JOIN doctores ON consultas.id_doctor=doctores.id_doctor INNER JOIN especialidades ON doctores.id_especialidad=especialidades.id_especialidad WHERE pacientes.ced_paciente='$cedula'");
	$fila = 9;
	$fila2=14; //Establecemos en que fila inciara a imprimir los datos
	
	$gdImage = imagecreatefrompng('paz.png');//Logotipo
	
	//Objeto de PHPExcel
	$objPHPExcel  = new PHPExcel();
	
	//Propiedades de Documento
	$objPHPExcel->getProperties()->setCreator("UMI La Paz")->setDescription("Reporte de Historial");
	
	//Establecemos la pestaña activa y nombre a la pestaña
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setTitle("HistoriaPaciente");
	
	$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
	$objDrawing->setName('Logotipo');
	$objDrawing->setDescription('Logotipo');
	$objDrawing->setImageResource($gdImage);
	$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
	$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
	$objDrawing->setHeight(80);
	$objDrawing->setCoordinates('B1');
	$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
	
	$estiloTituloReporte = array(
    'font' => array(
	'name'      => 'Arial',
	'bold'      => true,
	'italic'    => false,
	'strike'    => false,
	'size' =>10
    ),
    'fill' => array(
	'type'  => PHPExcel_Style_Fill::FILL_SOLID
	),
    'borders' => array(
	'allborders' => array(
	'style' => PHPExcel_Style_Border::BORDER_NONE
	)
    )
	);
	
	$estiloTituloColumnas = array(
    'font' => array(
	'name'  => 'Arial',
	'bold'  => true,
	'size' =>10
    ),
    'fill' => array(
	'type' => PHPExcel_Style_Fill::FILL_SOLID
    ),
    'borders' => array(
	'allborders' => array(
	'style' => PHPExcel_Style_Border::BORDER_THIN
	)
    ),
    'alignment' =>  array(
	'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
	);
	
	$estiloInformacion = new PHPExcel_Style();
	$estiloInformacion->applyFromArray( array(
    'font' => array(
	'name'  => 'Arial',
	'color' => array(
	'rgb' => '000000'
	)
    ),
    'fill' => array(
	'type'  => PHPExcel_Style_Fill::FILL_SOLID
	),
    'borders' => array(
	'allborders' => array(
	'style' => PHPExcel_Style_Border::BORDER_THIN
	)
    ),
    'alignment' =>  array(
	'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
	));
	
	$objPHPExcel->getActiveSheet()->getStyle('B1:H6')->applyFromArray($estiloTituloReporte);
	$objPHPExcel->getActiveSheet()->getStyle('B8:H8')->applyFromArray($estiloTituloColumnas);
	
	$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Unidad Medico Integral La Paz C.A');
	$objPHPExcel->getActiveSheet()->mergeCells('G1:H1');
	$objPHPExcel->getActiveSheet()->setCellValue('G2', 'Rif: J-223232');
	$objPHPExcel->getActiveSheet()->mergeCells('G2:H2');
	$objPHPExcel->getActiveSheet()->setCellValue('G3', 'Telefono: (0244)-3228569');
	$objPHPExcel->getActiveSheet()->mergeCells('G3:H3');
	$objPHPExcel->getActiveSheet()->setCellValue('G4', 'Correo: umi_lapaz@yahoo.com');
	$objPHPExcel->getActiveSheet()->mergeCells('G4:H4');
	
	
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('E5', 'HISTORIAL DE PACIENTE');
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('B8', 'NRO HISTORIA');
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('C8', 'CEDULA');
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('D8', 'NOMBRES');
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('E8', 'APELLIDOS');
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(50);
	$objPHPExcel->getActiveSheet()->setCellValue('F8', 'DIRECCION');
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('G8', 'TELEFONO');
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('H8', 'RESPONSABLE');
	
	//Recorremos los resultados de la consulta y los imprimimos
	$rows = $resultado->fetch_assoc();
		
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, $rows['nro_historia']);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, $rows['ced_paciente']);
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, $rows['nombres']);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$fila, $rows['apellidos']);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$fila, $rows['direccion']);
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$fila, $rows['telefono']);
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$fila, $rows['responsable']);
		
	$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "B9:H9".$fila);
	
		$fila++; //Sumamos 1 para pasar a la siguiente fila

	

	$objPHPExcel->getActiveSheet()->getStyle('B12:H12')->applyFromArray($estiloTituloColumnas);
	$objPHPExcel->getActiveSheet()->getStyle('B13:H13')->applyFromArray($estiloTituloColumnas);

	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('D12', 'CONSULTAS DEL PACIENTE');
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('B13', 'Fecha');
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('C13', 'Doctor');
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('D13', 'Especialidad');
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('E13', 'Consulta Por');
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('F13', 'Diagnostico');
	
	
	
	while($consulta = $res->fetch_assoc()){
		
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$fila2, $consulta['fecha_actual']);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$fila2, $consulta['nombre']);
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$fila2, $consulta['nombre_especialidad']);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$fila2, $consulta['consulta_por']);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$fila2, $consulta['diagnostico']);
		
		
		$fila2++; //Sumamos 1 para pasar a la siguiente fila
	}
	
	$fila2 = $fila2-1;

	$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "B14:H14".$fila2);

	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Disposition: attachment;filename="Pacientes.xlsx"');
	header('Cache-Control: max-age=0');


	$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$writer->save('php://output');