<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Perjadin_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() {
		$this->db->order_by("id", "desc"); 
		$query = $this->db->get('perjadin');
		return $query->result_array();
	}
	
	function get_perjadin($perjadin_id) {
		//$this->db->select('id, name, description, price, picture');
		$level=$this->session->userdata('login_state');
		if ($level =='User')
		{
			$this->db->where('nip', $perjadin_id);
		}
		$this->db->order_by("id", "desc"); 
		//$this->db->where('status', 'submit');
		$query = $this->db->get('perjadin');

		return $query->result_array();
	}
	
	function get_perjadin_approve($perjadin_id) {
		//$this->db->select('id, name, description, price, picture');
		$this->db->where('status', $perjadin_id);
		$query = $this->db->get('perjadin');

		return $query->result_array();
	}

	
	public function insert_perjadin($data)
	{
		$this->db->insert('perjadin', $data);
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;
	}

	public function update_perjadin($perjadin_id, $data)
	{
		$this->db->where('id', $perjadin_id);
		$this->db->update('perjadin', $data);
	}
}