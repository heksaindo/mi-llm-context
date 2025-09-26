<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class golongan_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() 
	{
		$this->db->select('*');
		$query = $this->db->get('m_golongan');

		return $query->result_array();
	}
	
	function get_byId($id) 
	{
		$this->db->where('id_golongan', $id);
		$query = $this->db->get('m_golongan');

		return $query->row_array();
	}

	
	public function insert_data($data)
	{
		$this->db->insert('m_golongan', $data);
		
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;
	}

	public function update_data($data, $id)
	{
		$this->db->where('id_golongan', $id);
		$update = $this->db->update('m_golongan', $data);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function delete_data($id)
	{
		$this->db->where('id_golongan', $id);
		$delete = $this->db->delete('m_golongan');
		
		return (isset($delete)) ? true : FALSE;
	}
	
	
}