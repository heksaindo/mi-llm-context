<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lokasikerja_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() 
	{
		$query = $this->db->get('m_lokasi_kerja');

		return $query->result_array();
	}
	
	function get_byId($id) 
	{
		$this->db->where('id_lokasi_kerja', $id);
		$query = $this->db->get('m_lokasi_kerja');

		return $query->row_array();
	}

	
	public function insert_data($data)
	{
		//many data use array data
		//$this->db->insert('m_lokasi_kerja', $data);
		
		//one data 
		$insert = $this->db->query("INSERT INTO m_lokasi_kerja (`lokasi_kerja`) VALUES ('".$data."')");
		
		return (isset($insert)) ? true : FALSE;
	}

	public function update_data($data, $id)
	{	
		//many data use array data
		//$this->db->where('id_lokasi_kerja', $id);
		//$this->db->update('m_lokasi_kerja', $data);
		
		//one data
		$update = $this->db->query("update m_lokasi_kerja SET lokasi_kerja = '".$data."' WHERE id_lokasi_kerja = ".$id);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function delete_data($id)
	{
		$this->db->where('id_lokasi_kerja', $id);
		$delete = $this->db->delete('m_lokasi_kerja');
		
		return (isset($delete)) ? true : FALSE;
	}
}