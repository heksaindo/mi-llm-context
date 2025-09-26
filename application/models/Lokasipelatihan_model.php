<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lokasipelatihan_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() 
	{
		$query = $this->db->get('m_lokasi_pelatihan');

		return $query->result_array();
	}
	
	function get_byId($id) 
	{
		$this->db->where('id_lokasi_pelatihan', $id);
		$query = $this->db->get('m_lokasi_pelatihan');

		return $query->row_array();
	}

	
	public function insert_data($data)
	{
		//many data use array data
		//$this->db->insert('m_lokasi_pelatihan', $data);
		
		//one data 
		$insert = $this->db->query("INSERT INTO m_lokasi_pelatihan (`nama_lokasi`) VALUES ('".$data."')");
		
		return (isset($insert)) ? true : FALSE;
	}

	public function update_data($data, $id)
	{	
		//many data use array data
		//$this->db->where('id_lokasi_pelatihan', $id);
		//$this->db->update('m_lokasi_pelatihan', $data);
		
		//one data
		$update = $this->db->query("update m_lokasi_pelatihan SET nama_lokasi = '".$data."' WHERE id_lokasi_pelatihan = ".$id);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function delete_data($id)
	{
		$this->db->where('id_lokasi_pelatihan', $id);
		$delete = $this->db->delete('m_lokasi_pelatihan');
		
		return (isset($delete)) ? true : FALSE;
	}
}