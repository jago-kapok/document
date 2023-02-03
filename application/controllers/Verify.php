<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verify extends CI_Controller
{	
    public function __construct()
    {
        parent::__construct();
		authentication();
    }

    public function index()
    {
        $data['title'] = 'Verifikasi Laporan';

        $data['year'] = $this->db->select('doc_year')->group_by('doc_year')->order_by('doc_year', 'desc')->get('document')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('verify/index', $data);
        $this->load->view('templates/footer');
		$this->load->view('templates/js/verify');
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
			["db" => "doc_year",		"dt" => "doc_year"],
			["db" => "doc_periode",		"dt" => "doc_periode",
				"formatter" => function($data, $row) {
					return "Semester ".$data;
				}
			],
			["db" => "company_name",	"dt" => "company_name"],
			["db" => "company_pic",		"dt" => "company_pic"],
			["db" => "status_desc",		"dt" => "status_desc"],
			["db" => "doc_id",			"dt" => "doc_id"],

			["db" => "doc_status",		"dt" => "doc_status"],
			["db" => "company_address",	"dt" => "company_address"],
		];
		
		$_where	= 'doc_status = 2';
		$_join	= 'JOIN company ON company.company_id = document.company_id
					JOIN status ON status.status_id = document.doc_status';

		echo json_encode(
			Datatables_ssp::complex($_GET, $_conn, $_table, $_key, $_coll, $_where, NULL, $_join)
		);
	}
	
	public function edit()
	{
		$doc_id 		= $this->input->post('doc_id');
		$doc_detail_id	= $this->input->post('doc_detail_id');
	 
		if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
			$data_post = array(
				'doc_verified_by'	=> $this->session->userdata('user_id'),
				'doc_verified_at'	=> date('Y-m-d H:i:s'),
				'doc_status'		=> 3
			);

        	$this->db->where('doc_detail_id', $doc_detail_id);
            $this->db->update('document_detail', $data_post);

            $check_status = $this->db->where(['doc_id' => $doc_id, 'doc_status' => 2])->get('document_detail')->result_array();
            
            if(count($check_status) > 0) {
            	$data['success'] = true;
            } else {
            	$this->db->set('doc_status', 3);
                $this->db->set('doc_active', 3);
            	$this->db->set('doc_verified_by', $this->session->userdata('user_id'));
            	$this->db->set('doc_verified_at', date('Y-m-d H:i:s'));
            	$this->db->where('doc_id', $doc_id);
            	$this->db->update('document');

            	$data['success'] = true;
            }

            $data['message'] = 'Success!';
        }
        
        echo json_encode($data);
	}

	public function reject()
	{
		$doc_id 			= $this->input->post('doc_id');
		$doc_detail_id		= $this->input->post('doc_detail_id');
		$doc_rejected_note	= $this->input->post('doc_rejected_note');
	 
		$data_post = array(
			'doc_rejected_by'	=> $this->session->userdata('user_id'),
			'doc_rejected_at'	=> date('Y-m-d H:i:s'),
			'doc_rejected_note'	=> $doc_rejected_note,
			'doc_status'		=> 4,
		);

		$this->db->where('doc_detail_id', $doc_detail_id);
		$this->db->update('document_detail', $data_post);

		// $check_status = $this->db->where(['doc_id' => $doc_id, 'doc_status' => 2])->get('document_detail')->result_array();
		
		// if (count($check_status) > 0) {
		// 	$data['success'] = true;
		// } else {
		// 	$this->db->set('doc_status', 4);
		// 	$this->db->where('doc_id', $doc_id);
		// 	$this->db->update('document');

		// 	$data['success'] = true;
		// }

		$data['success'] = true;
		$data['message'] = 'Success!';
        
        echo json_encode($data);
	}

	public function view()
    {
    	$id = $this->uri->segment(3);
        $data['title'] 		= 'Verifikasi Laporan';
        $data['company'] 	= $this->db->where('doc_id', $id)->join('company', 'company.company_id = document.company_id')
        						->get('document')->row();
        $data['doc'] 		= $this->db->where('doc_id', $id)->join('file_type', 'file_type.file_type_id = document_detail.file_type_id')
		        				->join('status', 'status.status_id = document_detail.doc_status')
		        				->order_by('document_detail.file_type_id')->get('document_detail')->result_array();

        $data['doc_id'] 	= $id;

        $this->load->view('templates/header', $data);
        $this->load->view('verify/view', $data);
        $this->load->view('templates/footer');
    }
}
