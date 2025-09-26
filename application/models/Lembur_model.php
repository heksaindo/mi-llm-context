<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lembur_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() {
		$query = $this->db->get('lembur');

		return $query->result_array();
	}
	
	function get_lembur($lembur_id) {
		//$this->db->select('id, name, description, price, picture');
		$this->db->where('nama', $lembur_id);
		$query = $this->db->get('lembur');

		return $query->result_array();
	}
	
	function get_lembur_approve($lembur_id) {
		//$this->db->select('id, name, description, price, picture');
		$this->db->where('status', $lembur_id);
		$query = $this->db->get('lembur');

		return $query->result_array();
	}

	
	public function insert_lembur($data)
	{
		$this->db->insert('lembur', $data);
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;
	}

	public function update_lembur($lembur_id, $data)
	{
		$this->db->where('id', $lembur_id);
		$this->db->update('lembur', $data);
	}
}