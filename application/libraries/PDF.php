<?php
require('fpdf.php');

class PDF extends FPDF {

    function __construct() {
        parent::__construct();
    }

    function Header(){
		$this->SetFont('Arial','B',12);

		$this->SetXY(5,5);
		$this->Image('./assets/dist/img/logo_full.png', 10, 10, 14);
		$this->Cell(200, 6, '', 'LRT', 1, 'C');

		$this->SetX(5);
		$this->Cell(25, 6, '', 'L', 0, 'C');
		$this->Cell(175, 6, 'TANDA TERIMA DOKUMEN - SIPP DOKLING', 'R', 1, 'C');

		$this->SetX(5);
		$this->Cell(25, 6, '', 'L', 0, 'C');
		$this->Cell(175, 6, 'SISTEM INFORMASI PELAPORAN PELAKSANAAN DOKUMEN LINGKUNGAN', 'R', 1, 'C');

		// $this->SetX(5);
		// $this->Cell(25, 6, '', 'L', 0, 'C');
		// $this->Cell(175, 6, '( SIPP DOKLING )', 'R', 1, 'C');

		$this->SetX(5);
		$this->Cell(25, 6, '', 'L', 0, 'C');
		$this->Cell(175, 6, 'DINAS LINGKUNGAN HIDUP KABUPATEN BOJONEGORO', 'R', 1, 'C');

		$this->SetX(5);
		$this->Cell(200, 6, '', 'LRB', 1, 'C');

		$this->Ln();
	}

	function Footer_old()
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
