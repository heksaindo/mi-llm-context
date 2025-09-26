<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pribadi_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() {
		$query = $this->db->get('pegawai');

		return $query->result_array();
	}
	
}