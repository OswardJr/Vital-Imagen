<?php
	require("../PHPExcel/Classes/PHPExcel.php");
	require("../../config/conexion.php");
	date_default_timezone_set('America/Caracas');
	//Consulta
	//Consulta
	$sql = "SELECT * FROM doctores";
	$resultado = $con->query($sql);
	$fila = 9; //Establecemos en que fila inciara a imprimir los datos
	
	$gdImage = imagecreatefrompng('paz.png');//Logotipo
	
	//Objeto de PHPExcel
	$objPHPExcel  = new PHPExcel();
	
	//Propiedades de Documento
	$objPHPExcel->getProperties()->setCreator("UMI La Paz")->setDescription("Reporte de Pacientes");
	
	//Establecemos la pestaña activa y nombre a la pestaña
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setTitle("Pacientes");
	
	$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
	$objDrawing->setName('Logotipo');
	$objDrawing->setDescription('Logotipo');
	$objDrawing->setImageResource($gdImage);
	$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
	$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
	$objDrawing->setHeight(80);
	$objDrawing->setCoordinates('B2');
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
	
	$objPHPExcel->getActiveSheet()->getStyle('B1:G6')->applyFromArray($estiloTituloReporte);
	$objPHPExcel->getActiveSheet()->getStyle('B8:G8')->applyFromArray($estiloTituloColumnas);
	
	$objPHPExcel->getActiveSheet()->setCellValue('G2', 'Unidad Medico Integral La Paz C.A');
	$objPHPExcel->getActiveSheet()->mergeCells('G2:H2');
	$objPHPExcel->getActiveSheet()->setCellValue('G3', 'Rif: J-223232');
	$objPHPExcel->getActiveSheet()->mergeCells('G3:H3');
	$objPHPExcel->getActiveSheet()->setCellValue('G4', 'Telefono: (0244)-3228569');
	$objPHPExcel->getActiveSheet()->mergeCells('G4:H4');
	$objPHPExcel->getActiveSheet()->setCellValue('G5', 'Correo: umi_lapaz@yahoo.com');
	$objPHPExcel->getActiveSheet()->mergeCells('G5:H5');
	
	
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('E5', 'LISTADO DE DOCTORES');
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('B8', 'CEDULA');
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('C8', 'NOMBRES');
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('D8', 'APELLIDOS');
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('E8', 'TELEFONO');
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(50);
	$objPHPExcel->getActiveSheet()->setCellValue('F8', 'CORREO');
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(40);
	$objPHPExcel->getActiveSheet()->setCellValue('G8', 'DIRECCION');

	//Recorremos los resultados de la consulta y los imprimimos
	while($rows = $resultado->fetch_assoc()){
		
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, $rows['cedula']);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, $rows['nombre']);
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, $rows['apellido']);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$fila, $rows['telefono']);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$fila, $rows['correo']);
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$fila, $rows['direccion']);
		
		
		$fila++; //Sumamos 1 para pasar a la siguiente fila
	}
	
	$fila = $fila-1;
	
	$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "B8:G8".$fila);
		
	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Disposition: attachment;filename="Pacientes.xlsx"');
	header('Cache-Control: max-age=0');


	$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$writer->save('php://output');