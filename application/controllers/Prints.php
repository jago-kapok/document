<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prints extends CI_Controller
{	
    public function __construct()
    {
        parent::__construct();

		$this->load->library('PDF');
		$this->load->model('Documents');
    }

    /* ============================================================ */
	/*
	/* ============================================================ */

    public function index()
    {
        $data['year'] = $this->db->select('doc_year')->group_by('doc_year')->order_by('doc_year', 'desc')->get('document')->result_array();
        $data['url']  = $this->uri->segment(1);

        $this->load->view('templates/header', $data);
        $this->load->view('report/index', $data);
        $this->load->view('templates/footer');
		$this->load->view('templates/js/print');
    }
	
	/* ============================================================ */
	/*
	/* ============================================================ */

    public function pdf()
    {
		$doc_id	= $this->uri->segment(3);
		$row 	= $this->Documents->getDocumentById($doc_id)->row();
		$doc 	= $this->db->where('doc_id', $doc_id)
					->join('file_type', 'file_type.file_type_id = document_detail.file_type_id')
					->join('status', 'status.status_id = document_detail.doc_status')
					->order_by('document_detail.file_type_id')
					->get('document_detail')->result_array();
		
        // Generate PDF
        $pdf = new PDF();
        $pdf->AddPage('L', 'A5');
        $pdf->setMargins(5,0,0);

        $pdf->SetFont('Arial','', 10);
		$pdf->SetXY(5,36);
		$pdf->Cell(200, 1, '', 'LRT', 1);
		$pdf->Cell(35, 6, ' Nama Perusahaan', 'L', 0);
		$pdf->Cell(95, 6, ': '.$row->company_name, 0, 0);
		$pdf->Cell(35, 6, ' Tanggal Pelaporan', 0, 0);
		$pdf->Cell(35, 6, ': '.date('d-m-Y', strtotime($row->doc_created_at)), 'R', 1);

		$pdf->Cell(35, 6, ' Alamat Perusahaan', 'L', 0);
		$pdf->Cell(95, 6, ': '.$row->company_office_address, 0, 0);
		$pdf->Cell(35, 6, ' Tanggal Verifikasi', 0, 0, 'L');
		$pdf->Cell(35, 6, ': '.date('d-m-Y', strtotime($row->doc_verified_at)), 'R', 1, '');

		$pdf->Cell(35, 6, ' Lokasi Kegiatan', 'L', 0);
		$pdf->Cell(95, 6, ': '.$row->company_address, 0, 0);
		$pdf->Cell(35, 6, ' Periode Laporan', 0, 0, 'L');
		$pdf->Cell(35, 6, ': Semester '.$row->doc_periode, 'R', 1, '');

		// $pdf->Ln();

		$pdf->SetFillColor(145);
		$header	= array('No.', 'Jenis Pelaporan Dokumen', 'Tanggal Verifikasi', 'Status Pelaporan');
		$width	= array(8, 112, 40, 40);
		
		for($i = 0; $i < count($header); $i++)
			$pdf->Cell($width[$i], 6, $header[$i], 1, 0, 'C', true);
		$pdf->Ln();

		foreach($doc as $key => $value)
		{
			$pdf->Cell($width[0], 5, $key + 1, 'LR', 0, 'C');
			$pdf->Cell($width[1], 5, $value['file_type_desc'], 'LR', 0);
			$pdf->Cell($width[2], 5, $value['doc_verified_at'], 'LR', 0, 'C');
			$pdf->Cell($width[3], 5, $value['status_desc'], 'LR', 0, 'C');
			$pdf->Ln();
		}

		$pdf->Cell(200, 1, '', 'T', 1);

		$pdf->SetFont('Arial','I', 9);
		$pdf->Cell(175, 6, '', 'LRT', 0);
		$pdf->Cell(25, 6, '', 'LRT', 1);

		$pdf->Cell(175, 6, '1) Terimakasih anda telah menggunakan aplikasi SIPP DOKLING untuk melaporakan pengelolaan dokumen lingkungan', 'LR', 0);
		$pdf->Cell(25, 6, '', 'R', 1);

		$pdf->Cell(175, 6, '2) Tanda terima ini adalah pengganti tanda terima manual yang diterbitkan oleh Dinas Lingkungan Hidup Kab. Bojonegoro ', 'LR', 0);
		$pdf->Cell(25, 6, '', 'R', 1);

		$pdf->Cell(175, 6, '', 'LRB', 0);
		$pdf->Cell(25, 6, '', 'LRB', 1);

		$pdf->Image('./assets/dist/img/qrcode.png', 182.5, 104, 20);

        $pdf->Output('TTE.pdf', 'I');
		exit();
    }
}