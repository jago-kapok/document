<?php
require('fpdf.php');

class PDF extends FPDF {

    function __construct() {
        parent::__construct();
    }

    function Header(){
		$this->SetXY(5,5);
		$this->SetFont('Arial','B',15);
		$this->Cell(169, 6, 'PANDU MULYA', 0, 2, 'L');

		$this->SetFont('Arial','I',9);
		$this->Cell(169, 5, 'Jalan Guyangan - Berbek', 0, 2, 'L');
		$this->Cell(169, 5, 'Ds. Gandu Kec. Bagor Kab. Nganjuk', 0, 2, 'L');
		$this->Cell(169, 5, 'Telp. 0822 2933 2933', 0, 2, 'L');
		
		$this->Line(5, 33, 210, 33);
		$this->Line(5, 34, 210, 34);
		$this->Ln();
	}

	function Footer()
	{
		$this->SetY(-12);
		$this->SetFont('Arial','I',7);

		$this->Line(5, $this->getY() - 1, 210, $this->getY() - 1);
		$this->Cell(3, 3, "*", 0, 0, 'R');
		$this->Cell(5, 3, "Kekeliruan barang, segera memberitahu maksimal 3 hari setelah barang diterima.", 0, 1);
		
		$this->Cell(3, 3, "**", 0, 0, 'R');
		$this->Cell(5, 3, "Retur atau potong nota, harus persetujuan sales / kantor.", 0, 1);
		
		$this->Cell(3, 3, "***", 0, 0, 'R');
		$this->Cell(5, 3, "Kehilangan barang di ekspedisi, bukan tanggungjawab kami.", 0, 1);
	}
}
?>
