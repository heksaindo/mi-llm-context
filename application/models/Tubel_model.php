<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tubel_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() {
		$query = $this->db->get('tubel');
		return $query->result_array();
	}
	
	function get_tubel($id) {
		//$this->db->select('id, name, description, price, picture');
		$level=$this->session->userdata('login_state');
		if ($level =='user')
		{
			$this->db->where('nip', $this->session->userdata('nip'));
		}
		else
		{
			$this->db->where('status', 'submit');
		}
		$query = $this->db->get('tubel');

		return $query->result_array();
	}
	
	function get_cuti_byid($id){
		$this->db->where('id', $id);
		$query = $this->db->get('vw_cuti');

		return $query->result_array();
	}
	
	function get_cuti_approve($cuti_id) {
		//$this->db->select('id, name, description, price, picture');
		$this->db->where('status', $cuti_id);
		$query = $this->db->get('cuti');

		return $query->result_array();
	}

	
	public function insert_cuti($data)
	{
		$this->db->insert('cuti', $data);
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;
	}

	public function update_cuti($cuti_id, $data)
	{
		$this->db->where('id', $cuti_id);
		$this->db->update('cuti', $data);
	}
}