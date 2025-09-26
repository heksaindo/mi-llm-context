<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class info_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
    
    function getKgb(){
        $query = $this->db->query("
            SELECT * FROM(
            SELECT  '1' as tipe,b.nama,b.nip_baru,b.gelar_depan,b.gelar_belakang,a.jabatan,a.kantor,
            a.pangkat,a.golongan,a.masa_kerja_gol as masa_kerja,a.masa_kerja_thn as masa_kerja_tahun,
            a.masa_kerja_bln as masa_kerja_bulan,a.no_sk,a.tanggal_sk,a.pejabat_penetapan,a.tmt_kgb as tmt_kgb_terakhir
            FROM pegawai_riwayat_kgb AS a
            JOIN pegawai AS b ON a.id_pegawai = b.id
            UNION ALL
			SELECT '2' as tipe,p.nama,p.nip_baru,p.gelar_depan,p.gelar_belakang,mj.nama_jabatan AS jabatan,
				mu.nama_unit_kerja AS kantor,pkp.kepangkatan AS pangkat,
				pk.gol_terakhir AS golongan,pk.masa_kerja_golongan AS masa_kerja,
				pk.masa_kerja_tahun,pk.masa_kerja_bulan,
				pkp.no_sk,pkp.tgl_sk AS tanggal_sk,pkp.pejabat_penandatangan AS pejabat_penetapan,pk.tmt_kgb_terakhir
				FROM
				pegawai_kepegawaian AS pk
				INNER JOIN pegawai AS p ON pk.id_pegawai = p.id
				INNER JOIN pegawai_kepangkatan AS pkp ON pk.id_pegawai = pkp.id_pegawai
				INNER JOIN pegawai_jabatan AS pj ON pk.id_pegawai = pj.id_pegawai
				LEFT JOIN m_unit_kerja AS mu ON pj.kode_unit_kerja = mu.kode_unit_kerja
				LEFT JOIN m_jabatan AS mj ON pj.id_jabatan = mj.id_jabatan
				WHERE
				p.`status` = 'aktif'
				AND (
							(
								(
									DATE_ADD(
										DATE_FORMAT(
										pk.tmt_kgb_terakhir, '%Y-%m-%d'),
										INTERVAL 2 YEAR
									) <= DATE_ADD(
										DATE_FORMAT(NOW(), '%Y-%m-%d'),
										INTERVAL 3 MONTH
									)
								)
							)
							OR (
								pk.tmt_kgb_terakhir = ''
								OR pk.tmt_kgb_terakhir IS NULL
							)
                )
            ) x ORDER BY x.tmt_kgb_terakhir ASC
		");
        return $query;
    }
    
    function getPensiun(){
        /*$this->db->select('a.*,c.nip_baru as nip_ttd,c.nama as nama_ttd, b.nama,b.nip_baru as nip,b.tempat_lahir, b.tanggal_lahir');
		$this->db->from('pensiun as a');
        $this->db->where('a.status_pensiun', 'SK Selesai');
		$this->db->join('pegawai b','a.id_pegawai=b.id');
		$this->db->join('pegawai c','a.id_ttd=c.id');
		$query = $this->db->get();*/
        $query = $this->db->query("
            SELECT DISTINCT a.id AS id,a.id_pegawai,b.nip_baru as nip,
			b.tanggal_lahir, b.gelar_depan, b.nama, b.gelar_belakang,
			a.pangkat, a.golongan, a.jabatan,a.kantor,a.status_pensiun,a.status_masalah, '' as eselon,a.tmt_pensiun,a.bup
			FROM pensiun as a
			JOIN pegawai AS b ON a.id_pegawai=b.id
			WHERE status_pensiun='SK Selesai' 
			UNION ALL
			SELECT DISTINCT 0 AS id,a.id AS id_pegawai,a.nip_baru AS nip,a.tanggal_lahir,a.gelar_depan,a.nama,a.gelar_belakang,b.kepangkatan AS pangkat, b.golongan,
			f.nama_jabatan AS jabatan,  e.nama_unit_kerja AS kantor, '' AS status_pensiun, '' AS status_masalah, c.eselon,
			DATE_ADD(DATE_ADD(DATE_FORMAT(a.tanggal_lahir, '%Y-%m-%d'),INTERVAL g.bup YEAR),INTERVAL 1 MONTH) as tmt_pensiun,
			g.bup
			FROM pegawai AS a
			JOIN pegawai_kepangkatan AS b ON a.id = b.id_pegawai 
			JOIN pegawai_kepegawaian AS d ON a.id = d.id_pegawai 
			JOIN pegawai_jabatan AS c ON a.id = c.id_pegawai 
			LEFT JOIN m_unit_kerja AS e ON c.kode_unit_kerja = e.kode_unit_kerja 
			LEFT JOIN m_jabatan AS f ON f.id_jabatan = c.id_jabatan
			LEFT JOIN m_eselon AS g ON c.eselon = g.nama_eselon
			WHERE (DATE_ADD(DATE_FORMAT(a.tanggal_lahir, '%Y-%m-%d'),INTERVAL g.bup YEAR) <= DATE_ADD(DATE_FORMAT(NOW(), '%Y-%m-%d'),INTERVAL 3 MONTH))
            AND a.status='aktif'
        ");
        return $query;
    }
    
}