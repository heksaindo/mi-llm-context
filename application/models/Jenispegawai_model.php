<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class jenispegawai_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() 
	{
		$this->db->select('*');
		$query = $this->db->get('m_jenis_kepegawaian');

		return $query->result_array();
	}
	
	function get_byId($id) 
	{
		$this->db->where('id_jenis_kepegawaian', $id);
		$query = $this->db->get('m_jenis_kepegawaian');

		return $query->row_array();
	}

	
	public function insert_data($data)
	{
		$this->db->insert('m_jenis_kepegawaian', $data);
		
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;
	}

	public function update_data($data, $id)
	{
		$this->db->where('id_jenis_kepegawaian', $id);
		$update = $this->db->update('m_jenis_kepegawaian', $data);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function delete_data($id)
	{
		$this->db->where('id_jenis_kepegawaian', $id);
		$delete = $this->db->delete('m_jenis_kepegawaian');
		
		return (isset($delete)) ? true : FALSE;
	}
}