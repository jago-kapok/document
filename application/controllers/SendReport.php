<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SendReport extends CI_Controller
{
	var $user_id;

    public function __construct()
    {
        parent::__construct();

		$this->load->helper('string');
		$this->load->model('Documents');
    }

    /* ============================================================ */
	/*
	/* ============================================================ */

    public function index()
    {
		$year		= $this->input->get('year');
		$periode	= $this->input->get('periode');

		if (!$year || $year > date('Y') || !$periode || $periode > 2) show_404();

		$document = $this->Documents->getDocument(user()->company_id, $year, $periode)->row();
		
		if (!$document)
		{
			$doc_folder = $year.$periode.date('md').user()->company_id;

			$data_post = array(
				'company_id'		=> user()->company_id,
				'doc_folder'		=> $doc_folder,
				'doc_year'			=> $year,
				'doc_periode'		=> $periode,
				'doc_status'		=> 1,
				'doc_active'		=> 1,
				'doc_created_by'	=> user()->id
			);

			$this->db->insert('document', $data_post);
			$doc_id = $this->db->insert_id();
		} else {
			$doc_id = $document->doc_id;
		}

		$data = array(
			'company_id'	=> user()->company_id,
			'year'			=> $year,
			'periode'		=> $periode,
			'doc'			=> $this->Documents->getDocumentById($doc_id)->row(),
			'doc_detail'	=> $this->Documents->getDocumentDetail($doc_id, 5)->result_array(),
			'total_doc'		=> $this->db->get('file_type')->num_rows(),
			'total_upload'	=> $this->Documents->getDocumentDetailById($doc_id, ['doc_status' => 1])->num_rows()
		);

		$this->load->view('templates/header', $data);
		$this->load->view('send-report/index', $data);
		$this->load->view('templates/footer');
		$this->load->view('send-report/js', $data);
    }

    /* ============================================================ */
	/*
	/* ============================================================ */

	public function store()
	{
		$errors = [];
        $data 	= [];

		$doc_id			= $this->input->post('doc_id');
		$file_type_id	= $this->input->post('file_type_id');
		$doc			= $this->Documents->getDocumentById($doc_id)->row();

		if ($_FILES['file_upload']['error'] > 0) {
            $errors['error_upload'] = 'Mohon pilih dokumen terlebih dahulu !';
        }
	 
		if (!empty($errors))
		{
            $data['success'] = false;
            $data['errors']	 = $errors;
        }
        else
        {
			$location = FCPATH."/reports/".$doc->doc_folder;

	        if (!file_exists($location)) {
	            mkdir($location, 0777);
	        }

			$doc_file = upload_file($location, 'file_upload');

			$data_post = array(
				'company_id'		=> user()->company_id,
				'doc_id'			=> $doc_id,
				'file_type_id'		=> $file_type_id,
				'doc_folder'		=> $doc->doc_folder,
				'doc_file'			=> $doc_file,
				'doc_status'		=> 1,
				'doc_modified_by'	=> user()->id,
				'doc_modified_at'	=> date('Y-m-d H:i:s')
			);

			$this->db->insert('document_detail', $data_post);

            $data['year'] 	 = $doc->doc_year;
            $data['periode'] = $doc->doc_periode;
            $data['success'] = true;
            $data['message'] = 'Dokumen berhasil diupload !';
        }

        echo json_encode($data);
	}

    /* ============================================================ */
	/*
	/* ============================================================ */

    public function delete()
    {
    	$doc_detail_id 	= $this->input->post('doc_detail_id');
    	$doc_detail 	= $this->db->where('doc_detail_id', $doc_detail_id)->get('document_detail')->row();
    	$doc_location	= FCPATH."/reports/".$doc_detail->doc_folder."/".$doc_detail->doc_file;
    	$doc 			= $this->Documents->getDocumentById($doc_detail->doc_id)->row();
        
    	unlink($doc_location);
        $this->db->delete("document_detail", ["doc_detail_id" => $doc_detail_id]);

        $data['year']	 = $doc->doc_year;
        $data['periode'] = $doc->doc_periode;
        $data['success'] = true;
        $data['message'] = 'Dokumen berhasil dihapus ! Anda bisa mengupload dokumen baru';

        echo json_encode($data);
    }

    /* ============================================================ */
	/*
	/* ============================================================ */

    public function send()
    {
		$errors = [];
    	$doc_id = $this->input->post('doc_id');
		$doc 	= $this->Documents->getDocumentById($doc_id)->row();

		/* Menunggu Verifikasi */
		$this->db->set('doc_status', 2);
		$this->db->where('doc_id', $doc_id);
		$this->db->update('document');

		/* Menunggu Verifikasi */
		$this->db->set('doc_status', 2);
		$this->db->where('doc_id', $doc_id);
		$this->db->where('doc_status', 1);
		$this->db->update('document_detail');

		$data['year']	 = $doc->doc_year;
		$data['periode'] = $doc->doc_periode;
        $data['success'] = true;
        $data['message'] = 'Dokumen berhasil dikirim, anda dapat melihat progress laporan melalui dashboard aplikasi';

        echo json_encode($data);
    }

    /* ============================================================ */
	/*
	/* ============================================================ */

	public function revisi()
	{
		$errors = [];
        $data 	= [];

		$doc_detail_id	= $this->input->post('doc_detail_id');
		$doc_detail		= $this->Documents->getFromDetailId($doc_detail_id, [])->row();
		$doc			= $this->Documents->getDocumentById($doc_detail->doc_id)->row();

		if ($_FILES['file_upload']['error'] > 0) {
            $errors['error_upload'] = 'Mohon pilih dokumen terlebih dahulu !';
        }
	 
		if (!empty($errors))
		{
            $data['success'] = false;
            $data['errors']	 = $errors;
        }
        else
        {
			$location = FCPATH."/reports/".$doc->doc_folder;
			$doc_file = upload_file($location, 'file_upload');

			$data_post = array(
				'doc_file'			=> $doc_file,
				'doc_status'		=> 2,
				'doc_modified_by'	=> user()->id,
				'doc_modified_at'	=> date('Y-m-d H:i:s')
			);

			$this->db->update('document_detail', $data_post, ['doc_detail_id' => $doc_detail_id]);

            $data['year'] 	 = $doc->doc_year;
            $data['periode'] = $doc->doc_periode;
            $data['success'] = true;
            $data['message'] = 'Dokumen revisi berhasil diupload !';
        }

        echo json_encode($data);
	}
}