<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Permasalahan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'administrasipegawai';
		$this->load->model('Pegawai_model');
		
		//Notifikasi
		$this->load->model('notifikasi_model');
		$username = $this->session->userdata('username');
		$previlege = $this->session->userdata('login_state');
		$this->data['privilege'] =  $this->session->userdata('login_state');
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($username, $previlege);
	}
	
	public function index()
	{	
		$this->data['title'] = 'Permasalahan';
		$sql="SELECT A.*, D.kategori
		FROM permasalahan A 
		INNER JOIN m_kat_masalah D ON A.kategori_id=D.ID";
		$query=$this->db->query($sql);
		$this->data['pegawai']=$query->result();
		$query->free_result();
	
		$this->load->view('permasalahan/permasalahan', $this->data);
	}
	
	public function add()
	{

		$sql="select * from m_kat_masalah";
		$query=$this->db->query($sql);
		$this->data['kategori']=$query->result();
		$query->free_result();
		
		$sql="select nip_baru from pegawai WHERE status='aktif'";
		$query=$this->db->query($sql);
		$this->data['nip']=$query->result();
		$query->free_result();
		
		$this->data['data_pegawai'] = False ;
		$this->data['title'] = 'Form Permasalahan';
		$this->load->view('permasalahan/FrmPermasalahan', $this->data);
	}
	
	function GetNama ()
	{
		$value=$this->input->post('nip');
		$sql = "SELECT nama FROM pegawai where nip_baru='$value'";
		$hasil = $this->db->query($sql);
		if($hasil->num_rows() > 0){
			foreach ($hasil->result() as $row)
			{
				$data=$row->nama;
			}
		}
		//$hasil->free_result();
		//$data=$AtasNama."#".$NoRek;
		echo $data;
	}
	
	function GetSubKategori($id='', $sub='') {
		$id=urldecode($id);
        //$this->db->order_by("KotaUsaha", "ASC");
        $this->db->where("kategori_id", $id);
        $query = $this->db->get("m_sub_kat_masalah");
		$tmp='';
        $data=$query->result();
        if(!empty($data)){
            $tmp .= "<option value=''>--Pilih--</option>";
            foreach($data as $row) {   
				if ($row->id==$sub)
				{
					$tmp .= "<option value='".$row->id."' selected=selected>".$row->sub_kategori."</option>";
				} else {
					$tmp .= "<option value='".$row->id."'>".$row->sub_kategori."</option>";
				}
            }
        } else {
            $tmp .= "<option value=''>--Pilih--</option>";
        }
        die($tmp);
    }
	
	function simpan()
	{
		$kategori_id=$this->input->post('kategori');
		$sub_kategori_id=$this->input->post('sub_kategori');
		$nip=preg_replace("/[^\d]/", "", $this->input->post('nip'));
		$keterangan=$this->input->post('keterangan');
		$tanggal=$this->input->post('tanggal');
		$tanggal = date_create($tanggal);
		$tanggal=date_format($tanggal, 'Y-m-d');
		$id=$this->input->post('id');
		$nama=$this->input->post('nama');
		$UnitKerja=$this->input->post('UnitKerja');
		$this->db->set('kategori_id', $kategori_id);
		$this->db->set('sub_kategori_id', $sub_kategori_id);
		$this->db->set('nip', $nip);
		$this->db->set('keterangan', $keterangan);
		$this->db->set('tanggal', $tanggal);
		$this->db->set('nama', $nama);
		$this->db->set('unit_kerja', $UnitKerja);
		
		if (empty($id))
		{
			$this->db->insert('permasalahan');
		}
		else
		{
			$this->db->where('id', $id);
			$this->db->update('permasalahan'); 
		}
		
		//$nip=$this->input->post('nip');
		//$UnitKerja=$this->input->post('UnitKerja');
		$sql="select nip_baru from pegawai where nip_baru='$nip'";
		$query=$this->db->query($sql);
		if ($query->num_rows() < 1)
		{
			$data = array(
					'nip_baru' 			=> $nip,
					'nama'  			=> $this->input->post('nama'),
				);
			$this->db->insert('pegawai', $data); 
		}

		$sql="select nama_unit_kerja from m_unit_kerja where nama_unit_kerja='$UnitKerja'";
		$query=$this->db->query($sql);
		if ($query->num_rows() < 1)
		{
			$data = array(
					'nama_unit_kerja' 			=> $UnitKerja
				);
			$this->db->insert('m_unit_kerja', $data); 
		}

		redirect ('permasalahan', 'refresh');
	}
	
	function edit($id)
	{
		
			$this->data['judul'] ="Edit Pelaku";
			$sql="select * from m_kat_masalah";
			$query=$this->db->query($sql);
			$this->data['kategori']=$query->result();
			$query->free_result();
			//$id = $this->input->post('id');
			$sql = $this->db->query("SELECT * FROM permasalahan WHERE id='$id'");
			foreach ($sql->result() as  $t) {
				//$up['No_LP']=$t->No_LP;
				$this->data['id']=$t->id;
				$this->data['kategori_id'] =$t->kategori_id;
				$this->data['sub_kategori_id'] = $t->sub_kategori_id;
				$this->data['nip'] = $t->nip;
				$this->data['keterangan'] = $t->keterangan;
				$this->data['tanggal'] = $t->tanggal;
				
			}
			$sql->free_result();
			/*
			$kategori_id=$up['kategori_id'];
			$sql="select kategori from m_kat_masalah where id=$kategori_id";
			$query=$this->db->query($sql);
			foreach ($query->result() as $row)
			{
				$up['kategori'] =$row->kategori;
			}
			$query->free_result();
			*/
			$this->data['title'] = 'Form Permasalahan';
	
			$this->load->view('permasalahan/FrmPermasalahan', $this->data);
			
	}
	
	public function cetak()
	{
		$this->data['title'] = 'Print Penghargaan';
		$this->load->view('cetak_penghargaan', $this->data);
	}
	
	public function listprocessed()
	{
		$this->data['title'] = 'List Penghargaan';
		$this->load->view('list_penghargaan', $this->data);
	}
	
	function UpdateStatus($tipe, $id)
	{

		$this->data['tipe']=$tipe;
		$this->data['id']=$id;
		$this->load->view('permasalahan/FrmStatusPerm', $this->data);
	}
	
	function SimpanStatus()
	{
		$id=$this->input->post('id');
		$status=$this->input->post('status');
		$tipe=$this->input->post('tipe');
		$masalah=$this->input->post('masalah');
		switch ($tipe)
		{
			case "UsulanSurat":
				$this->db->set('dok_usulan_msk', $status);
				break;
			case "ProsesSurat":
				$this->db->set('proses_surat', $status);
				break;
			case "TandaTangan":
				$this->db->set('tanda_tangan_surat', $status);
				break;
			case "SuratDikirim":
				$this->db->set('surat_dikirim', $status);
				break;
			case "Selesai":
				$this->db->set('sk_selesai', $status);
				break;
		}
		$this->db->set('permasalahan', $masalah);
		$this->db->where('id', $id);
		$this->db->update('permasalahan'); 
		if (!empty($masalah))
		{
			switch ($tipe)
			{
				case "UsulanSurat":
					$this->db->set('proses', 'Dokumen Usulan Masuk');
					break;
				case "ProsesSurat":
					$this->db->set('proses', 'Proses Entry Data');
					break;
				case "TandaTangan":
					$this->db->set('proses', 'Tanda Tangan Usulan');
					break;
				case "SuratDikirim":
					$this->db->set('proses', 'Kirim Ke Biro');
					break;
				case "Selesai":
					$this->db->set('proses', 'SK Selesai');
					break;
			}
			$this->db->set('keterangan', $masalah);
			$this->db->set('permasalahan_id', $id);
			$this->db->insert('permasalahan_status_update'); 
		}
		redirect ('permasalahan');
	}
	
	function delete($id)
	{
		$this->db->delete('permasalahan', array('id' => $id)); 
		redirect ('permasalahan', 'refresh');
	}
}
