<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company extends CI_Controller
{	
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('company/index');
        $this->load->view('templates/footer');
		$this->load->view('templates/js/company');
    }

    public function create()
    {
        $this->load->view('templates/header');
        $this->load->view('company/_form');
        $this->load->view('templates/footer');
    }
	
	public function getData()
	{
		$this->load->library("datatables_ssp");
		$_table = "company";
		$_conn 	= [
			"user" 	=> $this->db->username,
			"pass" 	=> $this->db->password,
			"db" 	=> $this->db->database,
			"host" 	=> $this->db->hostname,
			"port" 	=> $this->db->port
		];
		$_key	= "company_id";
		$_coll	= [
			["db" => "company_name",			"dt" => "company_name"],
			["db" => "company_business",		"dt" => "company_business"],
			["db" => "company_office_address",	"dt" => "company_office_address"],
			["db" => "company_pic",				"dt" => "company_pic"],
			["db" => "company_id",				"dt" => "company_id"],
			
			["db" => "company_phone",			"dt" => "company_phone"]
		];
		
		$_where	= 'company_status = 1';
		$_join	= NULL;

		echo json_encode(
			Datatables_ssp::complex($_GET, $_conn, $_table, $_key, $_coll, $_where, NULL, $_join)
		);
	}
	
	public function store()
	{
		$company_name			= $this->input->post('company_name');
		$company_address		= $this->input->post('company_address');
		$company_office_address	= $this->input->post('company_office_address');
		$company_phone			= $this->input->post('company_phone');
		$company_pic			= $this->input->post('company_pic');
		$company_pic_phone		= $this->input->post('company_pic_phone');
		$company_business		= $this->input->post('company_business');
		$company_business_scale	= $this->input->post('company_business_scale');
		$company_license_env	= $this->input->post('company_license_env');

		if($_FILES['struktur_organisasi']['error'] > 0) {
            $errors['error_upload'] = 'Mohon lampirkan struktur organisasi perusahaan anda';
        }

        if($_FILES['perijinan']['error'] > 0) {
            $errors['error_upload'] = 'Mohon lampirkan dokumen perijinan yang anda miliki';
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

        	$struktur_organisasi = $this->upload_file($location, "struktur_organisasi");
        	$perijinan = $this->upload_file($location, "perijinan");

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
				'company_license_file'		=> $perijinan,
				'company_folder'			=> $company_folder,	
				'company_status'			=> 1
			);

            $this->db->insert('company', $data_post);

            $data['success'] = true;
            $data['message'] = 'Success!';
        }
        
        echo json_encode($data);
	}

	public function update()
    {
    	$id = $this->uri->segment(3);
        $data['title'] = 'Data Perusahaan';
        $data['company'] = $this->db->where('company_id', $id)->get('company')->row();

        $this->load->view('templates/header', $data);
        $this->load->view('company/_form_update', $data);
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
        }
        
        echo json_encode($data);
	}

	public function view()
    {
    	$id = $this->uri->segment(3);
        $data['title'] = 'Data Perusahaan';
        $data['company'] = $this->db->where('company_id', $id)->get('company')->row();

        $this->load->view('templates/header', $data);
        $this->load->view('company/view', $data);
        $this->load->view('templates/footer');
    }

    public function delete()
    {
        $id = $this->uri->segment(3);

		if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
        	$this->db->set('company_status', 0);
        	$this->db->where('company_id', $id);
        	$this->db->update("company");

            $data['success'] = true;
            $data['message'] = 'Success!';
        }
        
        echo json_encode($data);
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
