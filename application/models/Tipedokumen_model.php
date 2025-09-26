<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class tipedokumen_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() 
	{
		$this->db->select('*');
		$query = $this->db->get('tipe_dokumen');

		return $query->result_array();
	}
	
	function get_byId($id) 
	{
		$this->db->where('id', $id);
		$query = $this->db->get('tipe_dokumen');

		return $query->row_array();
	}

	
	public function insert_data($data)
	{
		$this->db->insert('tipe_dokumen', $data);
		
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;
	}

	public function update_data($data, $id)
	{
		$this->db->where('id', $id);
		$update = $this->db->update('tipe_dokumen', $data);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function delete_data($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('tipe_dokumen');
		
		return (isset($delete)) ? true : FALSE;
	}
}