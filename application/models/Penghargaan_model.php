<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Penghargaan_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() 
	{
		$query = $this->db->get('m_penghargaan');

		return $query->result_array();
	}
	
	function get_byId($id) 
	{
		$this->db->where('id_penghargaan', $id);
		$query = $this->db->get('m_penghargaan');

		return $query->row_array();
	}

	
	public function insert_data($data)
	{
		//many data use array data
		//$this->db->insert('m_penghargaan', $data);
		
		//one data 
		$insert = $this->db->query("INSERT INTO m_penghargaan (`nama_penghargaan`) VALUES ('".$data."')");
		
		return (isset($insert)) ? true : FALSE;
	}

	public function update_data($data, $id)
	{	
		//many data use array data
		//$this->db->where('id', $id);
		//$this->db->update('m_penghargaan', $data);
		
		//one data
		$update = $this->db->query("update m_penghargaan SET nama_penghargaan = '".$data."' WHERE id_penghargaan = ".$id);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function delete_data($id)
	{
		$this->db->where('id_penghargaan', $id);
		$delete = $this->db->delete('m_penghargaan');
		
		return (isset($delete)) ? true : FALSE;
	}
}