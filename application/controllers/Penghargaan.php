<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Penghargaan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'administrasipegawai';
		$this->load->model('Pegawai_model', 'mPegawai');
		$this->load->helper('general_helper');
		//Notifikasi
		$this->load->model('notifikasi_model');
		$username = $this->session->userdata('username');
		$previlege = $this->session->userdata('login_state');
		$this->data['privilege'] =  $this->session->userdata('login_state');
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($username, $previlege);
	}
	
	public function index()
	{	

		$this->data['data_pegawai'] = $this->mPegawai->get_riwayatpenghargaan();
		
		$this->data['title'] = 'Penghargaan Pegawai';

		$this->load->view('penghargaan/penghargaan', $this->data);
		
	}
	
	function addpenghargaan()
	{
		$sql="select nip_baru from pegawai";
		$query=$this->db->query($sql);
		$this->data['nip']=$query->result();
		$query->free_result();
		
		$sql="select * from m_penghargaan";
		$query=$this->db->query($sql);
		$this->data['penghargaan']=$query->result();
		$query->free_result();
		
		$this->data['title'] = 'Penghargaan Pegawai';

		$this->load->view('penghargaan/add_penghargaan', $this->data);
	}
	
	function edit ($id)
	{
		$this->data['id']=$id;
		
		$this->data['pegawai'] = $this->mPegawai->edit_riwayatpenghargaan($id); 
		
		$sql="select * from m_penghargaan";
		$query=$this->db->query($sql);
		$this->data['penghargaan']=$query->result();
		$query->free_result();
		
		$this->load->view('penghargaan/add_penghargaan', $this->data);
	}
	
	function simpan()
	{
		extract($_POST); 
		//print_r($_POST);die();
		$status = 'error';
		$do = '';
		$user_input = $this->session->userdata('username');

		$data = array(
			'nip_baru' => $nip_baru,
			'nama' => $nama,
			'instansi_pelaksana' => $instansi_pelaksana,
			'id_penghargaan' => $id_penghargaan,
			'unit_kerja' => $unit_kerja,
			'tanda_jasa' => $tanda_jasa,
			'no_sk' => $no_sk,
			'tgl_sk' => date('Y-m-d',strtotime($tgl_sk)),
			
		);
		if(empty($id)){
			$data['is_last'] = 'Ya';
			$data['created_date'] = date('Y-m-d H:i:s');
			$data['created_by'] = $user_input;
			$data['updated_date'] = date('Y-m-d H:i:s');
			$data['updated_by'] = $user_input;
			$do_ = $this->mPegawai->insert_riwayatpenghargaan($data);
		}else{
			$data['updated_date'] = date('Y-m-d H:i:s');
			$data['updated_by'] = $user_input;
			$do_ = $this->mPegawai->update_riwayatpenghargaan($data, $id);
		}
		if($do_){
			
			redirect ('penghargaan', 'refresh');
		}
	}
	
	public function delete($id)
	{
		extract($_POST); 
		
		$do_ = $this->mPegawai->delete_riwayatpenghargaan($id);
		
		redirect ('penghargaan', 'refresh');
	}
	
	
	///=================================
	function simpanxxxxx()
	{
		$nip=preg_replace("/[^\d]/", "", $this->input->post('nip'));
		$UnitKerja=$this->input->post('UnitKerja');
		$tanggal = date_create($this->input->post('tanggal'));
		$tanggal=date_format($tanggal, 'Y-m-d');
		$data = array(
			'nip' 			=> $nip,
			'nama'			=> $this->input->post('nama'),
			'unit_kerja'  	=> $UnitKerja,
			'penghargaan'	=> $this->input->post('NamaPenghargaan'),
			'instansi_pelaksana'	=> $this->input->post('lembaga'),
			'tanda_jasa'  	=> $this->input->post('TandaJasa'),
			'no_sk'	=> $this->input->post('sk'),
			'tgl_sk' 	=> $tanggal,
			'created_date'		=> date("Y-m-d H:i:s"),
			'created_by'		=> $this->session->userdata('nip')
		);
		
		$this->db->insert('pegawai_riwayatpenghargaan', $data); 
		
		$data = array(
			'nip_baru' 			=> $this->input->post('nip'),
			'kategori' 			=> $this->input->post('kategori'),
			'nama_pelatihan'  	=> $this->input->post('NamaPelatihan'),
			'lembaga_pelaksana'	=> $this->input->post('lembaga'),
			'negara_pelaksana'	=> $this->input->post('lembaga'),
			'jenis_pelatihan'  	=> $this->input->post('JenisPelatihan'),
			'tahun_sertifikasi'	=> $this->input->post('tahun'),
			'jml_jam_kursus' 	=> $this->input->post('jam'),
		);
		//$this->db->replace('pegawai_diklat_teknis', $data); 
		//$sql="update pegawai_diklat_teknis set nama = (select nama from pegawai where nip_baru='".$this->input->post('nip')."') where nip_baru='".$this->input->post('nip')."'";
		//$this->db->query($sql);
		redirect ('penghargaan');
	}
	
	function deletexxxxx($id)
	{
		$sql="delete from pegawai_riwayatpenghargaan where id='$id'";
		$this->db->query($sql);
		redirect ('penghargaan', 'refresh');
	}
}