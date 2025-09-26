<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Perjadin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'penugasandankehadiran';
		$this->load->model('Perjadin_model');
		
		//Notifikasi
		$this->load->model('notifikasi_model');
		$username = $this->session->userdata('username');
		$previlege = $this->session->userdata('login_state');
		$this->data['privilege'] =  $this->session->userdata('login_state');
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($username, $previlege);
	}
	
	public function index()
	{	
		$this->data['title'] = 'Perjadin';
		
		//$this->data['data_perjadin'] = $this->Perjadin_model->get_all();
		$this->data['data_perjadin'] = $this->Perjadin_model->get_perjadin($this->session->userdata('nip'));

		$this->load->view('perjadin/perjadin', $this->data);
	}
	
	public function add()
	{
		$sql="select nip_baru from pegawai WHERE status='aktif'";
		$query=$this->db->query($sql);
		$this->data['nip']=$query->result();
		$query->free_result();

		$this->data['title'] = 'Add Perjadin';
		$this->load->view('perjadin/add_perjadin', $this->data);
	}
	
	function edit($id)
	{
		$sql="select nip_baru from pegawai WHERE status='aktif'";
		$query=$this->db->query($sql);
		$this->data['nip']=$query->result();
		$query->free_result();
		$this->data['title'] = 'Add Cuti';

		$this->data['id']=$id;
		//$data['status']='edit';
		$this->load->view('perjadin/add_perjadin', $this->data);
	}
	
	public function addperjadin()
	{
		$id=$this->input->post('id');
		$tanggal_mulai=$this->input->post('tanggal_mulai');
		$tanggal_mulai = date_create($tanggal_mulai);
		$tanggal_mulai=date_format($tanggal_mulai, 'Y-m-d');
		$tanggal_akhir=$this->input->post('tanggal_akhir');
		$tanggal_akhir = date_create($tanggal_akhir);
		$tanggal_akhir=date_format($tanggal_akhir, 'Y-m-d');
		$level=$this->session->userdata('login_state');
		$nip=preg_replace("/[^\d]/", "", $this->input->post('nip'));
		$UnitKerja=$this->input->post('UnitKerja');
		
		if ($level =='User')
		{
			$data = array(
				'nip' 				=> $nip,
				'nama'  			=> $this->input->post('nama'),
				'unit_kerja'		=> $UnitKerja,
				'tipe_perjadin'  	=> $this->input->post('tipe_perjadin'),
				'tanggal_mulai'		=> $tanggal_mulai,
				'tanggal_akhir'		=> $tanggal_akhir,
				'tujuan_perjadin'	=> $this->input->post('tujuan'),
				'tempat_tujuan'		=> $this->input->post('alamat_tujuan'),
				'status'			=> 'submit',
				'created'			=> $this->session->userdata('nip')
			);
			
		
		}
		else
		{
			$data = array(
				'nip' 				=> $nip,
				'nama'  			=> $this->input->post('nama'),
				'unit_kerja'		=> $UnitKerja,
				'tipe_perjadin'  	=> $this->input->post('tipe_perjadin'),
				'tanggal_mulai'		=> $tanggal_mulai,
				'tanggal_akhir'		=> $tanggal_akhir,
				'tujuan_perjadin'	=> $this->input->post('tujuan'),
				'tempat_tujuan'		=> $this->input->post('alamat_tujuan'),
				'status'			=> 'submit',
				'created'			=> $this->session->userdata('nip')
			);
		}
		if (!empty($id))
		{
			$this->db->where('id', $id);
			$this->db->update('perjadin', $data); 
			//$this->Cuti_model->insert_cuti($data);
		}
		else
		{
			$this->db->insert('perjadin', $data); 
		}
		redirect('perjadin');
	}
	
	public function approve()
	{
		$this->data['title'] = 'Approve Perjadin';
		
		$this->data['data_perjadin'] = $this->Perjadin_model->get_all();
		
		$this->load->view('perjadin/approve_perjadin', $this->data);
	}
	
	public function approveperjadin($perjadin_id)
	{
		$data = array(
				'status'			=> 'approved'
			);
			
		$this->Perjadin_model->update_perjadin($perjadin_id,$data);
		
		redirect('perjadin/approve');
	}
	
	public function rejectperjadin($perjadin_id)
	{
		$data = array(
				'status'			=> 'rejected'
			);
			
		$this->Perjadin_model->update_perjadin($perjadin_id,$data);
		
		redirect('perjadin/approve');
	}
	
	public function cetak($id)
	{
		$sql="select * 
		from perjadin a where a.id=$id";
		$query = $this->db->query($sql);
		$this->data['data_perjadin'] = $query->result_array();
		$query->free_result();
		$this->data['title'] = 'Print Perjadin';
		$this->load->view('perjadin/cetak', $this->data);
	}
}