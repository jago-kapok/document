<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Auth extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->library('session');
	}
 
	public function index()
    {
        $this->load->view('templates/auth_header');
        $this->load->view('admin/login');
        // $this->load->view('templates/footer');
    }
 
	function login(){
		$username = $this->input->post('user_name');
		$password = $this->input->post('user_auth');
		
		$user = $this->db->select('user.*, company.company_name as company_name')->where('user_name', $username)->where('user_status', 1)->join('company', 'company.company_id = user.company_id')->get('user')->row();
		
		if(password_verify($password, $user->user_password))
		{
			$data_session = array(
				'user_id'		=> $user->user_id,
				'company_name'	=> $user->company_name,
				'user_level'	=> $user->user_level,
				'user_name'		=> $user->user_name,
				'user_password'	=> $user->user_password,
				'company_id'	=> $user->company_id,
			);
 
			$this->session->set_userdata($data_session);

			if($user->user_level == 1) {
				redirect(base_url(""));
			} else {
				redirect(base_url("admin/user"));
			}
		} else {
			if(!$user->user_name) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show">Username tidak terdaftar !</div>');
				
				redirect(base_url("auth"));
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show">Password yang anda masukkan salah !</div>');
				
				redirect(base_url("auth"));
			}
		}
	}
 
	function logout(){
		$this->session->sess_destroy();
		session_write_close();
		
		$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible fade show">Sign out berhasil !<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		
		redirect(base_url("auth"));
	}
}
