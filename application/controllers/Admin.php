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

    /* ============================================================ */
    /*
    /* ============================================================ */

    public function index()
    {
        $data['doc']        = $this->Documents->getDetailDashboard()->result_array();
        $data['all']        = $this->Documents->getForDashboard('')->num_rows();
        $data['waiting']    = $this->Documents->getForDashboard(2)->num_rows();
        $data['verified']   = $this->Documents->getForDashboard(3)->num_rows();
        $data['company']    = $this->db->get('company')->num_rows();

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

    /* ============================================================ */
    /*
    /* ============================================================ */

    public function user()
    {
        $data['status_pelaporan'] = $this->Documents->getStatusPelaporan(user()->company_id)->result_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/user', $data);
        $this->load->view('templates/footer');
    }
}