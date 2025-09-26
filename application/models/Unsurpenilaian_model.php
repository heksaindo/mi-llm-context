<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Unsurpenilaian_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() 
	{
		$query = $this->db->get('m_unsur_penilaian');

		return $query->result_array();
	}
	
	function get_byId($id) 
	{
		$this->db->where('id_unsur', $id);
		$query = $this->db->get('m_unsur_penilaian');

		return $query->row_array();
	}

	
	public function insert_data($data)
	{
		//many data use array data
		//$this->db->insert('m_unsur_penilaian', $data);
		
		//one data 
		$insert = $this->db->query("INSERT INTO m_unsur_penilaian (`nama_unsur`) VALUES ('".$data."')");
		
		return (isset($insert)) ? true : FALSE;
	}

	public function update_data($data, $id)
	{	
		//many data use array data
		//$this->db->where('id_unsur', $id);
		//$this->db->update('m_unsur_penilaian', $data);
		
		//one data
		$update = $this->db->query("update m_unsur_penilaian SET nama_unsur = '".$data."' WHERE id_unsur = ".$id);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function delete_data($id)
	{
		$this->db->where('id_unsur', $id);
		$delete = $this->db->delete('m_unsur_penilaian');
		
		return (isset($delete)) ? true : FALSE;
	}
}