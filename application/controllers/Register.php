<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Register extends CI_Controller
{	
    public function __construct()
    {
        parent::__construct();
    }

    /* ============================================================ */
	/*
	/* ============================================================ */

	public function index()
    {
        $this->load->view('admin/register');
    }

    /* ============================================================ */
	/*
	/* ============================================================ */
	
	public function store()
    {
        $auth_email             = $this->input->post('auth_email');
        $auth_pass              = $this->input->post('auth_pass');

        if (!isset($auth_email) && $auth_email == '') {
            $errors['erros_message'] = 'Username / email tidak boleh kosong !';
        }

        if (!isset($auth_pass) && $auth_pass == '') {
            $errors['erros_message'] = 'Password tidak boleh kosong !';
        }

        if (strlen($auth_pass) < 8) {
            $errors['erros_message'] = 'Password minimal 8 karakter dengan kombinasi huruf dan angka';
        }
     
        if (!empty($errors)) {
            $data['success'] = false;
            $data['errors']  = $errors;
        } else {
            $data_post = array(
                'company_name'              => $this->input->post('company_name'),
                'company_office_address'    => $this->input->post('company_office_address'),
                'company_phone'             => $this->input->post('company_phone'),
                'company_business'          => $this->input->post('company_business'),
                'company_business_scale'    => $this->input->post('company_business_scale'),
                'company_license_env'       => $this->input->post('company_license_env'),
                'company_folder'            => date('ymd').rand(), 
                'company_status'            => 1
            );

            $this->db->insert('company', $data_post);
            $company_id = $this->db->insert_id();

            $data_account = array(
                'company_id'    => $company_id,
                'username'      => $this->input->post('company_name'),
                'email'         => $auth_email,
                'password'      => password_hash($auth_pass, PASSWORD_BCRYPT),
                'level'         => 2,
                'active'        => 1
            );

            $this->db->insert('users', $data_account);

            $data['success'] = true;
            $data['message'] = 'Success!';
        }
        
        echo json_encode($data);
    }
}
