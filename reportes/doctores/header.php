<?php 
require("../fpdf/fpdf.php");
date_default_timezone_set('America/Caracas');

class PDF extends FPDF
{
	
	function Header ()
	{
		$date=date('d-m-Y');
		$this->Image("paz.jpg",10,8,80);
		$this->SetFont('Times','I',16);
		$this->Cell(90);
		$this->Cell(100,0,"Unidad de Medicina Integral La Paz C.A",0,0,'R');
		$this->Ln(7);
		$this->Cell(90);
		$this->Cell(100,0,"Rif: J-30256229-5",0,0,'R');
		$this->Ln(7);
		$this->Cell(90);
		$this->Cell(100,0,"Tel:(0244)-3225944",0,0,'R');
		$this->Ln(7);
		$this->Cell(90);
		$this->Cell(100,0,"Correo:umi_lapaz@yahoo.com",0,0,'R');
		$this->Ln(7);
		$this->Cell(90);
		$this->Cell(100,0,"Fecha:".$date,0,0,'R');
		$this->Ln(10);
		$this->Cell(190,0,"",1,0);
		$this->Ln(7);


	}

	function Footer(){
		$this->SetY(-15);
			$this->SetFont('Times','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );

	}
}

 ?>