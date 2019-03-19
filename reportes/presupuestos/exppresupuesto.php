<?php
	require("../PHPExcel/Classes/PHPExcel.php");
	require("../../config/conexion.php");
	date_default_timezone_set('America/Caracas');
	$id=$_GET['id'];
	//Consulta
	$profesionales=$con->query("SELECT * FROM presupuesto_intervencion INNER JOIN doctores ON presupuesto_intervencion.id_doctor=doctores.id_doctor INNER JOIN especialidades ON doctores.id_especialidad=especialidades.id_especialidad INNER JOIN intervencion ON presupuesto_intervencion.id_intervencion=intervencion.id_intervencion WHERE presupuesto_intervencion.id_intervencion='$id'");
	$productos=$con->query("SELECT * FROM presupuesto_intervencion INNER JOIN intervencion ON presupuesto_intervencion.id_intervencion=intervencion.id_intervencion INNER JOIN productos ON presupuesto_intervencion.id_producto=productos.id_producto WHERE presupuesto_intervencion.id_intervencion='$id'");
	$intervencion=$con->query("SELECT * FROM intervencion WHERE id_intervencion='$id'");
	$i=mysqli_fetch_assoc($intervencion);
	$fila = 9;
	$fila2=14; //Establecemos en que fila inciara a imprimir los datos
	
	$gdImage = imagecreatefrompng('paz.png');//Logotipo
	
	//Objeto de PHPExcel
	$objPHPExcel  = new PHPExcel();
	
	//Propiedades de Documento
	$objPHPExcel->getProperties()->setCreator("UMI La Paz")->setDescription("Reporte de Intervencion");
	
	//Establecemos la pestaña activa y nombre a la pestaña
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setTitle("Intervencion");
	
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
	$objPHPExcel->getActiveSheet()->setCellValue('H5', 'INTERVENCION');

	
	//Recorremos los resultados de la consulta y los imprimimos
		$rows = $resultado->fetch_assoc();	
		$objPHPExcel->getActiveSheet()->setCellValue('B',"Detalle");
		$objPHPExcel->getActiveSheet()->setCellValue('C',""]);
		$objPHPExcel->getActiveSheet()->setCellValue('D',"");
		$objPHPExcel->getActiveSheet()->setCellValue('E',"");
		$objPHPExcel->getActiveSheet()->setCellValue('F',"");
		$objPHPExcel->getActiveSheet()->setCellValue('G',"Importe");
		$objPHPExcel->getActiveSheet()->setCellValue('H',"");
		
	$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "B9:H9".$fila);
	
		$fila++; //Sumamos 1 para pasar a la siguiente fila

	

	$objPHPExcel->getActiveSheet()->getStyle('B12:H12')->applyFromArray($estiloTituloColumnas);
	$objPHPExcel->getActiveSheet()->getStyle('B13:H13')->applyFromArray($estiloTituloColumnas);



	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Disposition: attachment;filename="Pacientes.xlsx"');
	header('Cache-Control: max-age=0');


	$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$writer->save('php://output');