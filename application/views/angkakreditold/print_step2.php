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
	<h5>PENILAIAN PEGAWAI</h5>
	
	<table class="print_body" cellpadding="4" border="1" style="margin:10px; width:98%;">
		<tr>
			<td colspan="10"><b>KETERANGAN PERORANGAN</b></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td width="2%">1.</td>
			<td colspan="2" width="35%">N A M A</td>
			<td colspan="6"><?php echo $data_pegawai->gelar_depan.' '.$data_pegawai->nama.' '.$data_pegawai->gelar_belakang;?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>2.</td>
			<td colspan="2">N I P / No. Seri Karpeg</td>
			<td colspan="6"><?php echo $data_pegawai->nip_baru.' / '.$data_pegawai->no_kartu;?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>3.</td>
			<td colspan="2">Tempat / Tgl. Lahir</td>
			<td colspan="6"><?php echo $data_pegawai->tempat_lahir.' / '.toInaDate($data_pegawai->tanggal_lahir);?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>4.</td>
			<td colspan="2">Pangkat / Gol.Ruang (TMT)</td>
			<td colspan="6"><?php echo $data_ak->pangkat.' '.$data_ak->golongan.' '.toInaDate($data_ak->tmt_pangkat);?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>5.</td>
			<td colspan="2">Jenis Kelamin</td>
			<td colspan="6"><?php echo $data_pegawai->jenis_kelamin;?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>6.</td>
			<td colspan="2">Pendidikan</td>
			<td colspan="6"><?php echo $data_ak->pendidikan;?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>7.</td>
			<td colspan="2">Jabatan Fungsional / TMT</td>
			<td colspan="6"><?php echo $data_ak->nama_jabatan.'  '.toInaDate($data_ak->tmt_jabatan);?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>8.</td>
			<td colspan="2">Unit Kerja</td>
			<td colspan="6"><?php echo get_name('m_unit_kerja','nama_unit_kerja','kode_unit_kerja', $data_ak->unit_kerja);?></td>
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
					<td align="center" class="tbl-bold" width="2%"><?php echo $aa; ?></td>
					<td colspan="8" class="tbl-bold"><?php echo $row->kategori_uk; ?> : </td>
				</tr>
			<?php
				
				$this->db->select('*')
						->from('m_unsur_kegiatan')
						->where('kategori_uk', $row->kategori_uk);								
				$query2 = $this->db->get();
				if ($query2->num_rows() > 0) {
					$no_B = 1;
					foreach($query2->result() as $row2){
					?>
						<tr>
							<td>&nbsp;</td>
							<td align="center" class="tbl-bold" width="4%"><?php echo $no_B; ?>.</td>
							<td colspan="7" class="tbl-bold"><?php echo $row2->nama_uk; ?> </td>
							<td width="10%" align="center"></td>
						</tr>
						<?php
						//echo '<pre>';
						//print_r($data_step2);
						$this->db->select('a.*, b.id_jabatan_selected, b.nilai_ak')
								->from('m_sub_unsur_kegiatan as a')								
								->join('angkakredit_detail as b', 'a.id_sub_uk=b.id_sub_uk')								
								->where('a.id_uk', $row2->id_uk)
								->order_by('b.id_jabatan_selected', 'ASC');								
						$query3 = $this->db->get();
						if ($query3->num_rows() > 0) {
							
							$no_C = 1;	
							foreach($query3->result() as $row3){
							
								if(!empty($row3->nilai_ak)){
									//get value
									$get_nilai_ak = '';
									if(!empty($data_step2['nilai_ak'][$no_A][$row3->id_jabatan_selected][$row2->id_uk][$row3->id_sub_uk])){
										$get_nilai_ak = $data_step2['nilai_ak'][$no_A][$row3->id_jabatan_selected][$row2->id_uk][$row3->id_sub_uk];
									}
									
									//get nilai_uk
									if(!empty($data_step2['nilai_uk'][$no_A][$row3->id_jabatan_selected][$row2->id_uk][$row3->id_sub_uk])){
										$row3->nilai_uk = $data_step2['nilai_uk'][$no_A][$row3->id_jabatan_selected][$row2->id_uk][$row3->id_sub_uk];
									}
									
									$all_total_C = 0;	
									$all_total_C_text = '';
									if(!empty($data_step2['nilai_uk']) AND !empty($data_step2['nilai_ak'])){
										if(!empty($get_nilai_ak)){
											$all_total_C = $get_nilai_ak*$row3->nilai_uk;	
											$all_total_C_text = number_format($all_total_C,2,".",",");
										}
									}
									
									$show_bintang = '';
									if($row3->id_jabatan_selected < $data_ak->id_jabatan){
										$show_bintang = '*';
									}
									
									if($row3->id_jabatan_selected > $data_ak->id_jabatan){
										$show_bintang = '**';
									}
									
								?>
									<tr class="all_C no_C_A_<?php echo $no_A;?> no_C_AB_<?php echo $no_A;?>_<?php echo $no_B;?> detail_C_<?php echo $no_A;?>_<?php echo $no_B; ?>_<?php echo $no_C; ?>">
										<td><input type="hidden" class="id_sub_uk" name="id_sub_uk[<?php echo $no_A;?>][<?php echo $no_B;?>][<?php echo $no_C; ?>]" value="<?php echo $row3->id_sub_uk;?>" /></td>
										<td width="2%" ></td>
										<td width="2%" align="center"><?php echo $no_C; ?></td>
										<td width="40%" colspan="2"><?php echo $row3->butir_kegiatan.' '.$show_bintang; ?></td>
										<td width="10%" align="center"><?php echo $get_nilai_ak; ?></td>
										<td width="4%" align="center">Kali</td>
										<td width="7%" align="center"><?php echo $row3->nilai_uk; ?> <input type="hidden" class="nilai_uk" name="nilai_uk[<?php echo $no_A;?>][<?php echo $no_B;?>][<?php echo $no_C; ?>]" value="<?php echo $row3->nilai_uk;?>" /></td>
										<td width="10%" align="center"><input type="hidden" class="total_nilai_C" name="total_nilai_C[<?php echo $no_A;?>][<?php echo $no_B;?>][<?php echo $no_C; ?>]" value="<?php echo $all_total_C; ?>" /><div class="total_nilai_C_text"><?php echo $all_total_C_text; ?></div></td>
										<td width="10%" align="center"></td>
									</tr>
								<?php
								$no_C++;
								$i++;
								}	
							}
							
						}else{
							?>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
							<?php
						}
						
						$all_total_B = 0;	
						$all_total_B_text = '';
						if(!empty($data_step2['total_id_uk'][$no_A])){
							if(!empty($data_step2['total_id_uk'][$no_A][$row2->id_uk])){
								$all_total_B = $data_step2['total_id_uk'][$no_A][$row2->id_uk];													
							}
							$all_total_B_text = number_format($all_total_B,2,".",",");
						}
						?>
						<tr class="all_B no_B_<?php echo $no_A;?> detail_B_<?php echo $no_A;?>_<?php echo $no_B; ?>">
							<td>&nbsp;</td>
							<td><input type="hidden" class="id_uk" name="id_uk[<?php echo $no_A;?>][<?php echo $no_B;?>]" value="<?php echo $row2->id_uk;?>" /></td>
							<td colspan="7" class="tbl-bold">JUMLAH <?php echo $row2->nama_uk;?></td>
							<td width="10%" align="center"><input type="hidden" class="total_nilai_B" name="total_nilai_B[<?php echo $no_A;?>][<?php echo $no_B;?>]" value="<?php echo $all_total_B; ?>" /><div class="total_nilai_B_text"><?php echo $all_total_B_text; ?></div></td>
						</tr>
						<?php
						$no_B++;
					}
				}
				$aa++;
				
				$all_total_A = 0;	
				$all_total_A_text = '';
				if(!empty($data_step2['total_kategori'])){
					if(!empty($data_step2['total_kategori'][$no_A])){
						$all_total_A = $data_step2['total_kategori'][$no_A];													
					}
					$all_total_A_text = number_format($all_total_A,2,".",",");
				}
				?>
				<tr class="all_A no_A_<?php echo $no_A;?> detail_A_<?php echo $no_A;?>">
					<td><input type="hidden" class="kategori_uk" name="kategori_uk[<?php echo $no_A;?>]" value="<?php echo $row->kategori_uk;?>" /></td>
					<td colspan="8" class="tbl-bold">JUMLAH <?php echo $row->kategori_uk;?></td>
					<td width="10%" align="center"><input type="hidden" class="total_nilai_A" name="total_nilai_A[<?php echo $no_A;?>]" value="<?php echo $all_total_A; ?>" /><div class="total_nilai_A_text"><?php echo $all_total_A_text; ?></div></td>
				</tr>
			<?php
				$no_A++;
			}
		}		

		$all_total = 0;	
		$all_total_text = '';
		if(!empty($data_step2['all_total'])){
			$all_total = $data_step2['all_total'];
			$all_total_text = number_format($all_total,2,".",",");
		}
		
		?>
		<tr>
			<td colspan="9" class="tbl-bold">&nbsp; JUMLAH UNSUR UTAMA DAN PENUNJANG</td>
			<td width="10%" align="center"><input type="hidden" class="total_all" name="total_all" value="<?php echo $all_total; ?>" /><div class="total_all_text"><?php echo $all_total_text; ?></div></div></td>
		</tr>
	
	</table>
</body>
</html>