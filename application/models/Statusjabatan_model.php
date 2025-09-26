<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Statusjabatan_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() 
	{
		$query = $this->db->get('m_status_jabatan');

		return $query->result_array();
	}
	
	function get_byId($id) 
	{
		$this->db->where('id_status_jabatan', $id);
		$query = $this->db->get('m_status_jabatan');

		return $query->row_array();
	}

	
	public function insert_data($data)
	{
		//many data use array data
		//$this->db->insert('m_status_jabatan', $data);
		
		//one data 
		$insert = $this->db->query("INSERT INTO m_status_jabatan (`nama_status_jabatan`) VALUES ('".$data."')");
		
		return (isset($insert)) ? true : FALSE;
	}

	public function update_data($data, $id)
	{	
		//many data use array data
		//$this->db->where('id_status_jabatan', $id);
		//$this->db->update('m_status_jabatan', $data);
		
		//one data
		$update = $this->db->query("update m_status_jabatan SET nama_status_jabatan = '".$data."' WHERE id_status_jabatan = ".$id);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function delete_data($id)
	{
		$this->db->where('id_status_jabatan', $id);
		$delete = $this->db->delete('m_status_jabatan');
		
		return (isset($delete)) ? true : FALSE;
	}
}