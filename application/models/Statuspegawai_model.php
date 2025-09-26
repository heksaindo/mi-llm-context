<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Statuspegawai_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() 
	{
		$query = $this->db->get('m_status_pegawai');

		return $query->result_array();
	}
	
	function get_byId($id) 
	{
		$this->db->where('id', $id);
		$query = $this->db->get('m_status_pegawai');

		return $query->row_array();
	}

	
	public function insert_data($data)
	{
		//many data use array data
		//$this->db->insert('m_status_pegawai', $data);
		
		//one data 
		$insert = $this->db->query("INSERT INTO m_status_pegawai (`nama_status`) VALUES ('".$data."')");
		
		return (isset($insert)) ? true : FALSE;
	}

	public function update_data($data, $id)
	{	
		//many data use array data
		//$this->db->where('id', $id);
		//$this->db->update('m_status_pegawai', $data);
		
		//one data
		$update = $this->db->query("update m_status_pegawai SET nama_status = '".$data."' WHERE id = ".$id);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function delete_data($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('m_status_pegawai');
		
		return (isset($delete)) ? true : FALSE;
	}
}