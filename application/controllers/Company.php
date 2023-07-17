<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company extends CI_Controller
{	
    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
    }

    /* ============================================================ */
	/*
	/* ============================================================ */

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('company/index');
        $this->load->view('templates/footer');
		$this->load->view('templates/js/company');
    }

    /* ============================================================ */
	/*
	/* ============================================================ */

    public function create()
    {
        $this->load->view('templates/header');
        $this->load->view('company/_form');
        $this->load->view('templates/footer');
		$this->load->view('templates/js/company');
    }

    /* ============================================================ */
	/*
	/* ============================================================ */

	public function update()
    {
    	$id = $this->uri->segment(3);
        $data['company'] = $this->db->where('company_id', $id)->get('company')->row();

        $this->load->view('templates/header', $data);
        $this->load->view('company/_form_update', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/js/company');
    }

    /* ============================================================ */
	/*
	/* ============================================================ */
	
	public function view()
    {
    	$id = $this->uri->segment(3);
        $data['company'] = $this->db->where('company_id', $id)->get('company')->row();

        $this->load->view('templates/header', $data);
        $this->load->view('company/view', $data);
        $this->load->view('templates/footer');
		$this->load->view('templates/js/company');
    }

    /* ============================================================ */
	/*
	/* ============================================================ */
	
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

	/* ============================================================ */
	/*
	/* ============================================================ */
	
	public function store()
	{
		$mode_form  = $this->input->post('mode_form');
		$company_id = $this->input->post('company_id');

		$data_post = array(
			'company_name'				=> $this->input->post('company_name'),
			'company_address'			=> $this->input->post('company_address'),
			'company_office_address'	=> $this->input->post('company_office_address'),
			'company_phone'				=> $this->input->post('company_phone'),
			'company_pic'				=> $this->input->post('company_pic'),
			'company_pic_phone'			=> $this->input->post('company_pic_phone'),
			'company_business'			=> $this->input->post('company_business'),
			'company_business_scale'	=> $this->input->post('company_business_scale'),
			'company_license_env'		=> $this->input->post('company_license_env'),
			'company_folder'			=> date('ymd').rand(),
			'company_status'			=> 1
		);

		$data_post = $this->security->xss_clean($data_post);

        if ($this->rules() == 200)
        {
        	switch ($mode_form) {
        	    case 'Add':
        	        $this->db->insert('company', $data_post);
        	        $data['company_id'] = $this->db->insert_id();
        	        break;
        	    case 'Edit':
        	    	$this->db->where('company_id', $company_id);
        	    	$this->db->update('company', $data_post);
        	    	$data['company_id'] = $company_id;
        	    	break;
        	}            
            
            $data['success'] = true;
            $data['message'] = 'Data berhasil disimpan';
        }
        else
        {
            $errors = explode("\n", $this->rules());

            foreach ($errors as $key => $val) {
                $data['errors'][$key] = $val;
            }
        }
        
        echo json_encode($data);
	}

	/* ============================================================ */
	/*
	/* ============================================================ */
	
	public function upload()
	{
		$errors = [];

		$company_id	= $this->input->post('company_id');
		$file_title	= $this->input->post('file_title');

		if ($_FILES['file_upload']['error'] > 0) {
            $errors['error_upload'] = 'Mohon lampirkan file terlebih dahulu !';
        }
	 
		if (!empty($errors)) {
            $data['success'] = false;
            $data['errors']  = $errors;
        }
        else {
        	$company  = $this->db->where('company_id', $company_id)->get('company')->row();
			$location = FCPATH."/documents/".$company->company_folder;

	        if (!file_exists($location)) mkdir($location, 0777);

	        $file_name = upload_file($location, 'file_upload');

			$this->db->set($file_title, $file_name);
			$this->db->where('company_id', $company_id);
			$this->db->update('company');

            $data['success']	= true;
            $data['message']	= 'Dokumen berhasil diupload !';
            $data['company_id']	= $company_id;
        }
        
        echo json_encode($data);
	}


    /* ============================================================ */
	/*
	/* ============================================================ */

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

    /* ============================================================ */
	/*
	/* ============================================================ */

    public function rules()
    {
        $this->form_validation->set_error_delimiters('', '');

        $config = [
            [
                'field' => 'company_name',
                'rules' => 'required',
                'errors'=> [
                    'required' => 'Nama perusahaan tidak boleh kosong !'
                ]
            ],
        ];

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        {
            $result = validation_errors();
        }
        else
        {
            $result = 200;
        }

        return $result;
    }
}
