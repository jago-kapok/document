<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Document extends CI_Controller
{	
    public function __construct()
    {
        parent::__construct();
		authentication();
    }

    public function getData()
    {
        $result = [];

        $id = $this->input->get('id');
        $doc = $this->db->where('doc_detail_id', $id)->join('file_type', 'file_type.file_type_id = document_detail.file_type_id')->get('document_detail')->row();

        $result[] = array(
        	'doc_detail_id'	=> $doc->doc_detail_id,
        	'doc_folder'	=> $doc->doc_folder,
        	'doc_file'		=> $doc->doc_file,
        	'file_type_desc'=> $doc->file_type_desc
        );

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }
}
