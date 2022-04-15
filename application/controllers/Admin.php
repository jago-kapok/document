<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('key');
	    authentication();
    }

    public function index()
    {
        $data['title'] = 'SIPP DOKLING - Kab. Bojonegoro';

        $this->load->view('templates/header', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function user()
    {
        $company_id = $this->session->userdata('company_id');
        $data['title'] = 'SIPP DOKLING - Kab. Bojonegoro';
        $data['doc'] = $this->db->select('document_detail.*, status.*, file_type.*')->where(['document_detail.company_id'=>$company_id, 'doc_active'=>1])
                        ->join('document', 'document.doc_id = document_detail.doc_id')
                        ->join('file_type', 'file_type.file_type_id = document_detail.file_type_id')
                        ->join('status', 'status.status_id = document_detail.doc_status')
                        ->order_by('document_detail.file_type_id')->get('document_detail')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/user', $data);
        $this->load->view('templates/footer');
    }
}