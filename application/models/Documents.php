<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Documents extends CI_Model
{
	/* ============================================================ */
	/*
	/* ============================================================ */

	public function getDocumentById($doc_id)
	{
		$this->db->from('document');
		$this->db->join('company', 'company.company_id = document.company_id', 'left');
		$this->db->where('doc_id', $doc_id);
		
		return $this->db->get();
	}

	/* ============================================================ */
	/*
	/* ============================================================ */

	public function getDocument($company_id, $doc_year, $doc_periode)
	{
		$this->db->select('document.*');
		$this->db->from('document');
		$this->db->where(['company_id' => $company_id, 'doc_year' => $doc_year, 'doc_periode' => $doc_periode]);
		
		return $this->db->get();
	}

	/* ============================================================ */
	/*
	/* ============================================================ */

	public function getDocumentDetail($doc_id, $doc_status)
	{
		$this->db->select('f.file_type_id, f.file_type_desc, dt.doc_id, dt.doc_detail_id, dt.doc_folder, dt.doc_file, dt.doc_status, dt.doc_modified_at, dt.doc_verified_at, dt.doc_rejected_at, dt.doc_rejected_note, s.status_desc, s.status_color, u.username as user_name');
		$this->db->from('file_type f');
		$this->db->join('document_detail dt', 'dt.file_type_id = f.file_type_id AND dt.doc_id = '.$doc_id.' AND dt.doc_status != '.$doc_status, 'left');
		$this->db->join('status s', 's.status_id = dt.doc_status', 'left');
		$this->db->join('users u', 'u.id = dt.doc_verified_by', 'left');
		$this->db->order_by('f.file_type_id');
		
		return $this->db->get();
	}

	/* ============================================================ */
	/*
	/* ============================================================ */

	public function getDocumentDetailById($doc_id, $_where)
	{
		$this->db->from('document_detail');
		$this->db->where('doc_id', $doc_id);
		$this->db->where($_where);
		
		return $this->db->get();
	}

	/* ============================================================ */
	/*
	/* ============================================================ */

	public function getDocumentAndCompany()
	{
		$this->db->select('document.*, company.company_name, company.company_address');
		$this->db->from('document');
		$this->db->join('company', 'company.company_id = document.company_id');
		$this->db->where('document.doc_status', 2);
		$this->db->order_by('document.doc_modified_at', 'desc');

		return $this->db->get();
	}

	/* ============================================================ */
	/*
	/* ============================================================ */

	public function getFromDetailId($doc_detail_id, $_where)
	{
		$this->db->from('document_detail');
		$this->db->where('doc_detail_id', $doc_detail_id);
		$this->db->where($_where);
		
		return $this->db->get();
	}
}