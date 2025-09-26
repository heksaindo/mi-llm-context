<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Unsurklasifikasi_model extends CI_Model {

	public function __construct()
	{
	}

	function get_all() 
	{
		$this->db->select('*');
		$query = $this->db->get('m_unsur_klasifikasi');

		return $query->result_array();
	}
	
	function get_byId($id) 
	{
		$this->db->where('id_klasifikasi', $id);
		$query = $this->db->get('m_unsur_klasifikasi');

		return $query->row_array();
	}

	
	public function insert_data($data)
	{
		$this->db->insert('m_unsur_klasifikasi', $data);
		
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;
	}

	public function update_data($data, $id)
	{
		$this->db->where('id_klasifikasi', $id);
		$update = $this->db->update('m_unsur_klasifikasi', $data);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function delete_data($id)
	{
		$this->db->where('id_klasifikasi', $id);
		$delete = $this->db->delete('m_unsur_klasifikasi');
		
		return (isset($delete)) ? true : FALSE;
	}
}