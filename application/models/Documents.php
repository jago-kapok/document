<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Documents extends CI_Model
{
	public function getDocumentById($doc_id) {
		$this->db->select('document.*');
		$this->db->from('document');
		$this->db->where(['doc_id' => $doc_id]);
		
		return $this->db->get();
	}

	public function getDocument($company_id, $doc_year, $doc_periode) {
		$this->db->select('document.*');
		$this->db->from('document');
		$this->db->where(['company_id' => $company_id, 'doc_year' => $doc_year, 'doc_periode' => $doc_periode]);
		
		return $this->db->get();
	}

	public function getDocumentDetail($doc_id, $doc_status) {
		$this->db->select('f.file_type_id, f.file_type_desc, dt.doc_id, dt.doc_detail_id, dt.doc_folder, dt.doc_file, dt.doc_status, dt.doc_rejected_note');
		$this->db->from('file_type f');
		$this->db->join('document_detail dt', 'dt.file_type_id = f.file_type_id AND dt.doc_id = '.$doc_id.' AND dt.doc_status = '.$doc_status, 'left');
		$this->db->order_by('f.file_type_id');
		
		return $this->db->get();
	}

	public function getDocumentAndCompany() {
		$this->db->select('document.*, company.company_name, company.company_address');
		$this->db->from('document');
		$this->db->join('company', 'company.company_id = document.company_id');
		$this->db->where('document.doc_status', 2);
		$this->db->order_by('document.doc_modified_at', 'desc');

		return $this->db->get();
	}

   	public function getAll($table)
	{
		return $this->db->get($table);
	}
	
	public function getBy($table, $where)
	{
		return $this->db->get_where($table, $where);
	}
 
	public function add($table, $data)
	{
		$this->db->insert($table, $data);
	}
 
	public function edit($table, $where, $data){
		$this->db->where($where);
		$this->db->update($table, $data);
	}
	
	public function delete($table, $where)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}
	
	public function getByCondition($where)
	{
		$this->db->select('target.*, pelanggan.noreg_pelanggan, pelanggan.nama_pelanggan, user.nama_user, pelanggan.alamat_pelanggan, pelanggan.tarif, pelanggan.daya, status.ket_status');
        $this->db->from('target');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = target.id_pelanggan');
		$this->db->join('status', 'status.id_status = target.id_status', 'left');
		$this->db->join('user', 'user.id_user = target.id_user', 'left');
		$this->db->where($where);
        
		return $this->db->get();
	}
	
	public function getHarmet($where)
	{
		$this->db->select('harmet.*, pelanggan.noreg_pelanggan, pelanggan.nama_pelanggan, user.nama_user, pelanggan.alamat_pelanggan, pelanggan.tarif, pelanggan.daya');
        $this->db->from('harmet');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = harmet.id_pelanggan');
		$this->db->join('user', 'user.id_user = harmet.id_user', 'left');
		$this->db->where($where);
		$this->db->order_by('harmet.tanggal_penggantian_harmet', 'DESC');
		$this->db->limit(1);
        
		return $this->db->get();
	}
	
	public function getHarmetDetail($where)
	{
		$this->db->select('harmet.*, pelanggan.noreg_pelanggan, pelanggan.nama_pelanggan, user.nama_user, pelanggan.alamat_pelanggan, pelanggan.tarif, pelanggan.daya');
        $this->db->from('harmet');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = harmet.id_pelanggan');
		$this->db->join('user', 'user.id_user = harmet.id_user', 'left');
		$this->db->where($where);
		$this->db->order_by('harmet.tanggal_penggantian_harmet', 'DESC');
        
		return $this->db->get();
	}
}