<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_all() {
		$query = $this->db->get('user');

		return $query->result_array();
	}
	
	function get_byId($id) 
	{
		$this->db->where('id_user', $id);
		$query = $this->db->get('user');

		return $query->row_array();
	}

	
	public function insert_data($data)
	{
		$this->db->insert('user', $data);
		
		$id = $this->db->insert_id_user();
		
		return (isset($id)) ? $id : FALSE;
	}

	public function update_data($data, $id)
	{
		$this->db->where('id_user', $id);
		$update = $this->db->update('user', $data);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function delete_data($id)
	{
		$this->db->where('id_user', $id);
		$delete = $this->db->delete('user');
		
		return (isset($delete)) ? true : FALSE;
	}
	
	function get_login($user_name,$pwd) {
		$this->db->where('email_user', $user_name);
		$this->db->where('passwordmd5_user', $pwd);
		$query = $this->db->get('user');

		return $query->result_array();
	}

	function get_foto_bynip($id) {
		if($id && $id !=909090909){
			$this->db->where('id', $id);
			$query = $this->db->get('pegawai');

			return $query->row();
		}else{
			if($id==909090909){
				$arr=array(
						'nama'=>'System Administrator',
						'foto'=>''
				);
				return (object) $arr;
			}else{
				return false;
			}
		}
	}
	
	public function update_setting($data, $id)
	{
		$this->db->where('id_user', $id);
		$update = $this->db->update('user', $data);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function update_foto_bynip($id,$data)
	{
		$this->db->trans_start();

		$this->db->where('id_user', $id);
		$updt = $this->db->update('pegawai', array('foto'=> $data['file_name']));
		
		//commit
		$this->db->trans_complete();
		
		return (isset($updt)) ? TRUE : FALSE;
	}
	
}