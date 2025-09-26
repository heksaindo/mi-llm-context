<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kehadiran extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'penugasandankehadiran';
		$this -> load -> library( 'form_validation' );
		//Notifikasi
		$this->load->model('notifikasi_model');
		$username = $this->session->userdata('username');
		$previlege = $this->session->userdata('login_state');
		$this->data['privilege'] =  $this->session->userdata('login_state');
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($username, $previlege);
	}
	
	public function index()
	{	
		$this->data['title'] = 'Data Kehadiran';
		
		$sql="SELECT A.id, A.tanggal, B.nama_unit_kerja DIRGEN, C.nama_unit_kerja SEKDIR, D.nama_unit_kerja UNIT,
		E.nama_unit_kerja SUB_UNIT, A.datang_tepat, A.datang_telat, A.pulang_tepat, A.pulang_telat, A.pulang_telat_dinas,
		A.tidak_absen
		FROM kehadiran A LEFT JOIN m_unit_kerja B
		ON A.dirgen=B.id_unit_kerja 
		LEFT JOIN m_unit_kerja C ON A.sekdir=C.id_unit_kerja
		LEFT JOIN m_unit_kerja D ON A.unit=D.id_unit_kerja
		LEFT JOIN m_unit_kerja E ON A.sub_unit=E.id_unit_kerja
		order by A.tanggal DESC";
		$query=$this->db->query($sql);
		$this->data['kehadiran']=$query->result();
		$query->free_result();
		$this->load->view('kehadiran/kehadiran', $this->data);
	}
	
	function add()
	{
		$sql="SELECT A.id_unit_kerja, A.kode_unit_kerja kode, A.nama_unit_kerja nama FROM m_unit_kerja A where A.level=1";
		$query=$this->db->query($sql);
		$this->data['dirgen']=$query->result();
		$query->free_result();
		$this->data['title'] = 'Input Data Kehadiran';

		$this->load->view('kehadiran/add_kehadiran', $this->data);
	}
	
	function get_sekdir($id) {
		$tmp='';
		$id=urldecode($id);
        $this->db->order_by("kode_unit_kerja", "ASC");
        $this->db->where("parent_unit", $id);
		$this->db->where("level", '2');
        $query = $this->db->get("m_unit_kerja");
        $data=$query->result();
        if(!empty($data)){
            $tmp .= "<option value=''></option>";
            foreach($data as $row) {   
                $tmp .= "<option value='".$row->id_unit_kerja."'>".$row->kode_unit_kerja." - ".$row->nama_unit_kerja."</option>";
            }
        } else {
            $tmp .= "<option value=''></option>";
        }
		$query->free_result();
        die($tmp);
    }
	
	function get_unit($id) {
		$tmp='';
		$id=urldecode($id);
        $this->db->order_by("kode_unit_kerja", "ASC");
        $this->db->where("parent_unit", $id);
		$this->db->where("level", '3');
        $query = $this->db->get("m_unit_kerja");
        $data=$query->result();
        if(!empty($data)){
            $tmp .= "<option value=''></option>";
            foreach($data as $row) {   
                $tmp .= "<option value='".$row->id_unit_kerja."'>".$row->kode_unit_kerja." - ".$row->nama_unit_kerja."</option>";
            }
        } else {
            $tmp .= "<option value=''></option>";
        }
		$query->free_result();
        die($tmp);
    }
	
	function get_subunit($id) {
		$id=urldecode($id);
        $this->db->order_by("kode_unit_kerja", "ASC");
        $this->db->where("parent_unit", $id);
		$this->db->where("level", '4');
        $query = $this->db->get("m_unit_kerja");
        $data=$query->result();
        foreach($data as $row) {   
            $tmp .= "<option value='".$row->id_unit_kerja."'>".$row->kode_unit_kerja." - ".$row->nama_unit_kerja."</option>";
        }
        die($tmp);
    }
	
	function edit($id)
	{
		$sql="SELECT A.id_unit_kerja, A.kode_unit_kerja kode, A.nama_unit_kerja nama FROM m_unit_kerja A where A.level=1";
		$query=$this->db->query($sql);
		$this->data['dirgen']=$query->result();
		$query->free_result();
		$this->data['title'] = 'Edit Data Kehadiran';
		$this->data['id']=$id;
		
		$this->load->view('kehadiran/add_kehadiran', $this->data);
	}
	
	function simpan()
	{
		$this -> form_validation -> set_error_delimiters('<span class="help-block">',  '</span>');
        $this -> form_validation -> set_rules( 'tanggal', 'Tanggal', 'trim|required' );
		$this -> form_validation -> set_rules( 'dirgen', 'Direktorat Jenderal', 'trim|required' );
		$this -> form_validation -> set_rules( 'sekdir', 'Sekretariat/Direktorat', 'trim|required' );
		$this -> form_validation -> set_rules( 'unit', 'Unit', 'trim|required' );
		$this -> form_validation -> set_rules( 'subunit', 'Sub Unit', 'trim|required' );
		$this -> form_validation -> set_rules( 'DatangTepat', 'Datang Tepat', 'trim|required|numeric' );
		$this -> form_validation -> set_rules( 'DatangTelat', 'Datang Telat', 'trim|required|numeric' );
		$this -> form_validation -> set_rules( 'PulangTepat', 'Pulang Tepat','trim|required|numeric' );
		$this -> form_validation -> set_rules( 'PulangTelat', 'Pulang Telat','trim|required|numeric' );
		$this -> form_validation -> set_rules( 'PulangTelatDinas', 'Pulang Telat Karena Dinas','trim|required|numeric' );
		$this -> form_validation -> set_rules( 'TidakAbsen', 'Tidak Absen','trim|required|numeric' );
		
		$this -> form_validation -> set_message( 'numeric', '%s hanya boleh angka');
		$this -> form_validation -> set_message( 'alpha_numeric', '%s hanya boleh alfabet dan numerik');
		$this -> form_validation -> set_message( 'valid_email', '%s tidak valid');
		$this -> form_validation -> set_message( 'matches', '%s tidak sama');
		$this -> form_validation -> set_message( 'required', 'Harus mengisi %s');
        $this -> form_validation -> set_message( 'min_length', 'Minimum panjang %s %s karakter');
        $this -> form_validation -> set_message( 'max_length', 'Maksimum panjang %s %s karakter');
		
		 if ( $this -> form_validation -> run() === FALSE )
        {
			$this->add();
        }
		else
		{
			$id=$this->input->post('id');
			$tanggal=$this->input->post('tanggal');
			$tanggal = date_create($tanggal);
			$tanggal=date_format($tanggal, 'Y-m-d');
			$data = array(
				'tanggal' 		=> $tanggal,
				'dirgen'  		=> $this->input->post('dirgen'),
				'sekdir'  		=> $this->input->post('sekdir'),
				'unit'			=> $this->input->post('unit'),
				'sub_unit'	=> $this->input->post('subunit'),
				'datang_tepat' 	=> $this->input->post('DatangTepat'),
				'datang_telat' 	=> $this->input->post('DatangTelat'),
				'pulang_tepat' 	=> $this->input->post('PulangTepat'),
				'pulang_telat' 	=> $this->input->post('PulangTelat'),
				'pulang_telat_dinas' 	=> $this->input->post('PulangTelatDinas'),
				'tidak_absen' 	=> $this->input->post('TidakAbsen'),
				'created_date'		=> date("Y-m-d H:i:s"),
				'created_by'		=> $this->session->userdata('nip')
			);
			
			if (empty($id))
			{
				$this->db->insert('kehadiran', $data); 
			} else {
				$this->db->where('id', $id);
				$this->db->update('kehadiran', $data); 
			}
			redirect ('kehadiran', 'refresh');
		}
	}
	
	function delete($id)
	{
		$this->db->delete('kehadiran', array('id' => $id)); 
		redirect ('kehadiran', 'refresh');
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

		$this->load->view('kehadiran/surat_mutasi', $this->data);
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
		//$this->load->library('encrypt');
		//$key = 'Pu4l4mj4y4';
		//$NoSurat=$this->encrypt->decode($NoSurat);
		//$NoSurat=urldecode($NoSurat);
		$sql="select a.no_surat, DATE_FORMAT(a.tanggal,'%d %b %Y') tanggal, a.tembusan, a.sekretaris, count(b.nip) jumlah, c.nama from surat_mutasi a, pegawai_mutasi b, pegawai c
		where a.no_surat=b.no_surat and a.id='".$id."' and a.sekretaris=c.nip_baru";
		$query=$this->db->query($sql);
		$data['data']=$query->result();
		$this->load->view('kehadiran/CetakSuratMutasi', $data);
	}
	
	function ViewSurat()
	{
		$this->load->library('encrypt');
		$this->data['title'] = 'Daftar Surat Mutasi Pegawai';
		
		$sql="select a.id, a.no_surat, DATE_FORMAT(a.tanggal,'%d %b %Y') tanggal, CONCAT_WS(' - ',a.sekretaris,c.nama) sekretaris, count(b.nip) jumlah from surat_mutasi a, pegawai_mutasi b, pegawai c where a.no_surat=b.no_surat and a.sekretaris=c.nip_baru group by a.no_surat";
		$query=$this->db->query($sql);
		$this->data['surat']=$query->result();
		$query->free_result();
		$this->load->view('kehadiran/SuratMutasi', $this->data);
	}
	
	function EditSurat($id)
	{
		$sql="SELECT A.id, A.nip, B.nama FROM pegawai_mutasi A LEFT JOIN pegawai B ON A.nip=B.nip_baru WHERE A.no_surat IS NULL or A.no_surat=''";
		$query=$this->db->query($sql);
		$this->data['daftar']=$query->result();
		$query->free_result();
		
		$sql="SELECT A.nip_baru, A.nama FROM pegawai A WHERE A.status='aktif'";
		$query=$this->db->query($sql);
		$this->data['sekretaris']=$query->result();
		$query->free_result();
		$this->data['id']=$id;
		$this->data['title'] = 'Edit Surat Mutasi';

		$this->load->view('kehadiran/surat_mutasi', $this->data);
	}
	
	function GetUnit ()
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
}