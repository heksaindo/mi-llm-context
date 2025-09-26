<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Prasarat_angkakredit_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() 
	{
		$this->db->select('*');
		$query = $this->db->get('m_prasarat_angkakredit');

		return $query->result_array();
	}
	
	function get_byId($id) 
	{
		$this->db->where('id_ak', $id);
		$query = $this->db->get('m_prasarat_angkakredit');

		return $query->row_array();
	}

	
	public function insert_data($data)
	{
		$this->db->insert('m_prasarat_angkakredit', $data);
		
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;
	}

	public function update_data($data, $id)
	{
		$this->db->where('id_ak', $id);
		$update = $this->db->update('m_prasarat_angkakredit', $data);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function delete_data($id)
	{
		$this->db->where('id_ak', $id);
		$delete = $this->db->delete('m_prasarat_angkakredit');
		
		return (isset($delete)) ? true : FALSE;
	}
}