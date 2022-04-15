<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{	
    public function __construct()
    {
        parent::__construct();
		authentication();
    }

	public function index()
    {
    	$this->session->set_userdata('company_id', 8);
    	$id = $this->session->userdata('company_id');

        $data['title'] = 'Profile Perusahaan';
        $data['company'] = $this->db->where('company_id', $id)->get('company')->row();

        $this->load->view('templates/header', $data);
        $this->load->view('profile/index', $data);
        $this->load->view('templates/footer');
    }
	
	public function edit()
	{
		$company_id				= $this->input->post('company_id');
		$company_name			= $this->input->post('company_name');
		$company_address		= $this->input->post('company_address');
		$company_office_address	= $this->input->post('company_office_address');
		$company_phone			= $this->input->post('company_phone');
		$company_pic			= $this->input->post('company_pic');
		$company_pic_phone		= $this->input->post('company_pic_phone');
		$company_business		= $this->input->post('company_business');
		$company_business_scale	= $this->input->post('company_business_scale');
		$company_license_env	= $this->input->post('company_license_env');
	 
		if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
        	$file_exist = $this->db->where('company_id', $company_id)->get('company')->row();

        	$location = FCPATH."/documents/".$file_exist->company_folder;

        	if(!$_FILES['struktur_organisasi']['error'] > 0) {
        		unlink($location.'/'.$file_exist->company_organitation_file);
	            $struktur_organisasi = $this->upload_file($location, "struktur_organisasi");
	        } else {
	            $struktur_organisasi = $file_exist->company_organitation_file;
	        }

	        if(!$_FILES['perijinan']['error'] > 0) {
	        	unlink($location.'/'.$file_exist->company_license_file);
	            $perijinan = $this->upload_file($location, "perijinan");
	        } else {
	            $perijinan = $file_exist->company_license_file;
	        }
		
			$data_post = array(
				'company_name'				=> $company_name,
				'company_address'			=> $company_address,
				'company_office_address'	=> $company_office_address,
				'company_phone'				=> $company_phone,
				'company_pic'				=> $company_pic,
				'company_pic_phone'			=> $company_pic_phone,
				'company_business'			=> $company_business,
				'company_business_scale'	=> $company_business_scale,
				'company_license_env'		=> $company_license_env,
				'company_organitation_file'	=> $struktur_organisasi,
				'company_license_file'		=> $perijinan
			);

        	$this->db->where('company_id', $company_id);
            $this->db->update('company', $data_post);

            $data['success'] = true;
            $data['message'] = 'Success!';
            $data['company_id'] = $company_id;
        }
        
        echo json_encode($data);
	}

	public function view()
    {
    	$id = $this->uri->segment(3);
        $data['title'] = 'Profil Perusahaan';
        $data['company'] = $this->db->where('company_id', $id)->get('company')->row();

        $this->load->view('templates/header', $data);
        $this->load->view('profile/view', $data);
        $this->load->view('templates/footer');
    }

    private function upload_file($location, $file)
    {
        $config['upload_path']          = $location;
        $config['allowed_types']        = 'jpg|jpeg|png|pdf';
        $config['file_name']            = 'dokumen_'.date("ymds").rand();
        // $config['overwrite']         = true;
        $config['max_size']             = 2048; // 2MB

        $this->load->library('upload', $config);

        $this->upload->do_upload($file);

        return $this->upload->data('file_name');
    }
}
