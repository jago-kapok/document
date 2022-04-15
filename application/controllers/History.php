<?php
defined('BASEPATH') or exit('No direct script access allowed');

class History extends CI_Controller
{	
    public function __construct()
    {
        parent::__construct();
		authentication();
    }

    public function index()
    {
        $data['title'] = 'History Pelaporan';

        $this->load->view('templates/header', $data);
        $this->load->view('history/index', $data);
        $this->load->view('templates/footer');
		$this->load->view('templates/js/history');
    }

	public function getData()
	{
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
			["db" => "doc_created_at",	"dt" => "doc_created_at",
				"formatter" => function($data, $row) {
					return date('d-m-Y H:i', strtotime($data));
				}
			],
			["db" => "status_desc",		"dt" => "status_desc"],
			["db" => "doc_sign_file",	"dt" => "doc_sign_file"],
			["db" => "doc_id",			"dt" => "doc_id"],

			["db" => "doc_folder",		"dt" => "doc_folder"],
            ["db" => "doc_status",      "dt" => "doc_status"],
		];
		
		$_where	= 'company_id = '.$this->session->userdata('company_id');
		$_join	= 'JOIN status ON status.status_id = document.doc_status';

		echo json_encode(
			Datatables_ssp::complex($_GET, $_conn, $_table, $_key, $_coll, $_where, NULL, $_join)
		);
	}

	public function view()
    {
    	$id = $this->uri->segment(3);
        $data['title'] = 'History Pelaporan Detail';
        $data['doc'] = $this->db->where('doc_id', $id)->join('file_type', 'file_type.file_type_id = document_detail.file_type_id')
        				->join('status', 'status.status_id = document_detail.doc_status')
        				->order_by('document_detail.file_type_id')->get('document_detail')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('history/view', $data);
        $this->load->view('templates/footer');
    }

    public function delete()
    {
        $id = $this->uri->segment(3);

		if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
        	$this->db->set('company_status', 0);
        	$this->db->where('company_id', $id);
        	$this->db->update("company");

            $data['success'] = true;
            $data['message'] = 'Success!';
        }
        
        echo json_encode($data);
    }
}
