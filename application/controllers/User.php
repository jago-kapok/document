<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{	
    public function __construct()
    {
        parent::__construct();
		authentication();
    }

    public function index()
    {
        $data['title'] = 'Manajemen Pengguna';
        $data['level'] = $this->db->get('level')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
		$this->load->view('templates/js/user');
    }
	
	public function getData()
	{
		$this->load->library("datatables_ssp");
		$_table = "user";
		$_conn 	= [
			"user" 	=> $this->db->username,
			"pass" 	=> $this->db->password,
			"db" 	=> $this->db->database,
			"host" 	=> $this->db->hostname,
			"port" 	=> $this->db->port
		];
		$_key	= "user_id";
		$_coll	= [
			["db" => "user_name",	"dt" => "user_name"],
			["db" => "level_desc",	"dt" => "level_desc"],
			["db" => "company_name","dt" => "company_name"],
			["db" => "user_status",	"dt" => "user_status"],
			["db" => "user_id",		"dt" => "user_id"],
		];
		
		$_where	= NULL;
		$_join	= "JOIN level ON user.user_level = level.level_id JOIN company ON user.company_id = company.company_id";

		echo json_encode(
			Datatables_ssp::complex($_GET, $_conn, $_table, $_key, $_coll, $_where, NULL, $_join)
		);
	}
	
	public function store()
	{
		$user_fullname	= $this->input->post('user_fullname');
		$user_name		= $this->input->post('user_name');
		$user_password	= $this->input->post('user_password');
		$user_address	= $this->input->post('user_address');
		$user_phone		= $this->input->post('user_phone');
		$user_level		= $this->input->post('user_level');
		
		$data = array(
			'user_fullname'	=> $user_fullname,
			'user_name'		=> $user_name,
			'user_password'	=> $user_password,
			'user_address'	=> $user_address,
			'user_phone'	=> $user_phone,
			'user_level'	=> $user_level,
		);
	 
		$exist = $this->MasterModel->getBy('user', array('user_name'=>$user_name));
		
		if($exist->num_rows() == 0){
			$this->MasterModel->add('user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show"><i class="fas fa-info-circle"></i>&nbsp;&nbsp;Pengguna baru berhasil ditambahkan !<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show"><i class="fas fa-info-circle"></i>&nbsp;&nbsp;Username '.strtoupper($user_name).' sudah digunakan !<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('user');
	}
	
	public function status()
	{
		$user_id = $this->uri->segment(3);

		$user = $this->db->where('user_id', $user_id)->get('user')->row();

		$set_status = $user->user_status == 1 ? 0 : 1;
	 
		if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
        	$this->db->set('user_status', $set_status);
        	$this->db->where('user_id', $user_id);
            $this->db->update('user');

            $data['message_status'] = $user->user_status == 1 ? 'Akun telah dinon-aktifkan' : 'Akun telah diaktifkan';
            $data['success'] = true;
            $data['message'] = 'Success!';
        }
        
        echo json_encode($data);
	}

	public function reset()
	{
		$user_id = $this->uri->segment(3);
	 
		if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
        	$this->db->set('user_password', password_hash('12345', PASSWORD_BCRYPT));
        	$this->db->where('user_id', $user_id);
            $this->db->update('user');

            $data['message_status'] = 'Akun berhasil direset password ke default = 12345';
            $data['success'] = true;
            $data['message'] = 'Success!';
        }
        
        echo json_encode($data);
	}

    public function setting()
    {
        $data['title'] = 'Manajemen Akun';
        $data['user'] = $this->db->where('user_id', $this->session->userdata('user_id'))->get('user')->row();

        $this->load->view('templates/header', $data);
        $this->load->view('user/_form_update', $data);
        $this->load->view('templates/footer');
    }

    public function updateProfile()
	{
		$user_id		= $this->input->post('user_id');
		$user_name		= strtolower($this->input->post('user_name'));
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
	    }
	 
		if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
        	if(isset($new_auth) && $new_auth != '') {
	        	$password_hash = password_hash($new_auth, PASSWORD_BCRYPT);
	        	$this->session->set_userdata('user_password', $password_hash);

	        	$this->db->set('user_password', $password_hash);
	        }

	        $this->db->set('user_name', $user_name);
        	$this->db->where('user_id', $user_id);
        	$this->db->update('user');

        	$this->session->set_userdata('user_name', $user_name);

            $data['success'] = true;
            $data['message'] = 'Success!';
        }
        
        echo json_encode($data);
	}
}
