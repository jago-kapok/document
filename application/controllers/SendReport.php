<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SendReport extends CI_Controller
{
	var $user_id;

    public function __construct()
    {
        parent::__construct();
		authentication();

		$this->load->helper('string');
		$this->load->model('Documents');
		$this->user_id		= $this->session->userdata('user_id');
		$this->company_id	= $this->session->userdata('company_id');
    }

    public function index()
    {
		$year		= $this->input->get('year');
		$periode	= $this->input->get('periode');

		if (!$year || !$periode) {
			show_404();
		}

		$document	= $this->Documents->getDocument($this->company_id, $year, $periode)->row();
		
		if (!$document) {
			$input = array(
				'company_id'	=> $this->company_id,
				'doc_folder'	=> $year.$periode.$this->company_id.date('md'),
				'doc_year'		=> $year,
				'doc_periode'	=> $periode,
				'doc_status'	=> 1,
				'doc_active'	=> 1,
				'doc_created_by'=> $this->user_id
			);

			$this->db->set($input)->insert('document');

			$doc_id 	= $this->db->insert_id();
			$doc_status	= 1;
		} else {
			$doc_id 	= $document->doc_id;
			$doc_status	= $document->doc_status;
		}

		$data = array(
			'title'			=> 'Pelaporan Dokumen Lingkungan',
			'company_id'	=> $this->company_id,
			'doc'			=> $this->Documents->getDocumentById($doc_id)->row(),
			'doc_detail'	=> $this->Documents->getDocumentDetail($doc_id, $doc_status)->result_array(),
		);

		$this->load->view('templates/header', $data);
		$this->load->view('send-report/index', $data);
		$this->load->view('templates/footer');
    }

	public function store()
	{
		$errors = [];
        $data 	= [];

		$doc_id			= $this->input->post('doc_id');
		$file_type_id	= $this->input->post('file_type_id');

		$document		= $this->Documents->getDocumentById($doc_id)->row();

		if($_FILES['file_upload']['error'] > 0) {
            $errors['error_upload'] = 'Mohon pilih dokumen terlebih dahulu !';
        }
	 
		if (!empty($errors)) {
            $data['success'] = false;
            $data['errors']	 = $errors;
        } else {
        	$location = FCPATH."/reports/".$document->doc_folder;

	        if(!file_exists($location)) {
	            mkdir($location, 0777);
	        }

			$revision = $this->db->where(['doc_id' => $doc_id, 'file_type_id' => $file_type_id, 'doc_status' => 4])->get('document_detail')->row();

			if ($revision) {
				$location = FCPATH."/reports/".$revision->doc_folder;
				$doc_file = $this->upload_file($location, "file_upload");

				$input = array(
					'doc_file'			=> $doc_file,
					'doc_status'		=> 2,
					'doc_modified_by'	=> $this->user_id,
					'doc_modified_at'	=> date('Y-m-d H:i:s'),
					'doc_detail_id'		=> $revision->doc_detail_id
				);
				
				$this->db->set($input)->update('document_detail');
			} else {
				$doc_file = $this->upload_file($location, "file_upload", $file_type_id);

	        	$input = array(
					'company_id'		=> $this->company_id,
					'doc_id'			=> $doc_id,
					'file_type_id'		=> $file_type_id,
					'doc_folder'		=> $document->doc_folder,
					'doc_file'			=> $doc_file,
					'doc_status'		=> 1,
					'doc_modified_by'	=> $this->user_id,
					'doc_modified_at'	=> date('Y-m-d H:i:s')
				);

            	$this->db->set($input)->insert('document_detail');
            }

            $data['year'] = $document->doc_year;
            $data['periode'] = $document->doc_periode;
            $data['success'] = true;
            $data['message'] = 'Success!';
        }

        echo json_encode($data);
	}

    private function upload_file($location, $file, $file_type_id)
    {
        $config['upload_path']          = $location;
        $config['allowed_types']        = 'pdf';
        $config['file_name']            = $file_type_id.date("ymd").'_'.random_string('alnum', 30);
        $config['overwrite']         	= false;
        // $config['max_size']          = 2048; // 2MB

        $this->load->library('upload', $config);

        $this->upload->do_upload($file);

        return $this->upload->data('file_name');
    }

    public function delete_doc()
    {
    	$doc_detail_id = $this->input->post('doc_detail_id');

    	$doc_exist = $this->db->where('doc_detail_id', $doc_detail_id)->get('document_detail')->row();
    	$location = FCPATH."/reports/".$doc_exist->doc_folder."/".$doc_exist->doc_file;

    	unlink($location);

        $this->db->delete("document_detail", ["doc_detail_id" => $doc_detail_id]);
        
        $data['success'] = true;
        $data['message'] = 'Success!';
        echo json_encode($data);
    }

    public function confirm()
    {
		$errors = [];
        $data 	= [];

    	$doc_id = $this->input->post('doc_id');
		$document = $this->Documents->getDocumentDetail($doc_id, 1)->result_array();

		foreach ($document as $row) {
			if ($row['doc_file'] === null) {
				$errors['error_upload'] = 'Mohon lengkapi seluruh dokumen terlebih dahulu !';
			}
		}

		if (!empty($errors)) {
            $data['success'] = false;
            $data['errors']	 = $errors;
        } else {
			$this->db->set('doc_status', 2);
			$this->db->where('doc_id', $doc_id);
			$this->db->update('document');

			$this->db->set('doc_status', 2);
			$this->db->where('doc_id', $doc_id);
			$this->db->update('document_detail');

            $data['success'] = true;
            $data['message'] = 'Success!';
        }

        echo json_encode($data);
    }
}
