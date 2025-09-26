<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Satuankerja_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() 
	{
		$this->db->select('*');
		$query = $this->db->get('m_satuan_kerja');

		return $query->result_array();
	}
	
	function get_byId($id) 
	{
		$this->db->where('id_satuan_kerja', $id);
		$query = $this->db->get('m_satuan_kerja');

		return $query->row_array();
	}

	
	public function insert_data($data)
	{
		$this->db->insert('m_satuan_kerja', $data);
		
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;
	}

	public function update_data($data, $id)
	{
		$this->db->where('id_satuan_kerja', $id);
		$update = $this->db->update('m_satuan_kerja', $data);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function delete_data($id)
	{
		$this->db->where('id_satuan_kerja', $id);
		$delete = $this->db->delete('m_satuan_kerja');
		
		return (isset($delete)) ? true : FALSE;
	}
}