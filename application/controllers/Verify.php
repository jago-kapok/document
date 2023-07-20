<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Verify extends CI_Controller
{	
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Documents');
    }

    /* ============================================================ */
	/*
	/* ============================================================ */

    public function view()
    {
    	$doc_id 			= $this->uri->segment(3);
        $data['company'] 	= $this->Documents->getDocumentById($doc_id)->row();
        $data['doc'] 		= $this->Documents->getDocumentDetail($doc_id, 5)->result_array();
        $data['doc_id'] 	= $doc_id;

        $this->load->view('templates/header', $data);
        $this->load->view('report/verify', $data);
        $this->load->view('templates/footer');
    }

    /* ============================================================ */
	/*
	/* ============================================================ */

	public function approve()
	{
		$doc_detail_id	= $this->input->post('doc_detail_id');
		$doc 			= $this->Documents->getFromDetailId($doc_detail_id, [])->row();
		$doc_id 		= $doc->doc_id;

		$data_post = array(
			'doc_verified_by'	=> user()->id,
			'doc_verified_at'	=> date('Y-m-d H:i:s'),
			'doc_status'		=> 3
		);

        $this->db->where('doc_detail_id', $doc_detail_id);
        $this->db->update('document_detail', $data_post);

        /* Cek Jumlah Dokumen Terverifikasi */

        $total_doc		= $this->db->get('file_type')->num_rows();
		$total_approve	= $this->Documents->getDocumentDetailById(70, ['doc_status' => 3])->num_rows();

        if ($total_doc == $total_approve)
        {
          	$this->db->set('doc_status', 3);
           	$this->db->set('doc_verified_by', user()->id);
           	$this->db->set('doc_verified_at', date('Y-m-d H:i:s'));
           	$this->db->where('doc_id', $doc_id);
           	$this->db->update('document');
        }

        $data['success'] = true;
        $data['message'] = 'Dokumen telah berhasil diverifikasi !';
        
        echo json_encode($data);
	}

	/* ============================================================ */
	/*
	/* ============================================================ */

	public function reject()
	{
		$doc_detail_id		= $this->input->post('doc_detail_id');
		$doc_rejected_note	= $this->input->post('doc_rejected_note');
		$doc_detail			= $this->Documents->getFromDetailId($doc_detail_id, [])->row();
		$doc_id 			= $doc_detail->doc_id;
	 
		$data_post = array(
			'doc_rejected_by'	=> user()->id,
			'doc_rejected_at'	=> date('Y-m-d H:i:s'),
			'doc_rejected_note'	=> $doc_rejected_note,
			'doc_status'		=> 4,
		);

		$this->db->where('doc_detail_id', $doc_detail_id);
		$this->db->update('document_detail', $data_post);

		/* Insert ke table document_rejected */

		$data_rejected = array(
			'doc_id'			=> $doc_id,
			'file_type_id'		=> $doc_detail->file_type_id,
			'doc_file'			=> $doc_detail->doc_file,
			'doc_rejected_by'	=> user()->id,
			'doc_rejected_at'	=> date('Y-m-d H:i:s'),
			'doc_rejected_note'	=> $doc_rejected_note,
		);

		$this->db->insert('document_rejected', $data_rejected);

		$data['success'] = true;
		$data['message'] = 'Dokumen telah berhasil ditolak !';
        
        echo json_encode($data);
	}

	/* ============================================================ */
	/*
	/* ============================================================ */
	
	public function delete()
    {
    	$doc_id = $this->input->get('id');
        
		$this->db->set('doc_active', 0);
		$this->db->where('doc_id', $doc_id)->update('document');

		$data['success'] = true;

		echo json_encode($data);
    }
}
