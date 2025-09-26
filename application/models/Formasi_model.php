<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class formasi_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() 
	{
		$this->db->select('*');
		$query = $this->db->get('m_formasi_jabatan');

		return $query->result_array();
	}
	
	function get_byId($id) 
	{
		$this->db->where('id_formasi', $id);
		$query = $this->db->get('m_formasi_jabatan');

		return $query->row_array();
	}

	
	public function insert_data($data)
	{
		$this->db->insert('m_formasi_jabatan', $data);
		
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;
	}

	public function update_data($data, $id)
	{
		$this->db->where('id_formasi', $id);
		$update = $this->db->update('m_formasi_jabatan', $data);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function delete_data($id)
	{
		$this->db->where('id_formasi', $id);
		$delete = $this->db->delete('m_formasi_jabatan');
		
		return (isset($delete)) ? true : FALSE;
	}
}