<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{	
    public function __construct()
    {
        parent::__construct();
    }

	public function index()
    {
        $this->load->view('admin/register');
    }
	
	public function store()
    {
        $company_name           = $this->input->post('company_name');
        $company_address        = $this->input->post('company_address');
        $company_office_address = $this->input->post('company_office_address');
        $company_phone          = $this->input->post('company_phone');
        $company_pic            = $this->input->post('company_pic');
        $company_pic_phone      = $this->input->post('company_pic_phone');
        $company_business       = $this->input->post('company_business');
        $company_business_scale = $this->input->post('company_business_scale');
        $company_license_env    = $this->input->post('company_license_env');
        $company_land_area      = $this->input->post('company_land_area');
        $company_building_area  = $this->input->post('company_building_area');

        $auth_email  = $this->input->post('auth_email');
        $auth_pass   = $this->input->post('auth_pass');

        if($_FILES['struktur_organisasi']['error'] > 0) {
            $errors['erros_message'] = 'Mohon lampirkan struktur organisasi perusahaan anda';
        }

        if($_FILES['perijinan']['error'] > 0) {
            $errors['erros_message'] = 'Mohon lampirkan dokumen perijinan yang anda miliki';
        }

        if(!isset($auth_email) && $auth_email == '') {
            $errors['erros_message'] = 'Username / email tidak boleh kosong !';
        }

        if(!isset($auth_pass) && $auth_pass == '') {
            $errors['erros_message'] = 'Password tidak boleh kosong !';
        }

        if(strlen($auth_pass) <= 8) {
            $errors['erros_message'] = 'Password minimal 8 karakter dengan kombinasi huruf dan angka';
        }
     
        if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
            $company_folder = date('ymds').rand();
            $location = FCPATH."/documents/".$company_folder;

            if(!file_exists($location)) {
                mkdir($location, 0777);
            }

            $struktur_organisasi = upload_file($location, "struktur_organisasi");
            $perijinan = upload_file($location, "perijinan");

            $data_post = array(
                'company_name'              => $company_name,
                'company_address'           => $company_address,
                'company_office_address'    => $company_office_address,
                'company_phone'             => $company_phone,
                'company_pic'               => $company_pic,
                'company_pic_phone'         => $company_pic_phone,
                'company_business'          => $company_business,
                'company_business_scale'    => $company_business_scale,
                'company_license_env'       => $company_license_env,
                'company_land_area'         => $company_land_area,
                'company_building_area'     => $company_building_area,
                'company_organitation_file' => $struktur_organisasi,
                'company_license_file'      => $perijinan,
                'company_folder'            => $company_folder, 
                'company_status'            => 1
            );

            $this->db->insert('company', $data_post);
            $company_id = $this->db->insert_id();

            $data_account = array(
                'company_id'    => $company_id,
                'user_name'     => $auth_email,
                'user_password' => password_hash($auth_pass, PASSWORD_BCRYPT),
                'user_level'    => 2,
                'user_status'   => 1
            );

            $this->db->insert('user', $data_account);

            $data['success'] = true;
            $data['message'] = 'Success!';
        }
        
        echo json_encode($data);
    }    
}
