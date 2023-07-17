<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
        $data['title'] = 'Manajemen Pengguna';
        $data['level'] = $this->db->get('groups')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
		$this->load->view('templates/js/user');
    }

    /* ============================================================ */
	/*
	/* ============================================================ */
	
	public function getData()
	{
		$this->load->library("datatables_ssp");
		$_table = "users";
		$_conn 	= [
			"user" 	=> $this->db->username,
			"pass" 	=> $this->db->password,
			"db" 	=> $this->db->database,
			"host" 	=> $this->db->hostname,
			"port" 	=> $this->db->port
		];
		$_key	= "id";
		$_coll	= [
			["db" => "username",	"dt" => "username"],
			["db" => "email",		"dt" => "email"],
			["db" => "company_name","dt" => "company_name"],
			["db" => "id",			"dt" => "level",
				"formatter" => function($data, $row) {
					$level = $data == 1 ? 'Administrator' : 'Users';
					return $level;
				}
			],
			["db" => "active",		"dt" => "active"],
			["db" => "id",			"dt" => "id"],
		];
		
		$_where	= NULL;
		$_join	= "JOIN company ON users.company_id = company.company_id";

		echo json_encode(
			Datatables_ssp::complex($_GET, $_conn, $_table, $_key, $_coll, $_where, NULL, $_join)
		);
	}

	/* ============================================================ */
	/*
	/* ============================================================ */
	
	public function status()
	{
		$id 	= $this->input->get('id');
		$users 	= $this->db->where('id', $id)->get('users')->row();
		$status = $users->active == 1 ? 0 : 1;
	 
		$this->db->set('active', $status);
        $this->db->where('id', $id);
        $this->db->update('users');

        $data['success'] = true;
        $data['message'] = $users->active == 1 ? 'Akun telah dinon-aktifkan' : 'Akun telah diaktifkan';
        
        echo json_encode($data);
	}

	/* ============================================================ */
	/*
	/* ============================================================ */

	public function reset()
	{
		$id = $this->input->get('id');
	 
       	$this->db->set('password', password_hash('12345', PASSWORD_BCRYPT));
       	$this->db->where('id', $id);
        $this->db->update('users');

        $data['success'] = true;
        $data['message'] = 'Akun berhasil direset password ke default = 12345';
        
        echo json_encode($data);
	}

	/* ============================================================ */
	/*
	/* ============================================================ */

    public function setting()
    {
        $data['user'] = $this->db->where('id', user()->id)->get('users')->row();

        $this->load->view('templates/header', $data);
        $this->load->view('user/_form_update', $data);
        $this->load->view('templates/footer');
    }

    /* ============================================================ */
	/*
	/* ============================================================ */

    public function updateProfile()
	{
		$user_name		= $this->input->post('username');
		$new_auth		= $this->input->post('new_auth');
		$confirm_auth	= $this->input->post('confirm_auth');

		if(isset($new_auth) && $new_auth != '') {
			if($new_auth != $confirm_auth) {
	            $errors['password_error'] = 'Password Baru dan Password Konfirmasi harus sama !';
	        }

	        if(strlen($new_auth) < 8) {
	            $errors['password_error'] = 'Password Baru minimal 8 karakter dengan kombinasi huruf dan angka';
	        }

	        if(password_verify($new_auth, $this->session->userdata('user_password'))) {
	        	$errors['password_error'] = 'Password Baru sama dengan password sebelumnya';
	        }

	        $password_hash = password_hash($new_auth, PASSWORD_BCRYPT);
	        $this->db->set('password', $password_hash);
	    }
	 
		if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
	        $this->db->set('username', $user_name);
        	$this->db->where('id', user()->id);
        	$this->db->update('users');

            $data['success'] = true;
            $data['message'] = 'Data akun anda berhasil diperbarui';
        }
        
        echo json_encode($data);
	}
}
