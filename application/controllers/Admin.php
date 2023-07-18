<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('key');
        $this->load->model('Documents');
    }

    public function index()
    {
        $data['doc'] = $this->Documents->getDocumentAndCompany()->result_array();

        if (user()->level == 1)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $this->user();
        }
    }

    public function user()
    {
        $data['users'] = [];
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/user', $data);
        $this->load->view('templates/footer');
    }
}