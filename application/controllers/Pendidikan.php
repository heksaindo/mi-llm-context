<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pendidikan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'pendidikan';
		$this->load->model('user_model');
		$this->load->model('dashboard_model');
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
		$this->data['title'] = 'Pendidikan';
		$username = $this->session->userdata('username');
		$this->data['foto_user'] = $this->user_model->get_foto_bynip($username);
		$this_year = date('Y');
		
		$this->load->model('dashboard_model');
		$this->data['total_pns'] = $this->dashboard_model->data_total_pns();
		$this->data['total_cpns'] = $this->dashboard_model->data_total_cpns();
		
		$total_cuti_tahun_ini = $this->dashboard_model->data_total_cuti_tahun_ini($this_year);
		$total_cuti_tahun_sebelumnya = $this->dashboard_model->data_sisa_cuti_tahun_sebelumnya($username, $this_year);
		$this->data['total_cuti'] = $total_cuti_tahun_ini + $total_cuti_tahun_sebelumnya;
		$this->data['cuti_dipakai'] = $this->dashboard_model->data_cuti_dipakai($username);
		
		$this->load->view('pendidikan', $this->data);
	}
	
	function UjianDinas()
	{
		$data['title'] = 'Ujian Dinas';
		$data['menumode'] = 'pendidikan';
		$this->load->view('UjianDinas', $data);
	}
	
	function DiklatJabatan()
	{
		$sql="SELECT A.*, B.nama
		FROM pegawai_diklat_jabatan A
		INNER JOIN pegawai B ON A.nip_baru=B.nip_baru";
		$query=$this->db->query($sql);
		$this->data['diklat']=$query->result();
		$this->data['title'] = 'Diklat Pegawai Dan Ujian Dinas';
		
		$this->load->view('pendidikan/DiklatJabatan', $this->data);
		$query->free_result();
		//print_r ($data['diklat']);
	}
	
	function add_diklat()
	{
		$sql="select nip_baru from pegawai";
		$query=$this->db->query($sql);
		$this->data['nip']=$query->result();
		$query->free_result();
		
		$sql="select * from m_pelatihan";
		$query=$this->db->query($sql);
		$this->data['pelatihan']=$query->result();
		$query->free_result();
		
		$data['title'] = 'Diklat Prajabatan';

		$this->load->view('pendidikan/add_diklat', $this->data);
	}
	
	function SimpanDiklat()
	{
		$id=$this->input->post('id');
		$nip=preg_replace("/[^\d]/", "", $this->input->post('nip'));
		$UnitKerja=$this->input->post('UnitKerja');
		$sql="update pegawai_riwayatpelatihanjabatan set is_last='Tidak' where nip_baru='".$nip."'";
		$this->db->query($sql);
		$data = array(
			'nip_baru' 			=> $nip,
			'nama' 				=> $this->input->post('nama'),
			'unit_kerja'		=> $UnitKerja,
			'jenis_pelatihan'  	=> $this->input->post('kategori'),
			'nama_pelatihan'  	=> $this->input->post('NamaPelatihan'),
			'lembaga_pelaksana'	=> $this->input->post('lembaga'),
			'tahun_sertifikasi'	=> $this->input->post('tahun'),
			'jml_jam_kursus' 	=> $this->input->post('jam'),
			'created_date'		=> date("Y-m-d H:i:s"),
			'created_by'		=> $this->session->userdata('nip')
		);
		
		$this->db->insert('pegawai_riwayatpelatihanjabatan', $data); 
		
		$data2 = array(
			'nip_baru' 			=> $nip,
			'nama' 				=> $this->input->post('nama'),
			'unit_kerja'		=> $UnitKerja,
			'jenis_pelatihan'  	=> $this->input->post('kategori'),
			'nama_pelatihan'  	=> $this->input->post('NamaPelatihan'),
			'lembaga_pelaksana'	=> $this->input->post('lembaga'),
			'tahun_sertifikat'	=> $this->input->post('tahun'),
			'jml_jam_kursus' 	=> $this->input->post('jam')
		);

		$this->db->where('nip_baru', $nip);
		$this->db->update('pegawai_diklat_jabatan', $data2); 
		
		//$sql="update pegawai_diklat_jabatan set nama = (select nama from pegawai where nip_baru='".$this->input->post('nip')."') where nip_baru='".$this->input->post('nip')."'";
		//$this->db->query($sql);
		redirect ('pendidikan/DiklatJabatan', 'refresh');
	}
	
	function EditDiklatJab($id)
	{
		$sql="select * from m_pelatihan";
		$query=$this->db->query($sql);
		$this->data['pelatihan']=$query->result();
		$query->free_result();
		$this->data['id']=$id;
		$this->data['title'] = 'Diklat Prajabatan';

		$this->load->view('pendidikan/add_diklat', $this->data);
	}
	
	function DiklatTeknis()
	{
		$sql="SELECT A.*, B.nama
		FROM pegawai_riwayatpelatihanteknis A
		INNER JOIN pegawai B ON A.nip_baru=B.nip_baru";
		$query=$this->db->query($sql);
		$this->data['diklat']=$query->result();
		$this->data['title'] = 'Diklat Non Teknis';
		
		$this->load->view('pendidikan/DiklatTeknis', $this->data);
		$query->free_result();
	}
	
	function AddDiklatTeknis()
	{
		$sql="select nip_baru from pegawai WHERE status='aktif'";
		$query=$this->db->query($sql);
		$this->data['nip']=$query->result();
		$query->free_result();
		
		$sql="select * from m_pelatihan";
		$query=$this->db->query($sql);
		$this->data['pelatihan']=$query->result();
		$query->free_result();
		
		$this->data['title'] = 'Diklat Prajabatan';

		$this->load->view('pendidikan/add_diklat_teknis', $this->data);
	}
	
	function SimpanDiklatTeknis()
	{
		$sql="update pegawai_riwayatpelatihanteknis set is_last='Tidak' where nip_baru='".$this->input->post('nip')."'";
		$this->db->query($sql);
		$data = array(
			'nip_baru' 			=> $this->input->post('nip'),
			'kategori'			=> $this->input->post('kategori'),
			'nama_pelatihan'  	=> $this->input->post('NamaPelatihan'),
			'lembaga_pelaksana'	=> $this->input->post('lembaga'),
			'negara_pelaksana'	=> $this->input->post('lembaga'),
			'jenis_pelatihan'  	=> $this->input->post('JenisPelatihan'),
			'tahun_sertifikasi'	=> $this->input->post('tahun'),
			'jml_jam_kursus' 	=> $this->input->post('jam'),
			'created_date'		=> date("Y-m-d H:i:s"),
			'created_by'		=> $this->session->userdata('nip')
		);
		
		$this->db->insert('pegawai_riwayatpelatihanteknis', $data); 
		
		$data = array(
			'kategori' 			=> $this->input->post('kategori'),
			'nama_pelatihan'  	=> $this->input->post('NamaPelatihan'),
			'lembaga_pelaksana'	=> $this->input->post('lembaga'),
			'negara_pelaksana'	=> $this->input->post('lembaga'),
			'jenis_pelatihan'  	=> $this->input->post('JenisPelatihan'),
			'tahun_sertifikasi'	=> $this->input->post('tahun'),
			'jml_jam_kursus' 	=> $this->input->post('jam'),
		);
		$this->db->where('nip_baru', $this->input->post('nip'));
		$this->db->update('pegawai_diklat_teknis', $data); 
		
		redirect ('pendidikan/DiklatTeknis', 'refresh');
	}
	
	function CetakJabatan($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('pegawai_diklat_jabatan');
		$this->data['data_cuti'] = $query->result_array();
		$this->data['id']=$id;
		$this->load->view('pendidikan/CetakDiklatPegawai', $this->data);
	}
	
	function cetak_diklat_teknis($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('pegawai_diklat_teknis');
		$this->data['data_cuti'] = $query->result_array();
		$this->data['id']=$id;
		$this->load->view('pendidikan/CetakDiklatPegawai', $this->data);
	}
	
	public function pendidikan_jumlah()
	{	
		//get dashboard_perpendidikan
		$dashboard_perpendidikan = $this->dashboard_model->dashboard_perpendidikan();
		$pegawai = array();
		$n=0;
		
		if(!empty($dashboard_perpendidikan)){
			foreach($dashboard_perpendidikan as $dt){
				$issliced = '';
				if($dt['issliced'] == 1){
					//$issliced = 'issliced="1" ';
				}
				//echo '<set label="'.$dt['nama'].'" value="'.$dt['total'].'" '.$issliced.'/>';
				$dt['color'] = $this->getColor($n);
					array_push($pegawai,$dt);				
				$n++;
			}
		}
		die(json_encode($pegawai));
	}
}