<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SendReport extends CI_Controller
{	
    public function __construct()
    {
        parent::__construct();
		authentication();
    }

    public function index()
    {
    	$company_id = $this->session->userdata('company_id');
        $data['title'] = 'Pelaporan Dokumen Lingkungan';
        $data['doc']	= $this->db->where(['company_id'=>$company_id, 'doc_active'=>1])->get('document')->row();
        $data['doc1'] 	= $this->db->select('document_detail.*')->where(['document_detail.company_id'=>$company_id, 'file_type_id'=>1, 'doc_active'=>1])->join('document', 'document.doc_id = document_detail.doc_id')
        					->get('document_detail')->row();
        $data['doc2'] 	= $this->db->select('document_detail.*')->where(['document_detail.company_id'=>$company_id, 'file_type_id'=>2, 'doc_active'=>1])->join('document', 'document.doc_id = document_detail.doc_id')
        					->get('document_detail')->row();
        $data['doc3'] 	= $this->db->select('document_detail.*')->where(['document_detail.company_id'=>$company_id, 'file_type_id'=>3, 'doc_active'=>1])->join('document', 'document.doc_id = document_detail.doc_id')
        					->get('document_detail')->row();
        $data['doc4'] 	= $this->db->select('document_detail.*')->where(['document_detail.company_id'=>$company_id, 'file_type_id'=>4, 'doc_active'=>1])->join('document', 'document.doc_id = document_detail.doc_id')
        					->get('document_detail')->row();
        $data['doc5'] 	= $this->db->select('document_detail.*')->where(['document_detail.company_id'=>$company_id, 'file_type_id'=>5, 'doc_active'=>1])->join('document', 'document.doc_id = document_detail.doc_id')
        					->get('document_detail')->row();
        $data['doc6'] 	= $this->db->select('document_detail.*')->where(['document_detail.company_id'=>$company_id, 'file_type_id'=>6, 'doc_active'=>1])->join('document', 'document.doc_id = document_detail.doc_id')
        					->get('document_detail')->row();
        $data['doc7'] 	= $this->db->select('document_detail.*')->where(['document_detail.company_id'=>$company_id, 'file_type_id'=>7, 'doc_active'=>1])->join('document', 'document.doc_id = document_detail.doc_id')
        					->get('document_detail')->row();
        $data['doc8'] 	= $this->db->select('document_detail.*')->where(['document_detail.company_id'=>$company_id, 'file_type_id'=>8, 'doc_active'=>1])->join('document', 'document.doc_id = document_detail.doc_id')
        					->get('document_detail')->row();

        $this->load->view('templates/header', $data);
        $this->load->view('send-report/index', $data);
        $this->load->view('templates/footer');
    }

	public function doc1()
	{
		$errors = [];
        $data = [];

		$company_id 	= $this->input->post('company_id');
		$file_type_id	= $this->input->post('file_type_id');

		if($_FILES['file_deskripsi_kegiatan']['error'] > 0) {
            $errors['error_upload'] = 'Mohon pilih dokumen terlebih dahulu !';
        }
	 
		if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
        	$doc_exist = $this->db->where(['company_id'=>$company_id, 'doc_status'=>1])->get('document')->row();

			if(!$doc_exist) {
				$doc_folder = $company_id.date('ymds');

				$this->db->set('company_id', $company_id);
				$this->db->set('doc_folder', $doc_folder);
				$this->db->set('doc_status', 1);
				// $this->db->set('doc_created_by', $this->session->userdata('user_id'));
				$this->db->insert('document');

				$doc_id = $this->db->insert_id();
			} else {
				$doc_id = $doc_exist->doc_id;
				$doc_folder = $doc_exist->doc_folder;
			}

			$location = FCPATH."/reports/".$doc_folder;

	        if(!file_exists($location)) {
	            mkdir($location, 0777);
	        }

        	$doc_file = $this->upload_file($location, "file_deskripsi_kegiatan");

        	$data_post = array(
				'company_id'		=> $company_id,
				'doc_id'			=> $doc_id,
				'file_type_id'		=> $file_type_id,
				'doc_folder'		=> $doc_folder,
				'doc_file'			=> $doc_file,
				'doc_status'		=> 1,
				'doc_modified_by'	=> 1,
				'doc_modified_at'	=> date('Y-m-d H:i:s')
			);

            $this->db->insert('document_detail', $data_post);

            $data['success'] = true;
            $data['message'] = 'Success!';
        }
        
        echo json_encode($data);
	}

	public function doc2()
	{
		$errors = [];
        $data = [];

		$company_id 	= $this->input->post('company_id');
		$file_type_id	= $this->input->post('file_type_id');

		if($_FILES['file_laporan_klpl']['error'] > 0) {
            $errors['error_upload'] = 'Mohon pilih dokumen terlebih dahulu !';
        }
	 
		if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
        	$doc_exist = $this->db->where(['company_id'=>$company_id, 'doc_status'=>1])->get('document')->row();

			if(!$doc_exist) {
				$doc_folder = $company_id.date('ymds');

				$this->db->set('company_id', $company_id);
				$this->db->set('doc_folder', $doc_folder);
				$this->db->set('doc_status', 1);
				// $this->db->set('doc_created_by', $this->session->userdata('user_id'));
				$this->db->insert('document');

				$doc_id = $this->db->insert_id();
			} else {
				$doc_id = $doc_exist->doc_id;
				$doc_folder = $doc_exist->doc_folder;
			}

			$location = FCPATH."/reports/".$doc_folder;

	        if(!file_exists($location)) {
	            mkdir($location, 0777);
	        }

        	$doc_file = $this->upload_file($location, "file_laporan_klpl");

        	$data_post = array(
				'company_id'		=> $company_id,
				'doc_id'			=> $doc_id,
				'file_type_id'		=> $file_type_id,
				'doc_folder'		=> $doc_folder,
				'doc_file'			=> $doc_file,
				'doc_status'		=> 1,
				'doc_modified_by'	=> 1,
				'doc_modified_at'	=> date('Y-m-d H:i:s')
			);

            $this->db->insert('document_detail', $data_post);

            $data['success'] = true;
            $data['message'] = 'Success!';
        }
        
        echo json_encode($data);
	}

	public function doc3()
	{
		$errors = [];
        $data = [];

		$company_id 	= $this->input->post('company_id');
		$file_type_id	= $this->input->post('file_type_id');

		if($_FILES['file_laporan_pencemaran_air']['error'] > 0) {
            $errors['error_upload'] = 'Mohon pilih dokumen terlebih dahulu !';
        }
	 
		if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
        	$doc_exist = $this->db->where(['company_id'=>$company_id, 'doc_status'=>1])->get('document')->row();

			if(!$doc_exist) {
				$doc_folder = $company_id.date('ymds');

				$this->db->set('company_id', $company_id);
				$this->db->set('doc_folder', $doc_folder);
				$this->db->set('doc_status', 1);
				// $this->db->set('doc_created_by', $this->session->userdata('user_id'));
				$this->db->insert('document');

				$doc_id = $this->db->insert_id();
			} else {
				$doc_id = $doc_exist->doc_id;
				$doc_folder = $doc_exist->doc_folder;
			}

			$location = FCPATH."/reports/".$doc_folder;

	        if(!file_exists($location)) {
	            mkdir($location, 0777);
	        }

        	$doc_file = $this->upload_file($location, "file_laporan_pencemaran_air");

        	$data_post = array(
				'company_id'		=> $company_id,
				'doc_id'			=> $doc_id,
				'file_type_id'		=> $file_type_id,
				'doc_folder'		=> $doc_folder,
				'doc_file'			=> $doc_file,
				'doc_status'		=> 1,
				'doc_modified_by'	=> 1,
				'doc_modified_at'	=> date('Y-m-d H:i:s')
			);

            $this->db->insert('document_detail', $data_post);

            $data['success'] = true;
            $data['message'] = 'Success!';
        }
        
        echo json_encode($data);
	}

	public function doc4()
	{
		$errors = [];
        $data = [];

		$company_id 	= $this->input->post('company_id');
		$file_type_id	= $this->input->post('file_type_id');

		if($_FILES['file_laporan_pencemaran_udara']['error'] > 0) {
            $errors['error_upload'] = 'Mohon pilih dokumen terlebih dahulu !';
        }
	 
		if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
        	$doc_exist = $this->db->where(['company_id'=>$company_id, 'doc_status'=>1])->get('document')->row();

			if(!$doc_exist) {
				$doc_folder = $company_id.date('ymds');

				$this->db->set('company_id', $company_id);
				$this->db->set('doc_folder', $doc_folder);
				$this->db->set('doc_status', 1);
				// $this->db->set('doc_created_by', $this->session->userdata('user_id'));
				$this->db->insert('document');

				$doc_id = $this->db->insert_id();
			} else {
				$doc_id = $doc_exist->doc_id;
				$doc_folder = $doc_exist->doc_folder;
			}

			$location = FCPATH."/reports/".$doc_folder;

	        if(!file_exists($location)) {
	            mkdir($location, 0777);
	        }

        	$doc_file = $this->upload_file($location, "file_laporan_pencemaran_udara");

        	$data_post = array(
				'company_id'		=> $company_id,
				'doc_id'			=> $doc_id,
				'file_type_id'		=> $file_type_id,
				'doc_folder'		=> $doc_folder,
				'doc_file'			=> $doc_file,
				'doc_status'		=> 1,
				'doc_modified_by'	=> 1,
				'doc_modified_at'	=> date('Y-m-d H:i:s')
			);

            $this->db->insert('document_detail', $data_post);

            $data['success'] = true;
            $data['message'] = 'Success!';
        }
        
        echo json_encode($data);
	}

	public function doc5()
	{
		$errors = [];
        $data = [];

		$company_id 	= $this->input->post('company_id');
		$file_type_id	= $this->input->post('file_type_id');

		if($_FILES['file_laporan_limbah']['error'] > 0) {
            $errors['error_upload'] = 'Mohon pilih dokumen terlebih dahulu !';
        }
	 
		if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
        	$doc_exist = $this->db->where(['company_id'=>$company_id, 'doc_status'=>1])->get('document')->row();

			if(!$doc_exist) {
				$doc_folder = $company_id.date('ymds');

				$this->db->set('company_id', $company_id);
				$this->db->set('doc_folder', $doc_folder);
				$this->db->set('doc_status', 1);
				// $this->db->set('doc_created_by', $this->session->userdata('user_id'));
				$this->db->insert('document');

				$doc_id = $this->db->insert_id();
			} else {
				$doc_id = $doc_exist->doc_id;
				$doc_folder = $doc_exist->doc_folder;
			}

			$location = FCPATH."/reports/".$doc_folder;

	        if(!file_exists($location)) {
	            mkdir($location, 0777);
	        }

        	$doc_file = $this->upload_file($location, "file_laporan_limbah");

        	$data_post = array(
				'company_id'		=> $company_id,
				'doc_id'			=> $doc_id,
				'file_type_id'		=> $file_type_id,
				'doc_folder'		=> $doc_folder,
				'doc_file'			=> $doc_file,
				'doc_status'		=> 1,
				'doc_modified_by'	=> 1,
				'doc_modified_at'	=> date('Y-m-d H:i:s')
			);

            $this->db->insert('document_detail', $data_post);

            $data['success'] = true;
            $data['message'] = 'Success!';
        }
        
        echo json_encode($data);
	}

	public function doc6()
	{
		$errors = [];
        $data = [];

		$company_id 	= $this->input->post('company_id');
		$file_type_id	= $this->input->post('file_type_id');

		if($_FILES['file_laporan_dampak']['error'] > 0) {
            $errors['error_upload'] = 'Mohon pilih dokumen terlebih dahulu !';
        }
	 
		if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
        	$doc_exist = $this->db->where(['company_id'=>$company_id, 'doc_status'=>1])->get('document')->row();

			if(!$doc_exist) {
				$doc_folder = $company_id.date('ymds');

				$this->db->set('company_id', $company_id);
				$this->db->set('doc_folder', $doc_folder);
				$this->db->set('doc_status', 1);
				// $this->db->set('doc_created_by', $this->session->userdata('user_id'));
				$this->db->insert('document');

				$doc_id = $this->db->insert_id();
			} else {
				$doc_id = $doc_exist->doc_id;
				$doc_folder = $doc_exist->doc_folder;
			}

			$location = FCPATH."/reports/".$doc_folder;

	        if(!file_exists($location)) {
	            mkdir($location, 0777);
	        }

        	$doc_file = $this->upload_file($location, "file_laporan_dampak");

        	$data_post = array(
				'company_id'		=> $company_id,
				'doc_id'			=> $doc_id,
				'file_type_id'		=> $file_type_id,
				'doc_folder'		=> $doc_folder,
				'doc_file'			=> $doc_file,
				'doc_status'		=> 1,
				'doc_modified_by'	=> 1,
				'doc_modified_at'	=> date('Y-m-d H:i:s')
			);

            $this->db->insert('document_detail', $data_post);

            $data['success'] = true;
            $data['message'] = 'Success!';
        }
        
        echo json_encode($data);
	}

	public function doc7()
	{
		$errors = [];
        $data = [];

		$company_id 	= $this->input->post('company_id');
		$file_type_id	= $this->input->post('file_type_id');

		if($_FILES['file_laporan_ijin']['error'] > 0) {
            $errors['error_upload'] = 'Mohon pilih dokumen terlebih dahulu !';
        }
	 
		if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
        	$doc_exist = $this->db->where(['company_id'=>$company_id, 'doc_status'=>1])->get('document')->row();

			if(!$doc_exist) {
				$doc_folder = $company_id.date('ymds');

				$this->db->set('company_id', $company_id);
				$this->db->set('doc_folder', $doc_folder);
				$this->db->set('doc_status', 1);
				// $this->db->set('doc_created_by', $this->session->userdata('user_id'));
				$this->db->insert('document');

				$doc_id = $this->db->insert_id();
			} else {
				$doc_id = $doc_exist->doc_id;
				$doc_folder = $doc_exist->doc_folder;
			}

			$location = FCPATH."/reports/".$doc_folder;

	        if(!file_exists($location)) {
	            mkdir($location, 0777);
	        }

        	$doc_file = $this->upload_file($location, "file_laporan_ijin");

        	$data_post = array(
				'company_id'		=> $company_id,
				'doc_id'			=> $doc_id,
				'file_type_id'		=> $file_type_id,
				'doc_folder'		=> $doc_folder,
				'doc_file'			=> $doc_file,
				'doc_status'		=> 1,
				'doc_modified_by'	=> 1,
				'doc_modified_at'	=> date('Y-m-d H:i:s')
			);

            $this->db->insert('document_detail', $data_post);

            $data['success'] = true;
            $data['message'] = 'Success!';
        }
        
        echo json_encode($data);
	}

	public function doc8()
	{
		$errors = [];
        $data = [];

		$company_id 	= $this->input->post('company_id');
		$file_type_id	= $this->input->post('file_type_id');

		if($_FILES['file_dokumentasi']['error'] > 0) {
            $errors['error_upload'] = 'Mohon pilih dokumen terlebih dahulu !';
        }
	 
		if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
        	$doc_exist = $this->db->where(['company_id'=>$company_id, 'doc_status'=>1])->get('document')->row();

			if(!$doc_exist) {
				$doc_folder = $company_id.date('ymds');

				$this->db->set('company_id', $company_id);
				$this->db->set('doc_folder', $doc_folder);
				$this->db->set('doc_status', 1);
				// $this->db->set('doc_created_by', $this->session->userdata('user_id'));
				$this->db->insert('document');

				$doc_id = $this->db->insert_id();
			} else {
				$doc_id = $doc_exist->doc_id;
				$doc_folder = $doc_exist->doc_folder;
			}

			$location = FCPATH."/reports/".$doc_folder;

	        if(!file_exists($location)) {
	            mkdir($location, 0777);
	        }

        	$doc_file = $this->upload_file($location, "file_dokumentasi");

        	$data_post = array(
				'company_id'		=> $company_id,
				'doc_id'			=> $doc_id,
				'file_type_id'		=> $file_type_id,
				'doc_folder'		=> $doc_folder,
				'doc_file'			=> $doc_file,
				'doc_status'		=> 1,
				'doc_modified_by'	=> 1,
				'doc_modified_at'	=> date('Y-m-d H:i:s')
			);

            $this->db->insert('document_detail', $data_post);

            $data['success'] = true;
            $data['message'] = 'Success!';
        }
        
        echo json_encode($data);
	}

    private function upload_file($location, $file)
    {
        $config['upload_path']          = $location;
        $config['allowed_types']        = 'pdf';
        $config['file_name']            = $file.'_'.date("ymds").rand();
        $config['overwrite']         	= true;
        // $config['max_size']          = 2048; // 2MB

        $this->load->library('upload', $config);

        $this->upload->do_upload($file);

        return $this->upload->data('file_name');
    }

    public function delete_doc()
    {
    	$id = $this->input->post('doc_detail_id');

    	$doc_exist = $this->db->where('doc_detail_id', $id)->get('document_detail')->row();
    	$location = FCPATH."/reports/".$doc_exist->doc_folder."/".$doc_exist->doc_file;

    	unlink($location);

        $this->db->delete("document_detail", ["doc_detail_id" => $id]);
        
        $data['success'] = true;
        $data['message'] = 'Success!';
        echo json_encode($data);
    }

    public function confirm()
    {
    	$id = $this->input->post('doc_id');

    	$this->db->set('doc_status', 2);
    	$this->db->where('doc_id', $id);
    	$this->db->update('document');

    	$this->db->set('doc_status', 2);
    	$this->db->where('doc_id', $id);
    	$this->db->update('document_detail');
        
        echo json_encode($data);
    }
}
