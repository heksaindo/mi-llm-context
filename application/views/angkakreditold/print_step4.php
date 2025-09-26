<html>
<head>
<style>
	.text_a {
		font-family: font-family: Arial,Verdana,Helvetica, sans-serif; font-size: 8pt; color: #000000;
		font-size: 10pt;
		color: #000000;
	}
	*
	{
		font-family: Tahoma, Arial;
	}
	table.print_body
	{
		border-collapse:collapse;
		font-size: 9pt;
		border:1px solid #000000;
	}
	table.print_body td
	{
		padding:2px 10px;
	}

</style>
</head>
<body>
	<h5>PENETAPAN ANGKA KREDIT</h5>
	
	<table class="print_body" cellpadding="4" border="1" style="margin:10px; width:98%;">
	<tr>
		<td><b>I</b></td>
		<td colspan="7"><b>KETERANGAN PERORANGAN</b></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td width="2%">1.</td>
		<td colspan="3" width="35%">N A M A</td>
		<td colspan="3"><?php echo $data_pegawai->gelar_depan.' '.$data_pegawai->nama.' '.$data_pegawai->gelar_belakang;?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>2.</td>
		<td colspan="3">N I P / No. Seri Karpeg</td>
		<td colspan="3"><?php echo $data_pegawai->nip_baru.' / '.$data_pegawai->no_kartu;?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>3.</td>
		<td colspan="3">Tempat / Tgl. Lahir</td>
		<td colspan="3"><?php echo $data_pegawai->tempat_lahir.' / '.toInaDate($data_pegawai->tanggal_lahir);?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>4.</td>
		<td colspan="3">Jenis Kelamin</td>
		<td colspan="3"><?php echo $data_pegawai->jenis_kelamin;?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>5.</td>
		<td colspan="3">Pendidikan yang telah diperhitungkan Angka kreditnya</td>
		<td colspan="3"><?php echo $data_ak->pendidikan;?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>6.</td>
		<td colspan="3">Pangkat / Gol.Ruang (TMT)</td>
		<td colspan="3"><?php echo $data_ak->pangkat.' '.$data_ak->golongan.' '.toInaDate($data_ak->tmt_pangkat);?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>7.</td>
		<td colspan="3">Jabatan Dokter</td>
		<td colspan="3"><?php echo $data_ak->nama_jabatan.'  '.toInaDate($data_ak->tmt_jabatan);?></td>
	</tr>
	<tr>
		<td rowspan="2">&nbsp;</td>
		<td rowspan="2">8.</td>
		<td colspan="3">Masa Kerja Lama</td>
		<td colspan="3">-</td>
	</tr>
	<tr>
		<td colspan="3">Masa Kerja Baru</td>
		<td colspan="3">-</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>9.</td>
		<td colspan="3">Unit Kerja</td>
		<td colspan="3"><?php echo get_name('m_unit_kerja','nama_unit_kerja','kode_unit_kerja', $data_ak->unit_kerja);?></td>
	</tr>
	
	<tr>
		<td width="2%"><b>II</b></td>
		<td colspan="4"><b>PENETAPAN ANGKA KREDIT</b></td>
		<td align="center" width="15%"><b>LAMA</b></td>
		<td align="center" width="15%"><b>BARU</b></td>
		<td align="center" width="15%"><b>JUMLAH</b></td>
	</tr>
	<?php
	$no_show = 1;
	if(!empty($data_step4['dt_angkakredit_lama']['no_pak'])){
		$no_pak = '-';
		if(!empty($data_step4['dt_angkakredit_lama']['no_pak'])){
			$no_pak = 'PAK '.$data_step4['dt_angkakredit_lama']['no_pak'];
			
			$no_pak .= ', '.date('d F Y', strtotime($data_step4['dt_angkakredit_lama']['tanggal_pak'])); 
		}
		
		$nilai_penetapan_lama = $data_step4['dt_angkakredit_lama']['nilai_penetapan'];
		$nilai_penetapan_lama = number_format($nilai_penetapan_lama,2,".",",");
		?>
		<tr>
			<td>&nbsp;</td>
			<td width="2%"><b><?php echo $no_show; ?></b></td>
			<td colspan="3"><?php echo $no_pak; ?></td>
			<td align="center"><?php echo $nilai_penetapan_lama; ?></td>
			<td align="center">&nbsp;</td>
			<td align="center"><?php echo $nilai_penetapan_lama; ?></td>
		</tr>	
		
		<?php
		$no_show ++;
	}
	
	$all_total_ak_lama = 0;
	$all_total_ak_baru = 0;
	$all_total_jumlah = 0;
	$i = 0;	
	$this->db->select('DISTINCT (kategori_uk)', false)
			->from('m_unsur_kegiatan');								
	$query1 = $this->db->get();
	if ($query1->num_rows() > 0) {
			
		$no_A = 1;	
		foreach($query1->result() as $row){
			?>
			<tr>
				<td>&nbsp;</td>
				<td width="2%"><b><?php echo $no_show; ?></b></td>
				<td colspan="3"><b><?php echo $row->kategori_uk; ?></b></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>									
			<?php
			
			$this->db->select('*')
				->from('m_unsur_kegiatan')
				->where('kategori_uk', $row->kategori_uk);								
			$query2 = $this->db->get();
			if ($query2->num_rows() > 0) {
				$bb = 'A';
				$no_B = 1;
				foreach($query2->result() as $row2){
					
					$total_ak_baru = 0;	
					$total_ak_baru_text = '';
					if(!empty($data_step4['total_ak_baru'][$no_A])){
						if(!empty($data_step4['total_ak_baru'][$no_A][$row2->id_uk])){
							$total_ak_baru = $data_step4['total_ak_baru'][$no_A][$row2->id_uk];													
						}
						$total_ak_baru_text = number_format($total_ak_baru,2,".",",");
						$all_total_ak_baru += $total_ak_baru;
					}
					
					$total_ak_lama = 0;	
					$total_ak_lama_text = '';
					if(!empty($data_step4['total_ak_lama'][$no_A])){
						if(!empty($data_step4['total_ak_lama'][$no_A][$row2->id_uk])){
							$total_ak_lama = $data_step4['total_ak_lama'][$no_A][$row2->id_uk];													
						}
						$total_ak_lama_text = number_format($total_ak_lama,2,".",",");
						$all_total_ak_lama += $total_ak_lama;
					}
					
					$jumlah = 0;	
					$jumlah_text = '';
					if(!empty($data_step4['jumlah'][$no_A])){
						if(!empty($data_step4['jumlah'][$no_A][$row2->id_uk])){
							$jumlah = $data_step4['jumlah'][$no_A][$row2->id_uk];													
						}
						$jumlah_text = number_format($jumlah,2,".",",");
						$all_total_jumlah += $jumlah;
					}
					?>
					<tr>
						<td>&nbsp;</td>
						<td width="2%">&nbsp;</td>
						<td width="2%"><?php echo $bb; ?></td>
						<td colspan="2"><?php echo $row2->nama_uk; ?></td>
						<td align="center"><?php echo $total_ak_lama_text; ?></td>
						<td align="center"><?php echo $total_ak_baru_text; ?></td>
						<td align="center"><?php echo $jumlah_text; ?></td>
					</tr>									
					<?php
					
					$bb++;
					$no_B++;
				}
			}
			
			$no_show ++;
			$no_A++;
		}
	}
	
	
	
	$all_total_ak_lama = number_format($all_total_ak_lama,2,".",",");
	$all_total_ak_baru = number_format($all_total_ak_baru,2,".",",");
	$all_total_jumlah = number_format($all_total_jumlah,2,".",",");
	?>
	
	<tr>
		<td>&nbsp;</td>
		<td colspan="4"><b>JUMLAH UNSUR UTAMA DAN UNSUR PENUNJANG</b></td>
		<td align="center"><b><?php echo $all_total_ak_lama; ?></b></td>
		<td align="center"><b><?php echo $all_total_ak_baru; ?></b></td>
		<td align="center"><b><?php echo $all_total_jumlah; ?></b></td>
	</tr>
	<tr>
		<td><b>III</b></td>
		<td colspan="7">
			<?php
			if(!empty($data_step4['hasil_penetapan'])){
				echo $data_step4['hasil_penetapan'];
			}									
			?>
		</td>
	</tr>
	
	
	</table>
	<table class="print_body" cellpadding="4" border="0" style="margin:10px; width:98%;">
	<tr>
		<td width="170">No Penetapan Angka Kredit</td>
		<td width="5">:</td>
		<td><?php echo $data_ak->no_pak;?></td>
	</tr>
	<tr>
		<td width="170">Tanggal Penetapan</td>
		<td width="5">:</td>
		<td>
		<?php
			if(!empty($data_ak->tanggal_pak)){
				$get_date = strtotime($data_ak->tanggal_pak);
				$data_ak->tanggal_pak = date('d-m-Y',$get_date);
			}else{
				$data_ak->tanggal_pak = '';
			}
		?>
		<?php echo $data_ak->tanggal_pak;?>
		</td>
	</tr>
	</table>
</body>
</html>