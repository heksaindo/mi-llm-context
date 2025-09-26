<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class gapok_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() 
	{
		$this->db->select('a.*, b.nama_golongan');
		$this->db->from('m_gapok a');
		$this->db->join('m_golongan b', 'a.kdkelgapok=b.kdkelgapok', 'LEFT');
		$query = $this->db->get();

		return $query->result_array();
	}
	
	function get_byId($id) 
	{
		$this->db->where('id_gapok', $id);
		$query = $this->db->get('m_gapok');

		return $query->row_array();
	}
	
	function cek_gapok($id_gapok) 
	{
		$return_ =  0;
		
		$this->db->where('id_gapok', $id_gapok);
		$this->db->from('m_gapok');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$return_ = 1;
		}
		
		return $return_;
	}
	
	public function ddl_golongan($kode = '')
	{
		if(!empty($kode)){
			$this->db->where('kode_golongan', $kode);
		}
		
		$this->db->order_by('id_golongan','ASC');
		$query = $this->db->get('m_golongan');
		
		if ($query->num_rows() > 0) {
			if(!empty($kode)){
				return $query->row();
			}else{
				return $query->result();
			}
		}else{
			return '';
		}
	}
	
	public function insert_data($data)
	{
		$this->db->insert('m_gapok', $data);
		
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;
	}

	public function update_data($data, $id)
	{
		$this->db->where('id_gapok', $id);
		$update = $this->db->update('m_gapok', $data);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function delete_data($id)
	{
		$this->db->where('id_gapok', $id);
		$delete = $this->db->delete('m_gapok');
		
		return (isset($delete)) ? true : FALSE;
	}
}