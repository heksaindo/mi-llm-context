<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>
	<script type="text/javascript"> 	

	$(document).ready(function(){
		
		//Wizard 1
		$( "#simpan-wizard2" ).click(function(){
			window.location.replace("<?php echo base_url(); ?>angkakredit/vstep3/<?php echo $id_angkakredit ?>/<?php echo $hd_id ?>");
		});
		
		//Wizard 1
		$( "#reset-wizard2" ).click(function(){
			
			window.location.replace("<?php echo base_url(); ?>angkakredit/history");
			
		});		
		
		$( "#print-wizard2" ).click(function(){
			
			do_print_step2(<?php echo $id_angkakredit ?>, <?php echo $hd_id ?>, '<?php echo $data_pegawai->nip_baru; ?>');
		
		});
		
	});	
	
	function do_print_step2(id_angkakredit, hd_id, nip) {
		
		$( "#dialog-print_step2" ).load("<?php echo base_url(); ?>angkakredit/print_step2/"+id_angkakredit+"/"+hd_id)
			.dialog({
			  autoOpen: false,
			  height: 600,
			  width: 800,
			  modal: true,
			  title: 'STEP 2 - PENILAIAN PEGAWAI: '+ nip,
			  buttons: {				
				"Cetak": function() {
					w=window.open("","", "scrollbars=1,height=600, width=700");
					w.document.write($('#dialog-print_step2').html());
					w.print();
					w.close();					
					$( this ).dialog( "close" );
				},
				"Close": function() {
					$( this ).dialog( "close" );
				}
			 },
			  
		}); 
		$( "#dialog-print_step2" ).dialog( "open" );
		
		
		return false;
	}
				
	</script>
<style>
.content-add {
	margin: 5px; 0px 5px 0px;
}
table tr td.tbl-bold {
	font-weight: bold;
}
</style>

</head>
<body>
	<?php $this->load->view('layout/_top'); ?>
	
	<!-- Content container -->
	<div id="container">
		
		<?php $this->load->view('layout/_sidebar'); ?>
		
		<!-- Content -->
		<div id="content">

		    <!-- Content wrapper -->
		    <div class="wrapper">

			    <!-- Breadcrumbs line -->
			    <div class="crumbs">
		            <ul id="breadcrumbs" class="breadcrumb"> 
						<li><a href="<?php echo base_url(); ?>Home">Dashboard</a></li>
						<li class="active"><a href="#" title="">Angka Kredit</a></li>					 
					</ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Pengajuan Angka Kredit: STEP 2 - PENILAIAN PEGAWAI </h5>
			    	</div>
			    </div>
			     <!-- /page header -->
				
			    <?php $this->load->view('layout/_actionwrapper'); ?>
				
				<div>
					<form id="form-wizard2" class="form-horizontal row-fluid well" method="post" action="" >
						<input type="hidden" id="hd_id" name="hd_id" value="<?php echo $hd_id ?>"/>
						<input type="hidden" id="id_angkakredit" name="id_angkakredit" value="<?php echo $id_angkakredit ?>"/>
						<table cellpadding="4" border="1" style="margin:10px; width:98">
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
											
											$this->db->select('a.*, b.id_jabatan_selected')
													->from('m_sub_unsur_kegiatan as a')								
													->join('angkakredit_detail as b', 'a.id_sub_uk=b.id_sub_uk')								
													->where('a.id_uk', $row2->id_uk);								
											$query3 = $this->db->get();
											if ($query3->num_rows() > 0) {
												
												$no_C = 1;	
												foreach($query3->result() as $row3){
												
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
													
												?>
													<tr class="all_C no_C_A_<?php echo $no_A;?> no_C_AB_<?php echo $no_A;?>_<?php echo $no_B;?> detail_C_<?php echo $no_A;?>_<?php echo $no_B; ?>_<?php echo $no_C; ?>">
														<td><input type="hidden" class="id_sub_uk" name="id_sub_uk[<?php echo $no_A;?>][<?php echo $no_B;?>][<?php echo $no_C; ?>]" value="<?php echo $row3->id_sub_uk;?>" /></td>
														<td width="2%" ></td>
														<td width="2%" align="center"><?php echo $no_C; ?></td>
														<td width="40%" colspan="2"><?php echo $row3->butir_kegiatan; ?></td>
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
						<br />
									
					</form>							
					<div class="form-actions">
						<button id="reset-wizard2" class="btn btn-primary">HISTORY ANGKA KREDIT</button> &nbsp; &nbsp; 
						<button id="print-wizard2" class="btn btn-primary">PRINT</button>  &nbsp; &nbsp; 
						<button id="simpan-wizard2" class="btn btn-primary">STEP 3 - PERTIMBANGAN TIM PENILAI INSTANSI &raquo;</button> &nbsp; &nbsp; 
						<div id="validasi-wizard2"></div>
					</div>	
					
				</div>
				
				<br />	 
		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		<div id="dialog-print_step2"></div>
	</div>
	<!-- /content container -->
	
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>