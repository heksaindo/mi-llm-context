<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tubel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'pendidikan';
		$this->load->model('Tubel_model');
		
		//Notifikasi
		$this->load->model('notifikasi_model');
		$username = $this->session->userdata('username');
		$previlege = $this->session->userdata('login_state');
		$this->data['privilege'] =  $this->session->userdata('login_state');
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($username, $previlege);
	}
	
	public function index()
	{	
		$this->data['title'] = 'Tugas Belajar';
		
		//$this->data['data_cuti'] = $this->Cuti_model->get_all();
		$this->data['data_tubel'] = $this->Tubel_model->get_tubel($this->session->userdata('nip'));

		$this->load->view('tubel/tubel', $this->data);
	}
	
	public function add()
	{
		$sql="select nip_baru from pegawai WHERE status='aktif'";
		$query=$this->db->query($sql);
		$this->data['nip']=$query->result();
		$query->free_result();
		$this->data['title'] = 'Add Tugas Belajar';

		$this->load->view('tubel/add_tubel', $this->data);
	}
	
	function edit($id)
	{
		$sql="select nip_baru from pegawai WHERE status='aktif'";
		$query=$this->db->query($sql);
		$this->data['nip']=$query->result();
		$query->free_result();
		$this->data['title'] = 'Add Cuti';

		$this->data['id']=$id;
		$this->data['status']='edit';
		$this->load->view('tubel/add_tubel', $this->data);
	}
	
	public function simpan()
	{
		$nip=preg_replace("/[^\d]/", "", $this->input->post('nip'));
		$id=$this->input->post('id');
		$tanggal_mulai=$this->input->post('tanggal_mulai');
		$tanggal_mulai = date_create($tanggal_mulai);
		$tanggal_mulai=date_format($tanggal_mulai, 'Y-m-d');
		$tanggal_akhir=$this->input->post('tanggal_akhir');
		$tanggal_akhir = date_create($tanggal_akhir);
		$tanggal_akhir=date_format($tanggal_akhir, 'Y-m-d');
		if ($this->input->post('tanggal_mulai') != '') {
			$level=$this->session->userdata('login_state');
		if ($level =='user')
		{
			
		
			$data = array(
					'nip' 				=> $nip,
					'nama'  			=> $this->input->post('nama'),
					'keterangan'  		=> $this->input->post('keterangan'),
					'tanggal_mulai'		=> $tanggal_mulai,
					'tanggal_akhir'		=> $tanggal_akhir,
					'jenis_tubel' 		=> $this->input->post('jenis_tubel'),
					'alamat'			=> $this->input->post('alamat_cuti'),
					'status'			=> 'submit'
				);
		}
		else		
		{
			$data = array(
					'nip' 				=> $nip,
					'nama'  			=> $this->input->post('nama'),
					'keterangan'  		=> $this->input->post('keterangan'),
					'tanggal_mulai'		=> $tanggal_mulai,
					'tanggal_akhir'		=> $tanggal_akhir,
					'jenis_tubel' 		=> $this->input->post('jenis_tubel'),
					'alamat'			=> $this->input->post('alamat_cuti'),
					'status'			=> 'submit'
				);
		
		
		}
		if (!empty($id))
		{
			$this->db->where('id', $id);
			$this->db->update('tubel', $data); 
			//$this->Cuti_model->insert_cuti($data);
		}
		else
		{
			$this->db->insert('tubel', $data); 
		}
		}
		redirect('tubel');
	}
	
	public function approve()
	{
		$this->data['title'] = 'Approve Cuti';
		
		$this->data['data_tubel'] = $this->Tubel_model->get_all();
		
		$this->load->view('tubel/approve_tubel', $this->data);
	}
	
	public function approvetubel($id)
	{
		$data = array(
				'status'		=> 'approved'
			);
		$this->db->where('id', $id);
		$this->db->update('tubel', $data); 	
		
		redirect('tubel/approve');
	}
	
	public function rejecttubel($id)
	{
		$data = array(
				'status'		=> 'rejected'
			);
			
		$this->db->where('id', $id);
		$this->db->update('tubel', $data); 
		
		redirect('tubel/approve');
	}
	
	public function cetak($id)
	{
		$this->data['title'] = 'Print Cuti';
		$query = $this->db->query("select * from tubel where id=$id");
		$this->data['data']=$query->result_array();
		$this->load->view('tubel/cetak', $this->data);
	}
}