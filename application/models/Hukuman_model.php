<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Hukuman_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() 
	{
		$query = $this->db->get('m_hukuman');

		return $query->result_array();
	}
	
	function get_byId($id) 
	{
		$this->db->where('id_hukuman', $id);
		$query = $this->db->get('m_hukuman');

		return $query->row_array();
	}

	
	public function insert_data($data)
	{
		//many data use array data
		//$this->db->insert('m_hukuman', $data);
		
		//one data 
		$insert = $this->db->query("INSERT INTO m_hukuman (`nama_hukuman`) VALUES ('".$data."')");
		
		return (isset($insert)) ? true : FALSE;
	}

	public function update_data($data, $id)
	{	
		//many data use array data
		//$this->db->where('id_hukuman', $id);
		//$this->db->update('m_hukuman', $data);
		
		//one data
		$update = $this->db->query("update m_hukuman SET nama_hukuman = '".$data."' WHERE id_hukuman = ".$id);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function delete_data($id)
	{
		$this->db->where('id_hukuman', $id);
		$delete = $this->db->delete('m_hukuman');
		
		return (isset($delete)) ? true : FALSE;
	}
}