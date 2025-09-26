<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mutasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'administrasipegawai';
		
		//Notifikasi
		$this->load->model('notifikasi_model');
		$username = $this->session->userdata('username');
		$previlege = $this->session->userdata('login_state');
		$this->data['privilege'] =  $this->session->userdata('login_state');
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($username, $previlege);
	}
	
	public function index()
	{	
		$this->data['title'] = 'Mutasi Pegawai';

		$sql="SELECT A.id, A.nip, A.nama, A.unit_kerja, A.tujuan_pindah, A.unit_asal, A.unit_tujuan, A.no_surat
				FROM pegawai_mutasi A";
		$query=$this->db->query($sql);
		$this->data['pegawai']=$query->result();
		$query->free_result();
		
		$this->load->view('mutasi/mutasi', $this->data);
	}
	
	function add()
	{
		$sql="select nip_baru, nama from pegawai";
		$query=$this->db->query($sql);
		$this->data['nip']=$query->result();
		$query->free_result();
		$this->data['title'] = 'Input Data Mutasi';

		$this->load->view('mutasi/add_mutasi', $this->data);
	}
	
	function edit($id)
	{
		$sql="select nip_baru, nama from pegawai";
		$query=$this->db->query($sql);
		$this->data['nip']=$query->result();
		$query->free_result();
		$this->data['id']=$id;
		$this->data['title'] = 'Edit Data Mutasi';

		$this->load->view('mutasi/add_mutasi', $this->data);
	}
	
	function simpan()
	{
		$id=$this->input->post('id');
		
		$data = array(
			'nip' 			=> $this->input->post('nip'),
			'nama'			=> $this->input->post('nama'),
			'unit_kerja'  	=> $this->input->post('UnitKerja'),
			'tujuan_pindah'  	=> $this->input->post('TujuanPindah'),
			'unit_asal'	=> $this->input->post('UnitAsal'),
			'unit_tujuan'	=> $this->input->post('UnitTujuan'),
			'keterangan' 	=> $this->input->post('keterangan'),
			//'no_surat' 	=> $this->input->post('NoSurat'),
			'created_date'		=> date("Y-m-d H:i:s"),
			'created_by'		=> $this->session->userdata('nip')
		);
		
		if (empty($id))
		{
			$this->db->insert('pegawai_mutasi', $data); 
		} else {
			$this->db->where('id', $id);
			$this->db->update('pegawai_mutasi', $data); 
		}
		
		$nip=$this->input->post('nip');
		$UnitKerja=$this->input->post('UnitKerja');
	
		//JANGAN INPUT KE PEGAWAI. HARUSNYA KLO MUTASI UPDATE TEMPAT KERJA PEGAWAI!!!!
	
		redirect ('mutasi', 'refresh');
	}
	
	function delete($id)
	{
		$this->db->delete('pegawai_mutasi', array('id' => $id)); 
		redirect ('mutasi', 'refresh');
	}
	
	function surat()
	{
		$sql="SELECT A.id, A.nip, B.nama FROM pegawai_mutasi A LEFT JOIN pegawai B ON A.nip=B.nip_baru WHERE A.no_surat IS NULL or A.no_surat=''";
		$query=$this->db->query($sql);
		$this->data['daftar']=$query->result();
		$query->free_result();
		
		$sql="SELECT A.nip_baru, A.nama FROM pegawai A";
		$query=$this->db->query($sql);
		$this->data['sekretaris']=$query->result();
		$query->free_result();
		
		$this->data['title'] = 'Input Surat Mutasi';

		$this->load->view('mutasi/surat_mutasi', $this->data);
	}
	
	function SimpanSurat()
	{
		$this->load->library('encrypt');
		$tanggal=$this->input->post('tanggal');
		$tanggal = date_create($tanggal);
		$tanggal=date_format($tanggal, 'Y-m-d');
		$NoSurat=$this->input->post('NoSurat');
		$tembusan=$this->input->post('tembusan');
		$id=$this->input->post('id');
		$data = array(
			'no_surat' 	=> $this->input->post('NoSurat'),
			'tanggal'  	=> $tanggal,
			'tembusan'  => $this->input->post('tembusan'),
			'sekretaris' => $this->input->post('sekretaris')
		);
		if (empty($id))
		{
			$this->db->insert('surat_mutasi', $data); 
			foreach($_POST['daftar'] as $Suratid)    
			{
				$data = array(
					'no_surat' 	=> $this->input->post('NoSurat')
				);
				$this->db->where('id', $Suratid);
				$this->db->update('pegawai_mutasi', $data); 
				//echo $id."<br>"; 
			}
		} else {
			$this->db->where('id', $id);
			$this->db->update('surat_mutasi', $data); 
			$sql="update pegawai_mutasi set no_surat=NULL where no_surat='$NoSurat'";
			$this->db->query($sql);
			foreach($_POST['daftar'] as $Suratid)    
			{
				$data = array(
					'no_surat' 	=> $this->input->post('NoSurat')
				);
				$this->db->where('id', $Suratid);
				$this->db->update('pegawai_mutasi', $data); 
				//echo $id."<br>"; 
			}
		}
		
		
		//$this->cetak($NoSurat);
		$sql="select id from surat_mutasi where no_surat='$NoSurat'";
		$query=$this->db->query($sql);
		foreach ($query->result() as $row)
		{
			$SuratID=$row->id;
		}
		$query->free_result();
		?>
		<script>
			child = window.open("<?php echo base_url(); ?>mutasi/cetak/<?php echo $SuratID;?>", "", "scrollbars=1,height=800, width=600");
		</script>
		<?php
		redirect ('mutasi', 'refresh');
	}
	
	function cetak($id)
	{
		$this->load->model('mutasi_model');
		
		$this->data['mutasi'] = $this->mutasi_model->get_mutasi($id);
		$this->load->view('mutasi/cetak_mutasi', $this->data);
		
	}
	
	function ViewSurat()
	{
		$this->load->library('encrypt');
		$this->data['title'] = 'Daftar Surat Mutasi Pegawai';

		$sql="select a.id, a.no_surat, DATE_FORMAT(a.tanggal,'%d %b %Y') tanggal, CONCAT_WS(' - ',a.sekretaris,c.nama) sekretaris, count(b.nip) jumlah from surat_mutasi a, pegawai_mutasi b, pegawai c where a.no_surat=b.no_surat and a.sekretaris=c.nip_baru group by a.no_surat";
		$query=$this->db->query($sql);
		$this->data['surat']=$query->result();
		$query->free_result();
		$this->load->view('mutasi/SuratMutasi', $this->data);
	}
	
	function EditSurat($id)
	{
		$sql="SELECT A.id, A.nip, B.nama FROM pegawai_mutasi A LEFT JOIN pegawai B ON A.nip=B.nip_baru WHERE A.no_surat IS NULL or A.no_surat=''";
		$query=$this->db->query($sql);
		$this->data['daftar']=$query->result();
		$query->free_result();
		
		$sql="SELECT A.nip_baru, A.nama FROM pegawai A";
		$query=$this->db->query($sql);
		$this->data['sekretaris']=$query->result();
		$query->free_result();
		$this->data['id']=$id;
		$this->data['title'] = 'Edit Surat Mutasi';
	
		$this->load->view('mutasi/surat_mutasi', $this->data);
	}
	
	public function cetak_multi($id)
	{
		$this->data['title'] = 'Print Mutasi';
		$this->load->model('mutasi_model');
		
		$idx = explode('_', $id);
		if(count($idx) > 1){
			$this->data['mutasi'] = $this->mutasi_model->get_mutasi($idx[0]);
			$this->load->view('mutasi/cetak_kolektif', $this->data);
		}
		if(count($idx) == 1){
			$this->data['mutasi'] = $this->mutasi_model->get_mutasi($id);
			$this->load->view('mutasi/cetak_mutasi', $this->data);
		}
	}
	
	public function cetak_lampiran($id)
	{
		$this->data['title'] = 'Print Mutasi';
		$this->load->model('mutasi_model');
		
		//$idx = explode('_', $id);
		//if(count($idx) > 1){
			$this->data['list_mutasi'] = $this->mutasi_model->get_mutasi_check($id);
			$this->load->view('mutasi/cetak_lampiran', $this->data);
		//}
		
	}
}