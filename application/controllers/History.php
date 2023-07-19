<?php
defined('BASEPATH') or exit('No direct script access allowed');

class History extends CI_Controller
{	
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Documents');
    }

    /* ============================================================ */
	/*
	/* ============================================================ */

    public function index()
    {
        $data['year'] = $this->db->select('doc_year')->group_by('doc_year')->order_by('doc_year', 'desc')->get('document')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('history/index', $data);
        $this->load->view('templates/footer');
		$this->load->view('templates/js/history');
    }

    /* ============================================================ */
	/*
	/* ============================================================ */

	public function view()
    {
    	$doc_id 	 = $this->uri->segment(3);
        $data['doc'] = $this->Documents->getDocumentDetail($doc_id, 5)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('history/view', $data);
        $this->load->view('templates/footer');
    }
}
