<?php
require('fpdf.php');

class PDF extends FPDF {

    function __construct() {
        parent::__construct();
    }

    function Header(){
		$this->SetXY(5,5);
		$this->SetFont('Arial','B',12);

		$this->Image('./assets/dist/img/logo_full.png', 10, 10, 15);
		$this->Cell(200, 6, '', 'LRT', 2, 'C');
		$this->Cell(25, 6, '', 'L', 0, 'C');
		$this->Cell(175, 6, 'TANDA TERIMA', 'R', 1, 'C');

		// $this->SetFont('Arial','B',12);
		$this->Cell(25, 6, '', 'L', 0, 'C');
		$this->Cell(175, 6, 'SISTEM PELAPORAN PENGELOLAAN DOKUMEN LINGKUNGAN', 'R', 1, 'C');

		$this->Cell(25, 6, '', 'L', 0, 'C');
		$this->Cell(175, 6, 'DINAS LINGKUNGAN HIDUP KABUPATEN BOJONEGORO', 'R', 1, 'C');
		$this->Cell(200, 6, '', 'LRB', 1, 'C');
		
		// $this->Line(5, 33, 210, 33);
		// $this->Line(5, 34, 210, 34);
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
