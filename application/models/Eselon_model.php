<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Eselon_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() 
	{
		$this->db->select('*');
		$query = $this->db->get('m_eselon');

		return $query->result_array();
	}
	
	function get_byId($id) 
	{
		$this->db->where('id_eselon', $id);
		$query = $this->db->get('m_eselon');

		return $query->row_array();
	}

	
	public function insert_data($data)
	{
		$this->db->insert('m_eselon', $data);
		
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;
	}

	public function update_data($data, $id)
	{
		$this->db->where('id_eselon', $id);
		$update = $this->db->update('m_eselon', $data);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function delete_data($id)
	{
		$this->db->where('id_eselon', $id);
		$delete = $this->db->delete('m_eselon');
		
		return (isset($delete)) ? true : FALSE;
	}
}