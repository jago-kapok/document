<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Report extends CI_Controller
{	
    public function __construct()
    {
        parent::__construct();

		$this->load->model('Documents');
    }

    /* ============================================================ */
	/*
	/* ============================================================ */

    public function all()
    {
        $data['year'] = $this->db->select('doc_year')->group_by('doc_year')->order_by('doc_year', 'desc')->get('document')->result_array();
        $data['url']  = $this->uri->segment(2);

        $this->load->view('templates/header', $data);
        $this->load->view('report/index', $data);
        $this->load->view('templates/footer');
		$this->load->view('templates/js/report');
    }

    /* ============================================================ */
	/*
	/* ============================================================ */

	public function verify()
    {
        $data['year'] = $this->db->select('doc_year')->group_by('doc_year')->order_by('doc_year', 'desc')->get('document')->result_array();
        $data['url']  = $this->uri->segment(2);

        $this->load->view('templates/header', $data);
        $this->load->view('report/index', $data);
        $this->load->view('templates/footer');
		$this->load->view('templates/js/verify');
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

		$data['doc_history'] = $this->Documents->getDocumentRevisi($doc_id)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('report/view', $data);
        $this->load->view('templates/footer');
    }

    /* ============================================================ */
	/*
	/* ============================================================ */
	
	public function getData()
	{
		$for = $this->input->get('for');

		switch ($for) {
			case 'verify':
				$_where = 'doc_status = 2 AND doc_active != 0';
				break;
			
			case 'prints':
				$_where = 'doc_status = 3 AND doc_active != 0';
				break;

			case 'user':
				$_where = 'company.company_id = '.user()->company_id.' AND doc_active != 0';
				break;

			default:
				$_where = 'doc_active != 0';
				break;
		}

		$this->load->library("datatables_ssp");

		$_table = "document";
		$_conn 	= [
			"user" 	=> $this->db->username,
			"pass" 	=> $this->db->password,
			"db" 	=> $this->db->database,
			"host" 	=> $this->db->hostname,
			"port" 	=> $this->db->port
		];

		$_key	= "doc_id";
		$_coll	= [
			["db" => "doc_year",		"dt" => "doc_year"],
			["db" => "doc_periode",		"dt" => "doc_periode"],
			["db" => "company_name",	"dt" => "company_name"],
			["db" => "status_desc",		"dt" => "status_desc"],
			["db" => "doc_verified_at",	"dt" => "doc_verified_at"],
			["db" => "doc_id",			"dt" => "doc_id"],

			["db" => "doc_status",		"dt" => "doc_status"],
			["db" => "status_color",	"dt" => "status_color"],
			["db" => "company_address",	"dt" => "company_address"],
			["db" => "company_pic",		"dt" => "company_pic"],
			["db" => "doc_created_at",	"dt" => "doc_created_at"],
		];

		$_join	= 'JOIN company ON company.company_id = document.company_id
					JOIN status ON status.status_id = document.doc_status';

		echo json_encode(
			Datatables_ssp::complex($_GET, $_conn, $_table, $_key, $_coll, $_where, NULL, $_join)
		);
	}
}
