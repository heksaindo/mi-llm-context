<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notifikasi_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}
	
	function get_notifikasi($username = '', $previlege = '') {
	
		$ret_data = array(
			'total' => 0,
			'permintaan_cuti' => 0,
			'permintaan_lembur' => 0,
			'perubahan_data_pegawai' => 0
		);
		
		if(!empty($username) OR !empty($previlege)){
		
			$where = "msg_to = '".$username."' OR msg_to = '".$previlege."'";
			if($previlege == 'Admin' OR $previlege == 'Operator'){
				$where .= " OR msg_to = '' OR msg_to = 'admin'";
			}
			
			$this->db->from('messages');
			$this->db->where("(".$where.")");
			$this->db->where("is_read = 'N'");
			$query = $this->db->get();
			
			if($query->num_rows() > 0){
				foreach($query->result() as $dt_msg){
					//print_r($dt_msg);
					if($dt_msg->msg_tipe == 'Permintaan Cuti'){
						$ret_data['permintaan_cuti'] += 1;
						$ret_data['total'] += 1;
					}
					if($dt_msg->msg_tipe == 'Permintaan Lembur'){
						$ret_data['permintaan_lembur'] += 1;
						$ret_data['total'] += 1;
					}
					if($dt_msg->msg_tipe == 'Perubahan Data Pegawai'){
						$ret_data['perubahan_data_pegawai'] += 1;
						$ret_data['total'] += 1;
					}
					
				}
			}
			
			return $ret_data;
		}
		
		return $ret_data;
	}
	
	function data_message($username = '', $previlege = '', $tipe = 'Message') {
	
		$where = "msg_to = '".$username."' OR msg_to = '".$previlege."'";
		if($previlege == 'Admin' OR $previlege == 'Operator'){
			$where .= " OR msg_to = ''";
		}
		
		$this->db->select("a.*, b.gelar_depan, b.nama as msg_nama, b.gelar_belakang", false);
		$this->db->from('messages as a');
		$this->db->join('pegawai as b','b.nip_baru = a.msg_from','LEFT');
		$this->db->where($where);
		$this->db->where('msg_tipe',$tipe);
		$this->db->order_by('is_read');
		$this->db->order_by('msg_date');
		$query = $this->db->get();
		
		if($query->num_rows() > 0){			
			return $query->result_array();
		}
		
		return array();
	
	}
	
	function get_data_reply($id = '') {
	
		if(empty($id)){
			return array();
		}
		
		$username = $this->session->userdata('username');
		$previlege = $this->session->userdata('login_state');				
				
		$this->db->select("a.*, b.gelar_depan, b.nama as msg_nama, b.gelar_belakang", false);
		$this->db->from('messages as a');
		$this->db->join('pegawai as b','b.nip_baru = a.msg_from','LEFT');
		$this->db->where('a.id',$id);
		$query = $this->db->get();
		
		if($query->num_rows() > 0){			
		
			$dt_msg = $query->row_array();
			
			if($dt_msg['is_read'] == 'N'){
				//auto set as read
				$update_dt = array(
					'is_read' => 'Y',
					'read_date' => date("Y-m-d H:i:s")
				);
				$this->db->where('id',$id);
				$update = $this->db->update('messages', $update_dt);
				
				if($previlege == 'Admin' OR $previlege == 'Operator'){
					//auto send sedang di proses
					$message_send = 'Permintaan anda sudah kami terima, dan sedang dalam proses';
					$reply_dt = array(
						'msg_from' => $username,
						'msg_to' => $dt_msg['msg_from'],
						'msg_tipe' => $dt_msg['msg_tipe'],
						'msg_subject' => 'Reply: '.$dt_msg['msg_subject'],
						'reply_id' => $dt_msg['id'],
						'msg_text' => $message_send,
						'msg_date' => date("Y-m-d H:i:s"),
						'is_read' => 'N'
					);
					$reply = $this->db->insert('messages', $reply_dt);
				}
			}
			
			return $dt_msg;
		}
		
		return array();
	
	}
	
}