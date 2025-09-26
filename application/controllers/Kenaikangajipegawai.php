<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kenaikangajipegawai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'administrasipegawai';
		$this->load->model('kgp_model');
		$this->load->helper('general_helper');
		//Notifikasi
		$this->load->model('notifikasi_model');
		$username = $this->session->userdata('email_user');
		$previlege = $this->session->userdata('login_state');
		$this->data['privilege'] =  $this->session->userdata('login_state');
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($username, $previlege);
	}
	
	public function index()
	{	
		$this->data['title'] = 'Kenaikan Gaji Pegawai';
		//$this->data['data_pegawai'] = $this->kgp_model->get_kgp_forlist();
		$this->load->view('kgp/kgp', $this->data);
	}
	
	function ajax_kgp()
    {
        $result = $this->kgp_model->get_kgp_forlist();
		$datas = array();
		if($result)
		{
			foreach($result as $row)
			{
				$datas[] = $row;
			}
		}
		
		$json["aaData"] = array();		
		$retval = array(
			"aaData" => array()
		);
		$i = 1;

		if($datas){
			foreach($datas as $row)
			{
				$pegawai_id = $row['id_pegawai'];
				$printnya = '';
				//if($row['id'] == '0'){
					$printnya .= '<li><a href="'.base_url().'kenaikangajipegawai/addexisting/'.$pegawai_id.'" class="tip" title="Proses"><i class="fam-help"></i></a> </li>';
				/*}else{
					$printnya .= '<li><a href="'.base_url().'kenaikangajipegawai/editexisting/'.$pegawai_id.'/'.$row['id'].'" class="tip" title="Edit entry"><i class="fam-application-edit"></i></a> </li>';
					$printnya .= '<li><a onclick="window.open(\''.base_url().'kenaikangajipegawai/cetak/'.$row['id'].'\', \' \', \'scrollbars=1,height=800, width=700\')" href="#" class="tip" title="Print entry"><i class="fam-printer"></i></a> </li>';
					
				}*/
				
				//$gapok_terakhir = $row['gapok_terakhir'];
				//if(empty($gapok_terakhir)){
					$gapok_terakhir = getGapok($row['golongan'],$row['masa_kerja_tahun']);
				//}
				if($row['masa_kerja_tahun']=='') $row['masa_kerja_tahun'] =0;
				if($row['masa_kerja_bulan']=='') $row['masa_kerja_bulan'] =0;
				$masa_kerja = $row['masa_kerja_tahun'].' Thn '.$row['masa_kerja_bulan'].' Bln';
				array_push($json["aaData"],array(
					$i,
					'<a href="'.base_url().'pegawai/detail/'.$pegawai_id.'" class="tip" title="Detail Pegawai" >'.$row['nama'].'</a><br>'.$row['nip_baru'],
					$row['jabatan'],
					$row['pangkat'],
					$row['golongan'],
					$masa_kerja,
					number_format_id($gapok_terakhir),				
					$row['no_sk'],
					date('d-m-Y', strtotime($row['tanggal_sk'])),
					$row['pejabat_penetapan'],
					'<ul class="table-controls">'.$printnya.'</ul>'
				));
				$i++;
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
		//echo "<pre>";
		//print_r($json);
		//echo "</pre>";
    }
	
		//==== Histori  ====
	public function list_histori_kgp()
	{
		$this->data['title'] = 'List Histori Kenaikan Gaji Pegawai ';
		$this->load->view('kgp/histori_kgp', $this->data);
	}

	
	
	public function add_kgp_pilihan()
	{
		//$this->data['data_dokumen'] = $this->kgp_model->get_dokumen();
		$this->data['data_jabatan_ttd'] = $this->kgp_model->ddl_jabatan_ttd();
		$this->data['title'] = 'Add Kenaikan Gaji Pegawai Pilihan';
		$this->load->view('kgp/add_kgp_pilihan', $this->data);
	}
	
	public function addexisting($id_peg)
	{
		$this->data['pegawai'] 	= $this->kgp_model->get_pegawai($id_peg);
		//$this->data['data_dokumen'] = $this->kgp_model->get_dokumen($id_peg);
		$this->data['data_jabatan_ttd'] = $this->kgp_model->ddl_jabatan_ttd();
		$this->data['tmt'] = $this->db->from('pegawai_kepegawaian')->where('id_pegawai', $id_peg)->get()->row();
		$this->data['title'] = 'Add Kenaikan Gaji Pegawai Berkala';
		$this->load->view('kgp/add_kgp', $this->data);
	}
	
	public function editexisting($id_peg, $id)
	{
		$this->data['data_kgb'] = $this->kgp_model->get_kgp($id);
		//$this->data['data_dokumen'] = $this->kgp_model->get_dokumen($id_peg);
		$this->data['data_jabatan_ttd'] = $this->kgp_model->ddl_jabatan_ttd();
		$this->data['title'] = 'Edit Kenaikan Gaji Pegawai';
		$this->load->view('kgp/edit_kgp', $this->data);
	}
	
	public function cetak($id)
	{
		$this->data['title'] = 'Print Kenaikan Gaji Pegawai';
		$this->data['kgp'] = $this->kgp_model->get_kgp($id);
		$this->load->view('kgp/cetak_kgp', $this->data);
	}
	
	public function do_change_status()
	{
		extract($_POST); 
		if(!empty($nip_baru)){

			$data['status_kp'] = $newstatus;
			$update = $this->kgp_model->update_kgb($data, $nip_baru);
		}
		if($update){
			echo 'success';
		}else{
			echo 'failed';
		}
		
	}
	
	//AUTOCOMPLETE
	function auto_pegawai_pilihan(){
		extract($_POST); 
		
		$where = "(a.nama like '%".$q."%' OR a.nip_baru like '%".$q."%')";
		$this->db->select('a.id as id_pegawai, a.gelar_depan, a.gelar_depan, a.nama, a.gelar_belakang, a.gelar_belakang, a.nip_baru, f.nama_jabatan, b.eselon, f.nama_jabatan as jabatan,
							e.nama_unit_kerja as kantor, c.status_kepegawaian, c.gol_terakhir, 
							c.gapok_terakhir AS gapok_lama, c.masa_kerja_tahun, c.masa_kerja_bulan, c.masa_kerja_golongan,c.tmt_gol_terakhir,c.tmt_kgb_terakhir,
							d.no_sk, d.kepangkatan, 
							d.tgl_sk AS tanggal_sk, 
							d.pejabat_penandatangan AS pejabat_penetapan,
							d.tmt_kepangkatan, 
							c.tmt_kgb_terakhir AS tmt_kgb
							')
				->from('pegawai as a', false)
				->join('pegawai_jabatan as b', 'a.id = b.id_pegawai', false)
				->join('pegawai_kepegawaian as c','a.id = c.id_pegawai', false)
				->join('pegawai_kepangkatan as d','a.id = d.id_pegawai', false)
				->join('m_unit_kerja as e','b.kode_unit_kerja = e.kode_unit_kerja', 'LEFT', false)
				->join('m_jabatan as f','b.id_jabatan = f.id_jabatan', 'LEFT', false)
				//->join('m_golongan as g','c.gol_terakhir = g.kode_golongan', 'LEFT', false)
				//->join('m_gapok as h','g.kdkelgapok = h.kdkelgapok', 'LEFT', false)
				->where('a.status','aktif')
				->where($where);
		$this->db->order_by('a.nama', 'ASC');
		$this->db->limit(10);
		$q_part=$this->db->get();
		$count = $this->db->count_all_results();
		if ($count>0){
			foreach($q_part->result() as $row){
				
				$pangkat = $row->gol_terakhir.' - '.$row->kepangkatan;
				if($row->tmt_kgb_terakhir > $row->tmt_gol_terakhir){$tmt_kepangkatan = $row->tmt_kgb_terakhir;}else{$tmt_kepangkatan = $row->tmt_gol_terakhir;}
				$masa_kerja_golongan = $row->masa_kerja_golongan;
				$masa_kerja_tahun = $row->masa_kerja_tahun;
				$masa_kerja_bulan = $row->masa_kerja_bulan;
				
				$gapok_lama = $row->gapok_lama;
				if(empty($gapok_lama)){
					$gapok_lama = getGapok($row->gol_terakhir, $masa_kerja_tahun);
				}
				//Baru
				$golongan = nextGolongan($row->gol_terakhir);
				$new_golongan = $golongan .' - '.get_name('m_golongan','nama_golongan','kode_golongan', $golongan);
				$masa_kerja = $masa_kerja_tahun + 2; //+2 tahun
				$new_masa_kerja = $masa_kerja.' Thn'; //+2 tahun
				//$tanggal_berlaku2 = date('d-m-Y');
				//$gapok_baru = getGapok($golongan, $masa_kerja);
				$tgl_laku = date("d-m-Y",strtotime($tmt_kepangkatan.' +2 years'));
				if($masa_kerja_bulan>0){
					$tanggal_berlaku2 = date("d-m-Y",strtotime($tgl_laku.' -'.$masa_kerja_bulan.' month'));
				}else{
					$tanggal_berlaku2 = $tgl_laku;
				}
				
				if(!empty($row->gelar_belakang)){
					$nama = $row->gelar_depan.' '.ucwords(strtolower($row->nama)).', '.$row->gelar_belakang;
				}else{
					$nama = trim($row->gelar_depan.' '.ucwords(strtolower($row->nama)));
				}
				echo $nama."|".$row->nip_baru."|".$pangkat."|".$row->jabatan."|".$row->kantor.
				"|".$new_golongan."|".$masa_kerja_golongan."|".$gapok_lama."|".$row->no_sk."|".date('d-m-Y', strtotime($row->tanggal_sk)).
				"|".$row->pejabat_penetapan."|".date('d-m-Y', strtotime($tmt_kepangkatan))."|".$row->id_pegawai.
				"|".$row->gol_terakhir."|".$new_masa_kerja."|".$tanggal_berlaku2."|".$row->masa_kerja_tahun."|".$row->masa_kerja_bulan."|".$row->tmt_gol_terakhir.	
				"\n";
			}
		}
				
	}
	
	function cek_gapok_baru(){
		extract($_POST); 
		
		$gapok_baru = getGapokNew($golongan, $masa_kerja_tahun, $masa_kerja_bulan);
		echo $gapok_baru;
	}
	
	//AUTOCOMPLETE
	function auto_pegawai(){
		extract($_POST); 
		
		$where = "(a.nama like '%".$q."%' OR a.nip_baru like '%".$q."%')";
		$this->db->select("a.id AS id_pegawai,  
							a.nip_baru AS nip_baru,  
							a.gelar_depan, a.nama, a.gelar_belakang,  
							b.kepangkatan AS pangkat,  
							m.nama_jabatan AS jabatan,  
							f.nama_unit_kerja AS kantor,
							d.gol_terakhir AS golongan,
							d.masa_kerja_golongan AS masa_kerja,
							d.masa_kerja_tahun,
							d.masa_kerja_bulan,
							d.gapok_terakhir AS gapok_lama, 
							b.no_sk AS no_sk, 
							b.tgl_sk AS tanggal_sk, 
							b.pejabat_penandatangan AS pejabat_penetapan,
							d.tmt_kgb_terakhir AS tmt_kgb,
							b.tmt_kepangkatan AS tmt_kp")
				->from("pegawai a")
				->join('pegawai_kepangkatan b','a.id=b.id_pegawai','LEFT')
				->join('pegawai_jabatan c','a.id=c.id_pegawai','LEFT')
				->join('pegawai_kepegawaian d','a.id=d.id_pegawai','LEFT')
				//->join('m_gapok e','e.kdgapok = d.kdgapok','LEFT')
				->join('m_unit_kerja f','c.kode_unit_kerja = f.kode_unit_kerja','LEFT')
				->join('m_jabatan m','m.id_jabatan = c.id_jabatan','LEFT')
				->where('a.status','aktif')
				->where($where);
		$this->db->order_by('a.nama', 'ASC');
		$this->db->limit(10);
		$q_part=$this->db->get();
		$count = $this->db->count_all_results();
		if ($count>0){
			foreach($q_part->result() as $row){
				
				$gapok_lama = $row->gapok_lama;
				if(empty($gapok_lama)){
					$gapok_lama = getGapok($row->golongan, $row->masa_kerja_tahun);
				}
				if(!empty($row->gelar_belakang)){
					$nama = $row->gelar_depan.' '.ucwords(strtolower($row->nama)).', '.$row->gelar_belakang;
				}else{
					$nama = trim($row->gelar_depan.' '.ucwords(strtolower($row->nama)));
				}
				echo $nama."|".$row->nip_baru."|".$row->pangkat."|".$row->jabatan."|".$row->kantor.
				"|".$row->golongan."|".$row->masa_kerja."|".$gapok_lama."|".$row->no_sk."|".date('d-m-Y', strtotime($row->tanggal_sk)).
				"|".$row->pejabat_penetapan."|".date('d-m-Y', strtotime($row->tmt_kgb))."|".date('d-m-Y', strtotime($row->tmt_kp))."|".$row->id_pegawai."\n";
			}
		}
		
	}
	//AUTOCOMPLETE
	function auto_tandatangan(){
		extract($_POST); 
		
		if($jabatan_ttd){
			$this->db->where('b.id_jabatan', $jabatan_ttd);
			$where = "(a.nama like '%".$q."%' OR a.nip_baru like '%".$q."%')";
			$this->db->select("a.nip_baru, a.nama")
					->from("pegawai a")
					->join('pegawai_jabatan b','a.id=b.id_pegawai','LEFT')
					->where('a.status','aktif')
					->where($where);
			$this->db->order_by('a.nama', 'ASC');
			$this->db->limit(10);
			$q_part=$this->db->get();
			$count = $this->db->count_all_results();
			if ($count>0){
				foreach($q_part->result() as $row){
					if(!empty($row->gelar_belakang)){
						$nama = $row->gelar_depan.' '.ucwords(strtolower($row->nama)).', '.$row->gelar_belakang;
					}else{
						$nama = trim($row->gelar_depan.' '.ucwords(strtolower($row->nama)));
					}
					
					echo $nama." |".$row->nip_baru."|".$nama."\n";
				}
			}
		}
		
	}
	
	function get_tandatangan(){
		extract($_POST); 
		
		if($jabatan_ttd){
			
			$this->db->select("a.id,a.nip_baru, a.nama, a.gelar_depan, a.gelar_belakang")
					->from("pegawai a")
					->join("pegawai_jabatan b", "a.id=b.id_pegawai")
					->where('a.status','aktif')
					->where('b.id_nama_jabatan', $jabatan_ttd);
			//$this->db->order_by('a.nama', 'ASC');
			$this->db->limit(1);
			$q_part=$this->db->get();
			$count = $q_part->num_rows();
			//echo $count;
			if ($count>0){
				$row = $q_part->row();
				$nama = ucwords(strtolower($row->nama));
				if(!empty($row->gelar_depan)){
					$nama = $row->gelar_depan.' '.ucwords(strtolower($row->nama));
				}
				
				if(!empty($row->gelar_belakang)){
					$nama = $nama.', '.$row->gelar_belakang;
				}
				
				echo $row->nip_baru."|".$nama."|".$row->id."\n";
				
			}else{
				echo '';
			}
		}
		
	}
	
	public function insert()
	{
		extract($_POST); 
		$user_input = $this->session->userdata('user_id');
		$return = 'error';
		if ($nip_baru != '') {
		$data = array(
				//'nip_baru'				=> $nip_baru,
				//'nama'					=> $nama,
				'id_pegawai'			=> $id_pegawai,
				'pangkat'			  	=> $pangkat,
				'jabatan'				=> $jabatan,
				'kantor'				=> $kantor,
				'gapok_lama'	 		=> number_format_db($gapok_lama),
				'pejabat_penetapan'  	=> $pejabat_penetapan,
				'tanggal_sk'		 	=> date('Y-m-d', strtotime($tanggal_sk)),
				'no_sk'					=> $no_sk,
				'masa_kerja_gol'		=> $masa_kerja_gol_tahun.' Thn '.$masa_kerja_gol_bulan.' Bln',
				'masa_kerja_gol_thn'	=> $masa_kerja_gol_tahun,
				'masa_kerja_gol_bln'	=> $masa_kerja_gol_bulan,				
				'tmt_sebelumnya'		=> date('Y-m-d', strtotime($tanggal_berlaku)),
				'gapok_baru'			=> number_format_db($gapok_baru),
				'masa_kerja'			=> $new_masa_kerja_tahun.' Thn '.$new_masa_kerja_bulan.' Bln',
				'masa_kerja_thn'		=> $new_masa_kerja_tahun,
				'masa_kerja_bln'		=> $new_masa_kerja_bulan,
				'golongan'			 	=> $golongan,
				'tmt_kgb'  	=> date('Y-m-d', strtotime($tanggal_berlaku2)),
				'no_surat'				=> $no_surat,
				'kepada'				=> $kepada,
				'jabatan_ttd'			=> $jabatan_ttd,
				'id_ttd'				=> $id_ttd,
				'daper'					=> $dasar_peraturan,
				'tembusan'				=> $tembusan,
				'tmt_gol'				=> $tmt_gol
			);
			
			$id_kgp = $this->kgp_model->insert_kgp($data);
			if($id_kgp){
				//Update KGB dokumen
				$document = $this->kgp_model->get_dokumen($id_pegawai);
				foreach($document as $doc){
					
					$data_doc = array(
						'id_kgp'				=> $id_kgp,
						'nama_dokumen'			=> $doc->nama_dokumen,
						'filename'				=> $doc->filename,
						'id_tipe_dokumen'		=> $doc->id_tipe_dokumen			
					);
					if(!empty($doc->filename)){
						$this->kgp_model->insert_kgp_dokumen($data_doc, $id_kgp, $doc->id_tipe_dokumen);
					}
				}
				
				$masa_kerja_golongan = '';
				if(!empty($new_masa_kerja_tahun)){
					$masa_kerja_golongan = $new_masa_kerja_tahun.' Thn '.$new_masa_kerja_bulan.' Bln';
				}
				
				//Update pegawai_kepegawaian
				$data_kep = array(
					'gol_terakhir' => $golongan,
					'tmt_kgb_terakhir' => date('Y-m-d', strtotime($tanggal_berlaku2)),
					//'masa_kerja_golongan' => $masa_kerja_golongan,
					'masa_kerja_tahun' => $new_masa_kerja_tahun,
					'masa_kerja_bulan' => $new_masa_kerja_bulan,
					'gapok_terakhir'	=> number_format_db($gapok_baru),
					'updated_date' => date('Y-m-d H:i:s'),
					'updated_by' => $user_input
				);
				$this->kgp_model->cek_kepegawaian($data_kep, $id_pegawai);
				
				$return = 'success';
			}
		}
		echo $return;
	}
	
	public function update()
	{
		extract($_POST); 
		$user_input = $this->session->userdata('user_id');
		$return = 'error';
		
		if ($nip_baru != '') {
			$data = array(
				'gapok_lama'	 		=> number_format_db($gapok_lama),
				'pejabat_penetapan'  	=> $pejabat_penetapan,
				'tanggal_sk'		 	=> date('Y-m-d', strtotime($tanggal_sk)),
				'no_sk'					=> $no_sk,
				'masa_kerja_gol'		=> $masa_kerja_gol_tahun.' Thn '.$masa_kerja_gol_bulan.' Bln',
				'masa_kerja_gol_thn'	=> $masa_kerja_gol_tahun,
				'masa_kerja_gol_bln'	=> $masa_kerja_gol_bulan,				
				'tmt_sebelumnya'		=> date('Y-m-d', strtotime($tanggal_berlaku)),
				'gapok_baru'			=> number_format_db($gapok_baru),
				'masa_kerja'			=> $new_masa_kerja_tahun.' Thn '.$new_masa_kerja_bulan.' Bln',
				'masa_kerja_thn'		=> $new_masa_kerja_tahun,
				'masa_kerja_bln'		=> $new_masa_kerja_bulan,
				'golongan'			 	=> $golongan,
				'tmt_kgb'  				=> date('Y-m-d', strtotime($tanggal_berlaku2)),
				'no_surat'				=> $no_surat,
				'kepada'				=> $kepada,
				'jabatan_ttd'			=> $jabatan_ttd,
				'id_ttd'				=> $id_ttd,
				'daper'					=> $dasar_peraturan,
				'tembusan'				=> $tembusan,
				'tmt_gol'				=> $tmt_gol
			);
			
			$do_kgp = $this->kgp_model->update_kgp($data, $id);
			if($do_kgp){
				$id_kgp = $id;
				//Update dokumen
				$this->kgp_model->del_kgp_dokumen_bykgp($id_kgp);
				$document = $this->kgp_model->get_dokumen($id_pegawai);
				foreach($document as $doc){
					
					$data_doc = array(
						'id_kgp'				=> $id_kgp,
						'nama_dokumen'			=> $doc->nama_dokumen,
						'filename'				=> $doc->filename,
						'id_tipe_dokumen'		=> $doc->id_tipe_dokumen			
					);
					if(!empty($doc->filename)){
						$this->kgp_model->insert_kgp_dokumen($data_doc, $id_kgp, $doc->id_tipe_dokumen);
					}
				}
				
				$masa_kerja_golongan = '';
				if(!empty($new_masa_kerja_tahun)){
					$masa_kerja_golongan = $new_masa_kerja_tahun.' Thn '.$new_masa_kerja_bulan.' Bln';
				}
				
				//Update pegawai_kepegawaian
				$data_kep = array(
					'gol_terakhir' => $golongan,
					'tmt_kgb_terakhir' => date('Y-m-d', strtotime($tanggal_berlaku2)),
					//'masa_kerja_golongan' => $masa_kerja_golongan,
					'masa_kerja_tahun' => $new_masa_kerja_tahun,
					'masa_kerja_bulan' => $new_masa_kerja_bulan,
					'gapok_terakhir'	=> number_format_db($gapok_baru),
					'updated_date' => date('Y-m-d H:i:s'),
					'updated_by' => $user_input
				);
				$this->kgp_model->cek_kepegawaian($data_kep, $id_pegawai);
				
				$return = 'success';
			}
		}
		echo $return;
	}
	
	public function listprocessed()
	{
		$this->data['title'] = 'List Kenaikan Gaji Pegawai';
		$this->load->view('kgp/list_kgp', $this->data);
	}
	
	//==== Riwayat Dokumen ====
	function ajax_rdokumen()
    {
		$action = $this->uri->segment(3);
		
		$id_pegawai = $this->input->post('id_pegawai');
        $result = $this->kgp_model->get_dokumen($id_pegawai);
		$json["aaData"] = array();
		
		$retval = array(
			"aaData" => array()
		);
		$i = 1;
		//print_r($result);die;
		if($result){
			foreach($result as $row)
			{
				$filename = str_replace("C:\\fakepath\\","", $row->filename);
				
				$cek_file = '<ul class="table-controls">';
				if(empty($filename)){
					$cek_file .= '<li><i class="fam-cancel"></i></li>';
					$option = '<span id="edit-rdokumen" onclick="javascript:onAddrdokumen('.$row->id_tipe_dokumen.',\''.$row->tipe_dokumen.'\')" class="fam-add"></span>';
				}else{
					$cek_file .= '<li><i class="fam-accept"></i></li>';		
					$option = '<span id="edit-rdokumen" onclick="javascript:onEditrdokumen('.$row->id_tipe_dokumen.',\''.$row->tipe_dokumen.'\',\''.$row->id.'\')" class="fam-application-edit"></span>';
				}			
				$cek_file .= '</ul>';
				
				
				array_push($json["aaData"],array(
					$i,
					$row->tipe_dokumen,
					$cek_file,
					$option
				));
				$i++;
			}
		}
		
        header("Content-type: application/json");
        echo json_encode($json);
    }
	function auto_golongan(){
		extract($_POST);
		
		$where = "(a.kode_golongan like '%".$q."%')";
		$this->db->select('a.*')
				->from('m_golongan as a', false)
				->where($where);
		$this->db->order_by('a.kode_golongan', 'ASC');
		$this->db->limit(10);
		$q_part=$this->db->get();
		$count = $this->db->count_all_results();
		if ($count>0){
			foreach($q_part->result() as $row){
				$kdkelgapok = $row->kdkelgapok;
				
				echo $row->kode_golongan."|".$row->kdkelgapok."\n";
			}
		}
		
		//echo getgolongan('IV/a');
		//extract($_POST); 
		//
		//$gol = getgolongan('III/a');
		//$this->db->select("b.gol_terakhir as kdkelgapok")
		//		->from("m_gapok a")
		//		->join("pegawai_kepegawaian b","a.kdkelgapok = b.gol_terakhir", "LEFT")
		//		->where("kdkelgapok = $gol");
		//$query = $this->db->get();
		//foreach($query->result() as $row){
		//	
		//	echo "<pre>";
		//	print_r($row->gapok);
		//	echo "</pre>";
		//}
		
	}
	
	/*function cek_gol_baru(){
		$kdkelgapok =  $this->input->post('golongan');
		$kdgapok = $this->input->post('kdkelgapok');
		$this->db->select("*");
		$this->db->from('m_gapok');
		if($kdgapok){
			$this->db->where('kdgapok',$kdgapok);
		}
		if($kdkelgapok){
			$this->db->where('kdkelgapok',$kdkelgapok);
		}
		$data = $this->db->get();
		$kirim = "<option data-gapok=' ' value='0'>- Pilih Dasar Peraturan -</option>";
		foreach($data->result() as $d){
			$gapok = number_format_nr($d->gapok);
			if(!empty($d->daper)){
				$kirim .= "<option data-gapok='$gapok' value='$d->id_gapok'>$d->daper</option>";
			}
		}
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($kirim));
	}*/
	
	function cek_gol_baru(){
		$kdkelgapok =  $this->input->post('golongan');
		$kdgapok = $this->input->post('kdkelgapok');
		$this->db->select("*");
		$this->db->from('m_gapok');
		if($kdgapok){
			$this->db->where('kdgapok',$kdgapok);
		}
		if($kdkelgapok){
			$this->db->where('kdkelgapok',$kdkelgapok);
		}
		$data = $this->db->get();
		$kirim = "<option data-gapok=' ' value='0'>- Pilih Dasar Peraturan -</option>";
		foreach($data->result() as $d){
			$gapok = number_format_nr($d->gapok);
			if(!empty($d->daper)){
				$kirim .= '<option value="'.$d->id_gapok.'#'.$gapok.'#'.$d->daper.'">'.$d->daper.'</option>';
			}
		}
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($kirim));
	}
	
	function auto_tahun(){
		extract($_POST); 
		
		$where = "(a.kdgapok like '%".$q."%')";
		$this->db->select('a.*')
				->from('m_gapok as a', false)
				->where($where);
		$this->db->order_by('a.kdgapok', 'ASC');
		$this->db->limit(1);
		$q_part=$this->db->get();
		$count = $this->db->count_all_results();
		if ($count>0){
			foreach($q_part->result() as $row){
					echo $row->kdgapok."\n";
			}
		}
		
		
	}
	/*
	function cek_tmt_baru(){
		$kdgapok = $this->input->post('kdgapok');
		$kdkelgapok = $this->input->post('kdkelgapok');
		
		$this->db->select("*");
		$this->db->from('m_gapok');
		if($kdgapok){
			$this->db->where('kdgapok',$kdgapok);	
		}
		if($kdkelgapok){
			$this->db->where('kdkelgapok',$kdkelgapok);
		}
		$data = $this->db->get();
		$kirim = "<option data-gapok='' value=''>- Pilih Dasar Peraturan -</option>";
		foreach($data->result() as $d){
			$gapok = number_format_nr($d->gapok);
			if(!empty($d->daper)){
				$kirim .= "<option data-gapok='$gapok' value='$d->id_gapok'>$d->daper</option>";
			}
		}
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($kirim));
	}
	*/
	function cek_tmt_baru(){
		$kdgapok = $this->input->post('kdgapok');
		$kdkelgapok = $this->input->post('kdkelgapok');
		
		$this->db->select("*");
		$this->db->from('m_gapok');
		if($kdgapok){
			$this->db->where('kdgapok',$kdgapok);	
		}
		if($kdkelgapok){
			$this->db->where('kdkelgapok',$kdkelgapok);
		}
		$data = $this->db->get();
		$kirim = "<option data-gapok='' value=''>- Pilih Dasar Peraturan -</option>";
		foreach($data->result() as $d){
			$gapok = number_format_nr($d->gapok);
			if(!empty($d->daper)){
				$kirim .= '<option value="'.$d->id_gapok.'#'.$gapok.'#'.$d->daper.'">'.$d->daper.'</option>';
			}
		}
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($kirim));
	}
//	function set_gol($id,$select = 0){
//		$send = '';
//		
//		if(!empty($id)){
//			$output = $this->kgp_model->get_gol()->result();
//			
//			foreach($output as $row){
//				$for_gapok = number_format_nr($row->gapok);
//				
//				if($id){
//					$send .= "<option data-gapok='$for_gapok' value='$row->id_gapok'>$row->daper</option>";
//				}
//			}
//			
//		}
//		return $send;
//	}
//	
//	function get_gol($select = 0){
//		$id = $this->uri->segment(3);
//		
//		$this->output
//            ->set_content_type('application/json')
//            ->set_output(json_encode($this->set_gol($id, $select)));
//	}
	
}