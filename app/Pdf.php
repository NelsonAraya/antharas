<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Codedge\Fpdf\Fpdf\Fpdf;
class Pdf extends Fpdf
{
    public function Header() {
	
		$this->SetFont('Arial','B',14);
		//Movimiento hacia la derecha 'Informe de Servicio'
		$this->Image('img/logo_pdf.jpg', 10, 10, 20);
		$this->Image('img/logo_pdf.jpg', 190, 10, 20);
		$this->Image('img/marcadeagua.png', 40, 80, 130, 150);
		$this->SetXY(35,15);
		$this->Cell(150, 7, 'Informe de Servicio Cuerpo de Bomberos de Iquique', 1, 2, 'C');
		$this->Ln(13);
	}

	public function Footer() {
	
		$this->SetY(-14);
	    $this->SetFont('Arial','B',8);
	    $this->Cell(0,10,utf8_decode('Cuerpo Bomberos de Iquique - Página ').$this->PageNo(),0,0,'C');
    }
}
