<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Angkakredit_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	
	function get_all() {
		
		$this->db->select("a.*, b.nama_jabatan, c.nama_golongan, c.kode_golongan, 
				b2.nama_jabatan as rencana_nama_jabatan, c2.nama_golongan as rencana_nama_golongan, 
				c2.kode_golongan as rencana_kode_golongan, 
				d.nama_unit_kerja,
				e.nama, e.nip_baru")
				->from('angkakredit as a')
				->join('m_jabatan as b','a.id_jabatan = b.id_jabatan','LEFT')
				->join('m_golongan as c','a.id_golongan = c.id_golongan','LEFT')
				
				->join('m_jabatan as b2','a.id_jabatan = b2.id_jabatan','LEFT')
				->join('m_golongan as c2','a.id_golongan = c2.id_golongan','LEFT')
				
				->join('m_unit_kerja as d','a.unit_kerja = d.kode_unit_kerja','LEFT')
				->join('pegawai as e','e.id = a.id_pegawai','LEFT');
		$this->db->where('is_deleted', 0);
		$this->db->order_by('created_date', 'DESC');
		$query = $this->db->get();

		return $query->result_array();
	}
	
	function get_angkakredit($id_angkakredit='')
	{
		$this->db->select('a.*, b.nama_jabatan, c.nama_golongan, c.kode_golongan, d.nama_unit_kerja, 
		e.gelar_depan as gelar_depan_pejabat_mengetahui, 
		e.gelar_belakang as gelar_belakang_pejabat_mengetahui, 
		e.nama as nama_pejabat_mengetahui, 
		e2.gelar_depan as gelar_depan_pejabat_penyelenggara,
		e2.gelar_belakang as gelar_belakang_pejabat_penyelenggara,
		e2.nama as nama_pejabat_penyelenggara, 
		e3.gelar_depan as gelar_depan_pejabat_penetapan,
		e3.gelar_belakang as gelar_belakang_pejabat_penetapan,
		e3.nama as nama_pejabat_penetapan, 
		f.nilai_ak')
				->from('angkakredit as a')
				->join('m_jabatan as b','a.id_jabatan = b.id_jabatan',"LEFT")
				->join('m_golongan as c','a.id_golongan = c.id_golongan',"LEFT")
				->join('m_unit_kerja as d','a.unit_kerja = d.kode_unit_kerja',"LEFT")
				->join('pegawai as e','a.pejabat_mengetahui = e.nip_baru',"LEFT")
				->join('pegawai as e2','a.pejabat_penyelenggara = e2.nip_baru',"LEFT")
				->join('pegawai as e3','a.pejabat_penetapan = e3.nip_baru',"LEFT")
				->join('m_prasarat_angkakredit as f','a.id_prasyarat = f.id_ak',"LEFT");
		
				
		if($id_angkakredit){
			$this->db->where('id_angkakredit', $id_angkakredit);
		}
		$query = $this->db->get();
			
		if ($query->num_rows() > 0) {
			if($id_angkakredit){
				return $query->row();
			}else{
				return $query->result_array();
			}
		}else{
			return '';
		}
	}
	
	function get_angkakredit_detail($id_angkakredit)
	{
		$this->db->select('a.*, b.nip_baru, b.tanggal_lahir, b.agama')
			->from('angkakredit_detail as a')
			->join('pegawai as b','a.calon_nip = b.nip_baru');
			
		if($id_angkakredit){
			$this->db->where('a.id_angkakredit', $id_angkakredit);
		}
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
			
		}else{
			return '';
		}
	
	}
	
	function get_angkakredit_detail_byID($id_angkakredit_detail)
	{
		$this->db->where('id', $id_angkakredit_detail);
		$query = $this->db->get('angkakredit_detail');

		if ($query->num_rows() > 0) {
			return $query->row_array();
			
		}else{
			return '';
		}
	
	}
	
	
	public function ddl_unit_kerja()
	{
		// id, nama_unit_kerja, eselon, parent_unit, level
		$this->db->order_by('kode_unit_kerja','ASC');
		$query = $this->db->get('m_unit_kerja');
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return '';
		}
	}
	
	public function ddl_jabatan($id = '')
	{
		if(!empty($id)){
			$this->db->where('id_jabatan', $id);
		}
		$this->db->where('id_status_jabatan','2');
		$this->db->where('use_pak','1');
		$this->db->order_by('id_jabatan','ASC');
		$query = $this->db->get('m_jabatan');
		
		if ($query->num_rows() > 0) {
			if(!empty($id)){
				return $query->row();
			}else{
				return $query->result();
			}
		}else{
			return '';
		}
	}
	
	public function insert_angkakredit($data)
	{
		$this->db->trans_start();
		//insert to master
		$this->db->insert('angkakredit', $data);
		$id = $this->db->insert_id();
		
		//commit
		$this->db->trans_complete();
		
		return (isset($id)) ? $id : FALSE;
	}
	
	function update_angkakredit($data, $id)
	{
		$this->db->trans_start();

		$this->db->where('id_angkakredit', $id);
		$update = $this->db->update('angkakredit', $data, false);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($update)) ? TRUE : FALSE;
	}
	
	public function insert_angkakredit_detail($data)
	{
		$this->db->trans_start();
		//insert
		$this->db->insert('angkakredit_detail', $data);
		$id = $this->db->insert_id();
		
		//commit
		$this->db->trans_complete();
		
		return (isset($id)) ? $id : FALSE;
	}
	
	function update_angkakredit_detail($data, $id)
	{
		$this->db->trans_start();

		$this->db->where('id_ak_detail', $id);
		$update = $this->db->update('angkakredit_detail', $data);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($update)) ? TRUE : FALSE;
	}
	
	public function ddl_unsurklasifikasi($id_unsur = '')
	{
		if(!empty($id_unsur)){
			$this->db->where('id_unsur', $id_unsur);
		}

		$this->db->order_by('skor','DESC');
		$query = $this->db->get('m_unsur_klasifikasi');
		
		if ($query->num_rows() > 0) {
			return $query->result();
			
		}else{
			return '';
		}
	}
	
	public function do_delete_angkakredit($id)
	{
		$this->db->trans_start();
		
		
		//$delete = $this->db->delete('angkakredit');
		$update_delete = array(
			'is_deleted' => 1
		);
		
		$this->db->where('id_angkakredit', $id);
		$delete = $this->db->update('angkakredit', $update_delete);
		
		//commit
		$this->db->trans_complete();
		
		return (isset($delete)) ? TRUE : FALSE;
	}
	
	public function delete_angkakredit_detail($id)
	{
		$this->db->trans_start();
		
		$this->db->where('id', $id);
		$delete = $this->db->delete('angkakredit_detail');
		
		//commit
		$this->db->trans_complete();
		
		return (isset($delete)) ? TRUE : FALSE;
	}
	
	public function data_step2($id_angkakredit, $id_jabatan_selected=''){
	
		$data_kategori = array();
		$this->db->select('DISTINCT (kategori_uk)', false)
				->from('m_unsur_kegiatan');								
		$dt_kategori_uk = $this->db->get();
		if ($dt_kategori_uk->num_rows() > 0) {
			$no = 1;
			foreach($dt_kategori_uk->result() as $kat){
				$data_kategori[$kat->kategori_uk] = $no;
				$no++;
			}
		}
		
		
		$data_step2 = array();
		$nilai_ak = array();
		$nilai_uk = array();
		$total_id_uk = array();
		$all_total = 0;
		if(!empty($data_kategori)){
			if(!empty($id_jabatan_selected)){
				$this->db->where('id_jabatan_selected', $id_jabatan_selected);
			}
			$this->db->where('id_angkakredit', $id_angkakredit);
			$this->db->from('angkakredit_detail');
			$angkakredit_detail = $this->db->get();
			if ($angkakredit_detail->num_rows() > 0) {
				foreach($angkakredit_detail->result() as $detail){
					
					//get kategori no
					if(!empty($data_kategori[$detail->kategori_uk])){
						$detail->kategori_uk = $data_kategori[$detail->kategori_uk];
					}
					
					//nilai_ak --------------------------------------
					//set data per-kategori_uk
					if(empty($nilai_ak[$detail->kategori_uk])){
						$nilai_ak[$detail->kategori_uk] = array();
					}
					
					//set data per-id_uk
					if(empty($nilai_ak[$detail->kategori_uk][$detail->id_uk])){
						$nilai_ak[$detail->kategori_uk][$detail->id_uk] = array();
					}					
					$nilai_ak[$detail->kategori_uk][$detail->id_uk][$detail->id_jabatan_selected][$detail->id_sub_uk] = $detail->nilai_ak;
					
					//nilai_uk --------------------------------------
					//set data per-kategori_uk
					if(empty($nilai_uk[$detail->kategori_uk])){
						$nilai_uk[$detail->kategori_uk] = array();
					}
					
					//set data per-id_uk
					if(empty($nilai_uk[$detail->kategori_uk][$detail->id_uk])){
						$nilai_uk[$detail->kategori_uk][$detail->id_uk] = array();
					}					
					$nilai_uk[$detail->kategori_uk][$detail->id_uk][$detail->id_jabatan_selected][$detail->id_sub_uk] = $detail->nilai_uk;
								
					//pengali_persen --------------------------------------
					//set data per-kategori_uk
					if(empty($pengali_persen[$detail->kategori_uk])){
						$pengali_persen[$detail->kategori_uk] = array();
					}
					
					if(empty($pengali_persen[$detail->kategori_uk][$detail->id_uk])){
						$pengali_persen[$detail->kategori_uk][$detail->id_uk] = array();
					}					
					$pengali_persen[$detail->kategori_uk][$detail->id_uk][$detail->id_jabatan_selected][$detail->id_sub_uk] = $detail->pengali_persen;
								
					//satuan_bagi --------------------------------------
					//set data satuan_bagi
					if(empty($satuan_bagi[$detail->kategori_uk])){
						$satuan_bagi[$detail->kategori_uk] = array();
					}
					
					if(empty($satuan_bagi[$detail->kategori_uk][$detail->id_uk])){
						$satuan_bagi[$detail->kategori_uk][$detail->id_uk] = array();
					}					
					$satuan_bagi[$detail->kategori_uk][$detail->id_uk][$detail->id_jabatan_selected][$detail->id_sub_uk] = $detail->satuan_bagi;
								
								
								
					//$total_id_uk
					if(empty($total_id_uk[$detail->kategori_uk])){
						$total_id_uk[$detail->kategori_uk] = array();
					}
					
					if(empty($total_id_uk[$detail->kategori_uk][$detail->id_uk])){
						$total_id_uk[$detail->kategori_uk][$detail->id_uk] = 0;
					}					
					$total_id_uk[$detail->kategori_uk][$detail->id_uk] += $detail->nilai_total;
					
					//$total_kategori
					if(empty($total_kategori[$detail->kategori_uk])){
						$total_kategori[$detail->kategori_uk] = 0;
					}					
					$total_kategori[$detail->kategori_uk] += $detail->nilai_total;
										
					$all_total += $detail->nilai_total;
				}
				
			}
		}
		
		if(!empty($nilai_ak)){
			$data_step2['nilai_ak'] = $nilai_ak;
		}
		if(!empty($nilai_uk)){
			$data_step2['nilai_uk'] = $nilai_uk;
		}
		if(!empty($pengali_persen)){
			$data_step2['pengali_persen'] = $pengali_persen;
		}
		if(!empty($satuan_bagi)){
			$data_step2['satuan_bagi'] = $satuan_bagi;
		}
		if(!empty($total_id_uk)){
			$data_step2['total_id_uk'] = $total_id_uk;
		}
		if(!empty($total_kategori)){
			$data_step2['total_kategori'] = $total_kategori;
		}
		if(!empty($all_total)){
			$data_step2['all_total'] = $all_total;
		}
		
		return $data_step2;
	}
	
	public function data_step3($id_angkakredit){
		$data_kategori = array();
		$this->db->select('DISTINCT (kategori_uk)', false)
				->from('m_unsur_kegiatan');								
		$dt_kategori_uk = $this->db->get();
		if ($dt_kategori_uk->num_rows() > 0) {
			$no = 1;
			foreach($dt_kategori_uk->result() as $kat){
				$data_kategori[$kat->kategori_uk] = $no;
				$no++;
			}
		}
		
		$data_step3 = array();
		$total_detail = array();
		$total_pertimbangan = array();
		$persetujuan = array();
		$keterangan = array();
		
		if(!empty($data_kategori)){
			$this->db->where('id_angkakredit', $id_angkakredit);
			$this->db->from('angkakredit_pertimbangan');
			$angkakredit_pertimbangan = $this->db->get();
			if ($angkakredit_pertimbangan->num_rows() > 0) {
				foreach($angkakredit_pertimbangan->result() as $pertimbangan){
										
					//get kategori no
					if(!empty($data_kategori[$pertimbangan->kategori_uk])){
						$pertimbangan->kategori_uk = $data_kategori[$pertimbangan->kategori_uk];
					}
					
					//$total_detail
					if(empty($total_detail[$pertimbangan->kategori_uk])){
						$total_detail[$pertimbangan->kategori_uk] = array();
					}					
					$total_detail[$pertimbangan->kategori_uk][$pertimbangan->id_uk] = $pertimbangan->total_detail;
					
					//$total_pertimbangan
					if(empty($total_pertimbangan[$pertimbangan->kategori_uk])){
						$total_pertimbangan[$pertimbangan->kategori_uk] = array();
					}								
					$total_pertimbangan[$pertimbangan->kategori_uk][$pertimbangan->id_uk] = $pertimbangan->total_pertimbangan;
					
					//$persetujuan
					if(empty($persetujuan[$pertimbangan->kategori_uk])){
						$persetujuan[$pertimbangan->kategori_uk] = array();
					}								
					$persetujuan[$pertimbangan->kategori_uk][$pertimbangan->id_uk] = $pertimbangan->persetujuan;
					
					//$keterangan
					if(empty($keterangan[$pertimbangan->kategori_uk])){
						$keterangan[$pertimbangan->kategori_uk] = array();
					}								
					$keterangan[$pertimbangan->kategori_uk][$pertimbangan->id_uk] = $pertimbangan->keterangan;
					
				}
			}
		}
		
		if(!empty($total_detail)){
			$data_step3['total_detail'] = $total_detail;
		}
		if(!empty($total_pertimbangan)){
			$data_step3['total_pertimbangan'] = $total_pertimbangan;
		}
		if(!empty($persetujuan)){
			$data_step3['persetujuan'] = $persetujuan;
		}
		if(!empty($keterangan)){
			$data_step3['keterangan'] = $keterangan;
		}
		
		return $data_step3;
	}
	
	public function data_step4($id_angkakredit){
		
		$data_kategori = array();
		$this->db->select('DISTINCT (kategori_uk)', false)
				->from('m_unsur_kegiatan');								
		$dt_kategori_uk = $this->db->get();
		if ($dt_kategori_uk->num_rows() > 0) {
			$no = 1;
			foreach($dt_kategori_uk->result() as $kat){
				$data_kategori[$kat->kategori_uk] = $no;
				$no++;
			}
		}
		
		$data_step4 = array();
		$total_ak_baru = array();
		$total_ak_lama = array();
		$jumlah = array();
		
		if(!empty($data_kategori)){
			$this->db->where('id_angkakredit', $id_angkakredit);
			$this->db->from('angkakredit_penetapan');
			$angkakredit_penetapan = $this->db->get();
			if ($angkakredit_penetapan->num_rows() > 0) {
				foreach($angkakredit_penetapan->result() as $penetapan){
										
					//get kategori no
					if(!empty($data_kategori[$penetapan->kategori_uk])){
						$penetapan->kategori_uk = $data_kategori[$penetapan->kategori_uk];
					}
					
					//$total_ak_baru
					if(empty($total_ak_baru[$penetapan->kategori_uk])){
						$total_ak_baru[$penetapan->kategori_uk] = array();
					}					
					$total_ak_baru[$penetapan->kategori_uk][$penetapan->id_uk] = $penetapan->total_ak_baru;
					
					//$total_ak_lama
					if(empty($total_ak_lama[$penetapan->kategori_uk])){
						$total_ak_lama[$penetapan->kategori_uk] = array();
					}					
					$total_ak_lama[$penetapan->kategori_uk][$penetapan->id_uk] = $penetapan->total_ak_lama;
					
					//$jumlah
					if(empty($jumlah[$penetapan->kategori_uk])){
						$jumlah[$penetapan->kategori_uk] = array();
					}					
					$jumlah[$penetapan->kategori_uk][$penetapan->id_uk] = $penetapan->jumlah;
					
					//$id_penetapan
					if(empty($id_penetapan[$penetapan->kategori_uk])){
						$id_penetapan[$penetapan->kategori_uk] = array();
					}					
					$id_penetapan[$penetapan->kategori_uk][$penetapan->id_uk] = $penetapan->id_penetapan;
					
					
				}
			}
		}
		
		if(!empty($total_ak_baru)){
			$data_step4['total_ak_baru'] = $total_ak_baru;
		}
		
		if(!empty($total_ak_lama)){
			$data_step4['total_ak_lama'] = $total_ak_lama;
		}
		
		if(!empty($jumlah)){
			$data_step4['jumlah'] = $jumlah;
		}
		
		if(!empty($id_penetapan)){
			$data_step4['id_penetapan'] = $id_penetapan;
		}
		
		//PAK lama - angkakredit = id_angkakredit_lama
		$dt_angkakredit_lama = '';
		$nilai_penetapan = 0;
		$nilai_penetapan_lama = 0;
		$id_jabatan = 0;
		$id_golongan = 0;
		$this->db->select('a.id_jabatan, a.id_golongan, a.nilai_penetapan, 
		a.id_prasyarat, a.rencana_id_jabatan, a.rencana_id_golongan,
		b.no_pak, b.nilai_penetapan as nilai_penetapan_lama, 
		b.tanggal_pak as tanggal_pak_lama,
		c.nama_jabatan,
		d.kode_golongan, d.nama_golongan');		
		$this->db->from('angkakredit as a');		
		$this->db->join('angkakredit as b',"b.id_angkakredit = a.id_angkakredit_lama","LEFT");
		$this->db->join('m_jabatan as c',"c.id_jabatan = a.rencana_id_jabatan","LEFT");
		$this->db->join('m_golongan as d',"d.id_golongan = a.rencana_id_golongan","LEFT");
		$this->db->where('a.id_angkakredit', $id_angkakredit);
		$get_angkakredit_lama = $this->db->get();
		if ($get_angkakredit_lama->num_rows() > 0) {
			$dt_angkakredit_lama = $get_angkakredit_lama->row();
			$angkakredit_lama = array(
				'no_pak' =>	$dt_angkakredit_lama->no_pak,
				'tanggal_pak' =>	$dt_angkakredit_lama->tanggal_pak_lama,
				'nilai_penetapan' =>	$dt_angkakredit_lama->nilai_penetapan_lama
			);
			
			if(empty($dt_angkakredit_lama->nilai_penetapan)){
				$dt_angkakredit_lama->nilai_penetapan = 0;
			}
			if(empty($dt_angkakredit_lama->nilai_penetapan_lama)){
				$dt_angkakredit_lama->nilai_penetapan_lama = 0;
			}

			$nilai_penetapan = $dt_angkakredit_lama->nilai_penetapan;
			$nilai_penetapan_lama = $dt_angkakredit_lama->nilai_penetapan_lama;
			$id_jabatan = $dt_angkakredit_lama->id_jabatan;
			$id_golongan = $dt_angkakredit_lama->id_golongan;
			
			$get_jabatan_selanjutnya = $dt_angkakredit_lama->rencana_id_jabatan;
			$get_nama_jabatan_selanjutnya = $dt_angkakredit_lama->nama_jabatan;
			$get_golongan_selanjutnya = $dt_angkakredit_lama->rencana_id_golongan;
			$get_nama_golongan_selanjutnya = $dt_angkakredit_lama->nama_golongan.' '.$dt_angkakredit_lama->kode_golongan;
		
			//print_r($dt_angkakredit_lama);
		}		
		$data_step4['dt_angkakredit_lama'] = $angkakredit_lama;
		
		//hasil penetapan - m_prasarat_angkakredit
		//get all prasyarat
		$get_nilai_jabatan_skrg = 0;	
		$get_prasyarat_selanjutnya = array();
		$get_nilai_ak_selanjutnya = 0;		
		//$get_jabatan_selanjutnya = $rencana_id_jabatan;	
		//$get_nama_jabatan_selanjutnya = 0;	
		//$get_golongan_selanjutnya = $rencana_id_golongan;	
		//$get_nama_golongan_selanjutnya = 0;	
		$dt_prasyarat = array();
		
		
		
		// SMART CHECK JABATAN SELANJUTNYA
		$this->db->select("a.*, b.nama_jabatan, 
		c.kode_golongan, c.nama_golongan, c.kdkelgapok, c.level");		
		$this->db->from('m_prasarat_angkakredit as a');		
		$this->db->join('m_jabatan as b',"b.id_jabatan = a.id_jabatan","LEFT");
		$this->db->join('m_golongan as c',"c.id_golongan = a.id_golongan","LEFT");
		$this->db->order_by('a.nilai_ak', 'ASC');
		$this->db->order_by('a.id_jabatan', 'ASC');
		$this->db->order_by('a.id_golongan', 'ASC');
		$get_all_prasyarat = $this->db->get();	
		if ($get_all_prasyarat->num_rows() > 0) {
			foreach($get_all_prasyarat->result() as $dt){
				$dt_prasyarat[$dt->id_jabatan.'_'.$dt->id_golongan] = $dt->nilai_ak;
				
				if($dt->id_jabatan == $id_jabatan AND $dt->id_golongan == $id_golongan){
					$get_nilai_jabatan_skrg = $dt->nilai_ak;	
				}
				
				if($dt->id_jabatan == $get_jabatan_selanjutnya AND $dt->id_golongan == $get_golongan_selanjutnya){
					$get_nilai_ak_selanjutnya = $dt->nilai_ak;	
					
					
				}
				
				/*if($dt->nilai_ak > $get_nilai_jabatan_skrg AND !empty($get_nilai_jabatan_skrg)){
				
					if(empty($get_nilai_ak_selanjutnya)){
						$get_nilai_ak_selanjutnya = $dt->nilai_ak;
					}					
					
					//if(empty($get_jabatan_selanjutnya)){
					//	if($dt->id_jabatan == $id_jabatan){
					//		$get_jabatan_selanjutnya = $dt->id_jabatan;
					//		$get_nama_jabatan_selanjutnya = $dt->nama_jabatan;
					//	}
					//}
					
					//if(!empty($get_jabatan_selanjutnya) AND empty($get_golongan_selanjutnya)){
					//	if($dt->id_golongan != $id_golongan){
					//		$get_golongan_selanjutnya = $dt->id_golongan;
					//		$get_nama_golongan_selanjutnya = $dt->nama_golongan.' - '.$dt->kode_golongan;
					//	}
					//}
					
					if(empty($get_prasyarat_selanjutnya[$dt->nilai_ak])){
						$get_prasyarat_selanjutnya[$dt->nilai_ak] = array();
					}
					$get_prasyarat_selanjutnya[$dt->nilai_ak][$dt->id_jabatan.'_'.$dt->id_golongan] = array(
						'id_jabatan' => $dt->id_jabatan,
						'nama_jabatan' => $dt->nama_jabatan,
						'id_golongan' => $dt->id_golongan,
						'nama_golongan' => $dt->nama_golongan,
						'kode_golongan' => $dt->kode_golongan
					);
					
				}*/
				
				
			}
		}
		
		
		
		//jika get jabatan selanjutnya masih kosong	
		/*if(empty($get_jabatan_selanjutnya)){
			if(!empty($get_prasyarat_selanjutnya)){
				//first search
				foreach($get_prasyarat_selanjutnya as $nilai => $list_jabatan){
				
					if($nilai == $get_nilai_ak_selanjutnya){
											
						foreach($list_jabatan as $dt){
						
							if(empty($get_jabatan_selanjutnya)){
								if($get_nilai_jabatan_skrg < $nilai){
									$get_jabatan_selanjutnya = $dt['id_jabatan'];
									$get_nama_jabatan_selanjutnya = $dt['nama_jabatan'];
									$get_golongan_selanjutnya = $dt['id_golongan'];
									$get_nama_golongan_selanjutnya = $dt['nama_golongan'].' - '.$dt['kode_golongan'];
								}
							}
							
						}
					}
				}
				
			}
		}*/	
		
		$status_penetapan = 0;
		$hasil_penetapan = 'Belum Ada Nilai Penetapan untuk kenaikan pangkat dalam Jabatan '.$get_nama_jabatan_selanjutnya.' Pangkat '.$get_nama_golongan_selanjutnya.'';
		if(!empty($nilai_penetapan)){
			
			if($nilai_penetapan <= $get_nilai_jabatan_skrg AND !empty($get_nilai_jabatan_skrg)){
				$hasil_penetapan = 'Belum bisa diajukan untuk kenaikan pangkat dalam Jabatan '.$get_nama_jabatan_selanjutnya.' Pangkat '.$get_nama_golongan_selanjutnya.'';
				$status_penetapan = 0;
			}else{
				
				$hasil_penetapan = 'Belum bisa diajukan untuk kenaikan pangkat dalam Jabatan '.$get_nama_jabatan_selanjutnya.' Pangkat '.$get_nama_golongan_selanjutnya.'';
				$status_penetapan = 0;
				
				if($nilai_penetapan >= $get_nilai_ak_selanjutnya){
					$hasil_penetapan = 'Dapat dipertimbangkan untuk kenaikan pangkat dalam Jabatan '.$get_nama_jabatan_selanjutnya.' Pangkat '.$get_nama_golongan_selanjutnya.'';
					$status_penetapan = 1;				
				}
				
				/*$this->db->select("a.*, b.nama_jabatan, 
				c.kode_golongan, c.nama_golongan, c.kdkelgapok, c.level");		
				$this->db->from('m_prasarat_angkakredit as a');		
				$this->db->join('m_jabatan as b',"b.id_jabatan = a.id_jabatan","LEFT");
				$this->db->join('m_golongan as c',"c.id_golongan = a.id_golongan","LEFT");
				$this->db->where("a.nilai_ak > ".$get_nilai_jabatan_skrg." AND a.nilai_ak <= ".$nilai_penetapan);
				$this->db->order_by('a.nilai_ak', 'DESC');
				$get_prasyarat = $this->db->get();
				if ($get_prasyarat->num_rows() > 0) {
					$hasil_prasyarat = $get_prasyarat->row();
					
					if($get_jabatan_selanjutnya == $hasil_prasyarat->id_jabatan){
						if($get_golongan_selanjutnya == $hasil_prasyarat->id_golongan){
							$hasil_penetapan = 'Dapat dipertimbangkan untuk kenaikan pangkat dalam Jabatan <b>'.$hasil_prasyarat->nama_jabatan.'</b> Pangkat <b>'.$hasil_prasyarat->nama_golongan.' - '.$hasil_prasyarat->kode_golongan.'</b>';
							$status_penetapan = 1;
						}						
					}
					
				}*/
			}
		}
		$data_step4['hasil_penetapan'] = $hasil_penetapan;		
		$data_step4['status_penetapan'] = $status_penetapan;		
		//echo $get_nilai_ak_selanjutnya.' - '.$nilai_penetapan.' - '.$get_nilai_jabatan_skrg.' - '.$status_penetapan;
		return $data_step4;
	}
	
	public function rencana_jabatan(){ 
		
		$this->db->select('a.id_ak, a.id_jabatan, a.id_jabatan, b.nama_jabatan, c.id_golongan, c.nama_golongan, c.kode_golongan');
		$this->db->from('m_prasarat_angkakredit as a');
		$this->db->join('m_jabatan as b','b.id_jabatan = a.id_jabatan','LEFT');
		$this->db->join('m_golongan as c','c.id_golongan = a.id_golongan','LEFT');
		$this->db->order_by('a.id_ak','ASC');
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return '';
		}
	}
}