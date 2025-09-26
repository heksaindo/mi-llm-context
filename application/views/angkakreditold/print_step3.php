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
	<h5>PERTIMBANGAN TIM PENILAI INSTANSI</h5>
	
	<table class="print_body" cellpadding="4" border="1" style="margin:10px; width:98%;">
		<tr>
			<td><b>I</b></td>
			<td colspan="8"><b>KETERANGAN PERORANGAN</b></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td width="2%">1.</td>
			<td colspan="3" width="35%">N A M A</td>
			<td colspan="4"><?php echo $data_pegawai->gelar_depan.' '.$data_pegawai->nama.' '.$data_pegawai->gelar_belakang;?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>2.</td>
			<td colspan="3">N I P / No. Seri Karpeg</td>
			<td colspan="4"><?php echo $data_pegawai->nip_baru.' / '.$data_pegawai->no_kartu;?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>3.</td>
			<td colspan="3">Tempat / Tgl. Lahir</td>
			<td colspan="4"><?php echo $data_pegawai->tempat_lahir.' / '.toInaDate($data_pegawai->tanggal_lahir);?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>4.</td>
			<td colspan="3">Pangkat / Gol.Ruang (TMT)</td>
			<td colspan="4"><?php echo $data_ak->pangkat.' '.$data_ak->golongan.' '.toInaDate($data_ak->tmt_pangkat);?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>5.</td>
			<td colspan="3">Jenis Kelamin</td>
			<td colspan="4"><?php echo $data_pegawai->jenis_kelamin;?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>6.</td>
			<td colspan="3">Pendidikan</td>
			<td colspan="4"><?php echo $data_ak->pendidikan;?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>7.</td>
			<td colspan="3">Jabatan Fungsional / TMT</td>
			<td colspan="4"><?php echo $data_ak->nama_jabatan.'  '.toInaDate($data_ak->tmt_jabatan);?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>8.</td>
			<td colspan="3">Unit Kerja</td>
			<td colspan="4"><?php echo get_name('m_unit_kerja','nama_unit_kerja','kode_unit_kerja', $data_ak->unit_kerja);?></td>
		</tr>
		
		<tr>
			<td><b>II</b></td>
			<td colspan="8"><b>PENILAIAN ANGKA KREDIT</b></td>
		</tr>
		<tr>
			<td rowspan="2" width="2%">&nbsp;</td>
			<td rowspan="2" colspan="4" align="center" width="37%"><b>UNSUR YANG DINILAI</b></td>
			<td colspan="4" align="center" width="60%"><b>PERTIMBANGAN</b></td>
		</tr>
		<tr>
			<td align="center" width="15%"><b>INSTANSI<br/>PENGUSUL</b></td>
			<td align="center" width="15%"><b>SEKERTARIAT<br/>TIM</b></td>
			<td align="center" width="15%"><b>TIM<br/>PENILAI</b></td>
			<td align="center" width="15%"><b>KET</b></td>
		</tr>
		<?php
		$i = 0;	
		$this->db->select('DISTINCT (kategori_uk)', false)
				->from('m_unsur_kegiatan');								
		$query1 = $this->db->get();
		if ($query1->num_rows() > 0) {
			$aa = 'A';	
			$no_A = 1;	
			foreach($query1->result() as $row){
				?>
				<tr>
					<td>&nbsp;</td>
					<td width="2%"><b><?php echo $no_A; ?></b></td>
					<td colspan="3"><b><?php echo $row->kategori_uk; ?></b></td>
					<td>&nbsp;</td>
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
						
						$total_detail = 0;	
						$total_detail_text = '';
						if(!empty($data_step3['total_detail'][$no_A])){
							if(!empty($data_step3['total_detail'][$no_A][$row2->id_uk])){
								$total_detail = $data_step3['total_detail'][$no_A][$row2->id_uk];													
							}
							$total_detail_text = number_format($total_detail,2,".",",");
						}
						
						$total_pertimbangan = 0;	
						if(!empty($data_step3['total_pertimbangan'][$no_A])){
							if(!empty($data_step3['total_pertimbangan'][$no_A][$row2->id_uk])){
								$total_pertimbangan = $data_step3['total_pertimbangan'][$no_A][$row2->id_uk];													
							}
						}
						
						$persetujuan = 'Tidak';	
						if(!empty($data_step3['persetujuan'][$no_A])){
							if(!empty($data_step3['persetujuan'][$no_A][$row2->id_uk])){
								$persetujuan = $data_step3['persetujuan'][$no_A][$row2->id_uk];													
							}
						}
						
						$keterangan = '';	
						if(!empty($data_step3['keterangan'][$no_A])){
							if(!empty($data_step3['keterangan'][$no_A][$row2->id_uk])){
								$keterangan = $data_step3['keterangan'][$no_A][$row2->id_uk];													
							}
						}
						?>
						<tr>
							<td>&nbsp;</td>
							<td width="2%">&nbsp;</td>
							<td width="2%"><?php echo $bb; ?></td>
							<td colspan="2"><?php echo $row2->nama_uk; ?></td>
							<td align="center"><?php echo $total_detail_text; ?></td>
							<td align="center"><?php echo $total_pertimbangan; ?></td>
							<td align="center">
								<input type="hidden" class="kategori_uk" name="kategori_uk[<?php echo $no_A;?>][<?php echo $no_B;?>]" value="<?php echo $row->kategori_uk;?>" />
								<input type="hidden" class="id_uk" name="id_uk[<?php echo $no_A;?>][<?php echo $no_B;?>]" value="<?php echo $row2->id_uk;?>" />
								<?php  echo $persetujuan; ?>												
							</td>
							<td align="center"><?php echo $keterangan; ?></td>
						</tr>									
						<?php
						
						$bb++;
						$no_B++;
					}
				}
				
				$no_A++;
			}
		}
		?>
		
		<tr>
			<td><b>III</b></td>
			<td colspan="4"><b>JUMLAH KESELURUHAN</b></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>		
		
	</table>
</body>
</html>