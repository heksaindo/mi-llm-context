<html>
<head>
<style>
	
	
	.print_laporan{
		font-family: Tahoma, Arial;
		font-size: 12px;
	}
		
	.print_laporan .title_laporan{
		font-size: 13px;
		font-weight: bold;
		line-height: 16px;
	}
	
	.print_laporan .text_a {
		font-size: 8pt; 
		color: #000000;
		font-size: 10pt;
		color: #000000;
	}
	.print_laporan table.print_body {
		border-collapse:collapse;
		font-size: 12px;
		margin:10px; 
		width:98%;
	}
	.print_laporan table.print_body td {
		padding:0px 10px;
		border:1px solid #000000;
		vertical-align: top;
	}
	
	.print_laporan table.sign td{vertical-align: top;}
	
	.print_laporan table.print_body td.no_border {
		border: 0px solid #fff;
	}
	.print_laporan table.print_body td.no_border_top {
		border-top: 0px solid #000000;
	}
	.print_laporan table.print_body td.no_border_bottom {
		border-bottom: 0px solid #000000;
	}
	.print_laporan table.print_body td.no_border_left {
		border-left: 0px solid #000000;
	}
	.print_laporan table.print_body td.no_border_right {
		border-right: 0px solid #000000;
	}
	.print_laporan table.print_body td.font-18 {
		font-size: 18px;
	}
	.print_laporan table.print_body td.font-16 {
		font-size: 16px;
	}
	.print_laporan table.print_body td.font-14 {
		font-size: 14px;
	}
	.print_laporan table.print_body td.font-12 {
		font-size: 12px;
	}
	.print_laporan table.print_body td.font-10 {
		font-size: 10px;
	}
	.print_laporan table.print_body td.bold {
		/*font-weight: bold;*/
	}
	.print_laporan table.print_body td.center {
		text-align: center;
	}
	.print_laporan table.print_body td.xunderline {
		text-decoration: underline;
	}
	.print_laporan table.print_body td.masapenilaian {
		line-height: 5px;
		vertical-align: top;
		padding-top:2px;
		height:20px;
	}
	.print_laporan table.print_body td.infopegawai {
		line-height: 16px;
		vertical-align: top;
		padding-top:0px;
	}

</style>
</head>
<body>
<div class="print_laporan">	
	<div class="title_laporan">SEKRETARIAT TIM PENILAI  PUSAT<br/>
		JABATAN FUNGSIONAL DOKTER <br/>
		DIREKTORAT JENDERAL BINA UPAYA KESEHATAN
	</div>
	
	<table class="print_body" cellpadding="4" border="0">
		<tr>
			<td class="center no_border font-14 xunderline" colspan="11">L A P O R A N  &nbsp; &nbsp;  B U L A N A N</td>
		</tr>
		<tr>
			<td class="center no_border masapenilaian" colspan="11">Masa Penilaian   :  <?php echo toInaPeriode($data_ak->periode_awal);?> s/d <?php echo toInaPeriode($data_ak->periode_akhir);?> </td>
		</tr>
		<tr>
			<td class="no_border infopegawai" colspan="5" width="35%">N a m a</td>
			<td class="no_border infopegawai center" width="5%">:</td>
			<td class="no_border infopegawai" colspan="6"><?php echo $data_pegawai->gelar_depan.' '.$data_pegawai->nama.' '.$data_pegawai->gelar_belakang;?></td>
		</tr>
		
		<tr>
			<td class="no_border infopegawai" colspan="5">No Induk Pegawai / Karpeg</td>
			<td class="no_border infopegawai center">:</td>
			<td class="no_border infopegawai" colspan="6"><?php echo $data_pegawai->nip_baru.' / '.$data_pegawai->no_kartu;?></td>
		</tr>
		<tr>
			<td class="no_border infopegawai" colspan="5">Tempat/Tgl.Lahir</td>
			<td class="no_border infopegawai center">:</td>
			<td class="no_border infopegawai" colspan="6"><?php echo ucwords(strtolower($data_pegawai->tempat_lahir)).', '.toInaDate($data_pegawai->tanggal_lahir);?></td>
		</tr>
		<tr>
			<td class="no_border infopegawai" colspan="5">Pangkat/Gol.Ruang (TMT)</td>
			<td class="no_border infopegawai center">:</td>
			<td class="no_border infopegawai" colspan="6"><?php echo $data_ak->pangkat.' '.$data_ak->golongan.' '.date('d-m-Y',strtotime($data_ak->tmt_pangkat));?></td>
		</tr>
		<tr>
			<td class="no_border infopegawai" colspan="5">Jenis Kelamin</td>
			<td class="no_border infopegawai center">:</td>
			<td class="no_border infopegawai" colspan="6"><?php echo $data_pegawai->jenis_kelamin;?></td>
		</tr>
		<tr>
			<td class="no_border infopegawai" colspan="5">Pendidikan</td>
			<td class="no_border infopegawai center">:</td>
			<td class="no_border infopegawai" colspan="6"><?php echo $data_ak->pendidikan;?></td>
		</tr>
		<tr>
			<td class="no_border infopegawai" colspan="5">Jabatan Fungsional Perawat / TMT</td>
			<td class="no_border infopegawai center">:</td>
			<td class="no_border infopegawai" colspan="6"><?php echo $data_ak->nama_jabatan.'  '.date('d-m-Y',strtotime($data_ak->tmt_jabatan));?></td>
		</tr>
		<tr>
			<td class="no_border infopegawai" colspan="5">Unit Kerja</td>
			<td class="no_border infopegawai center">:</td>
			<td class="no_border infopegawai" colspan="6"><?php echo get_name('m_unit_kerja','nama_unit_kerja','kode_unit_kerja', $data_ak->unit_kerja);?></td>
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
					<td colspan="11" class="tbl-bold"><b><?php echo $row->kategori_uk; ?> : </b></td>
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
							<td colspan="9" class="tbl-bold"><b><?php echo $row2->nama_uk; ?></b></td>
							<td width="10%" align="center"></td>
						</tr>
						<?php
						//echo '<pre>';
						//print_r($data_step2['satuan_bagi']);
						//die();
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
									$get_nilai_ak = 0;
									if(!empty($data_step2['nilai_ak'][$no_A][$row2->id_uk][$row3->id_jabatan_selected][$row3->id_sub_uk])){
										$get_nilai_ak = $data_step2['nilai_ak'][$no_A][$row2->id_uk][$row3->id_jabatan_selected][$row3->id_sub_uk];
									}
									
									//get nilai_uk
									$get_nilai_uk = 0;
									if(!empty($data_step2['nilai_uk'][$no_A][$row2->id_uk][$row3->id_jabatan_selected][$row3->id_sub_uk])){
										$get_nilai_uk = $data_step2['nilai_uk'][$no_A][$row2->id_uk][$row3->id_jabatan_selected][$row3->id_sub_uk];
									}
									
									//get pengali_persen
									$get_pengali_persen = 1;
									if(!empty($data_step2['pengali_persen'][$no_A][$row2->id_uk][$row3->id_jabatan_selected][$row3->id_sub_uk])){
										$get_pengali_persen = $data_step2['pengali_persen'][$no_A][$row2->id_uk][$row3->id_jabatan_selected][$row3->id_sub_uk];
									}
									
									//get satuan_bagi
									$get_satuan_bagi = 1;
									if(!empty($data_step2['satuan_bagi'][$no_A][$row2->id_uk][$row3->id_jabatan_selected][$row3->id_sub_uk])){
										$get_satuan_bagi = $data_step2['satuan_bagi'][$no_A][$row2->id_uk][$row3->id_jabatan_selected][$row3->id_sub_uk];
									}
									
									$all_total_C = 0;	
									$all_total_C_text = '';
									if(!empty($data_step2['nilai_uk']) AND !empty($data_step2['nilai_ak']) AND !empty($data_step2['pengali_persen'])){
										if(!empty($get_nilai_ak)){
											$all_total_C = (($get_nilai_ak * $get_nilai_uk) / $get_satuan_bagi) * ($get_pengali_persen / 100);	
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
									
									if(!empty($get_nilai_ak)){
									
									?>
										<tr class="all_C no_C_A_<?php echo $no_A;?> no_C_AB_<?php echo $no_A;?>_<?php echo $no_B;?> detail_C_<?php echo $no_A;?>_<?php echo $no_B; ?>_<?php echo $no_C; ?>">
											<td><input type="hidden" class="id_sub_uk" name="id_sub_uk[<?php echo $no_A;?>][<?php echo $no_B;?>][<?php echo $no_C; ?>]" value="<?php echo $row3->id_sub_uk;?>" /></td>
											<td width="2%" ></td>
											<td width="2%" align="center"><?php echo $no_C; ?></td>
											<td width="40%" colspan="4"><?php echo $row3->butir_kegiatan.' '.$show_bintang; ?></td>
											<td width="10%" align="center"><?php echo $get_nilai_ak; ?></td>
											<td width="4%" align="center">Kali</td>
											<td width="7%" align="center"><?php echo $get_nilai_uk; ?> <input type="hidden" class="nilai_uk" name="nilai_uk[<?php echo $no_A;?>][<?php echo $no_B;?>][<?php echo $no_C; ?>]" value="<?php echo $get_nilai_uk;?>" /></td>
											<td width="10%" align="center"><input type="hidden" class="total_nilai_C" name="total_nilai_C[<?php echo $no_A;?>][<?php echo $no_B;?>][<?php echo $no_C; ?>]" value="<?php echo $all_total_C; ?>" /><div class="total_nilai_C_text"><?php echo $all_total_C_text; ?></div></td>
											<td width="10%" align="center"></td>
										</tr>
										<?php
										$no_C++;
										$i++;
									}
								}	
							}
							
						}
						
						$all_total_B = 0;	
						$all_total_B_text = '';
						//print_r($data_step2['total_id_uk'][$no_A]);
						if(!empty($data_step2['total_id_uk'][$no_A])){
							if(!empty($data_step2['total_id_uk'][$no_A][$row2->id_uk])){
								$all_total_B = $data_step2['total_id_uk'][$no_A][$row2->id_uk];													
							}
							$all_total_B_text = number_format($all_total_B,2,".",",");
						}
						
						if(empty($all_total_B)){
							?>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td colspan="5">&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
							<?php
						}
						
						?>
						<tr class="all_B no_B_<?php echo $no_A;?> detail_B_<?php echo $no_A;?>_<?php echo $no_B; ?>">
							<td>&nbsp;</td>
							<td><input type="hidden" class="id_uk" name="id_uk[<?php echo $no_A;?>][<?php echo $no_B;?>]" value="<?php echo $row2->id_uk;?>" /></td>
							<td colspan="9" class="tbl-bold">JUMLAH <?php echo $row2->nama_uk;?></td>
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
					<td colspan="10" class="tbl-bold">JUMLAH <?php echo $row->kategori_uk;?></td>
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
			<td colspan="11" class="tbl-bold"><b>&nbsp; JUMLAH UNSUR UTAMA DAN PENUNJANG</b></td>
			<td width="10%" align="center"><input type="hidden" class="total_all" name="total_all" value="<?php echo $all_total; ?>" /><div class="total_all_text"><?php echo $all_total_text; ?></div></div></td>
		</tr>
		
	
	</table>
	
	<table class="print_body" cellpadding="4" border="0" style="border:0px; margin:10px; width:98%;">
		
		<tr>
			<td class="no_border">
				Mengetahui:<br/>
				Kepala Sub Kepegawaian<br/><br/><br/><br/>
				<?php 
				$data_ak->nama_pejabat_mengetahui = ucwords(strtolower($data_ak->nama_pejabat_mengetahui));
				if(!empty($data_ak->gelar_depan_pejabat_mengetahui)){
					$data_ak->nama_pejabat_mengetahui = $data_ak->gelar_depan_pejabat_mengetahui.' '.$data_ak->nama_pejabat_mengetahui;
				}
				if(!empty($data_ak->gelar_belakang_pejabat_mengetahui)){
					$data_ak->nama_pejabat_mengetahui = $data_ak->nama_pejabat_mengetahui.' '.$data_ak->gelar_belakang_pejabat_mengetahui;
				}
				
				echo $data_ak->nama_pejabat_mengetahui; 
				?><br/>
				NIP. <?php echo $data_ak->pejabat_mengetahui; ?>
			</td>
			<td class="no_border" width="40%">&nbsp;</td>
			<td class="no_border">
				Jakarta,  <?php echo toInaDate($data_ak->tanggal_penilaian); ?><br/>
				Penyelenggara:<br/><br/><br/><br/>
				<?php 
				$data_ak->nama_pejabat_penyelenggara = ucwords(strtolower($data_ak->nama_pejabat_penyelenggara));
				if(!empty($data_ak->gelar_depan_pejabat_penyelenggara)){
					$data_ak->nama_pejabat_penyelenggara = $data_ak->gelar_depan_pejabat_penyelenggara.' '.$data_ak->nama_pejabat_penyelenggara;
				}
				if(!empty($data_ak->gelar_belakang_pejabat_penyelenggara)){
					$data_ak->nama_pejabat_penyelenggara = $data_ak->nama_pejabat_penyelenggara.' '.$data_ak->gelar_belakang_pejabat_penyelenggara;
				}
				echo $data_ak->nama_pejabat_penyelenggara; ?><br/>
				NIP. <?php echo $data_ak->pejabat_penyelenggara; ?>
			
			</td>
		</tr>
	
	
	</table>
</div>
</body>
</html>