<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class unsur_kegiatan_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() 
	{
		$query = $this->db->get('m_unsur_kegiatan');

		return $query->result_array();
	}
	
	function get_byId($id) 
	{
		$this->db->where('id_uk', $id);
		$query = $this->db->get('m_unsur_kegiatan');

		return $query->row_array();
	}

	
	public function insert_data($data)
	{
		$this->db->insert('m_unsur_kegiatan', $data);
		
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;
	}

	public function update_data($data, $id)
	{
		$this->db->where('id_uk', $id);
		$update = $this->db->update('m_unsur_kegiatan', $data);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function delete_data($id)
	{
		$this->db->where('id_uk', $id);
		$delete = $this->db->delete('m_unsur_kegiatan');
		
		return (isset($delete)) ? true : FALSE;
	}
}