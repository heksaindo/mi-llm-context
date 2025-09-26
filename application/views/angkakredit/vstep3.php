<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>
	<script type="text/javascript"> 	

	$(document).ready(function(){
		
	
		$( "#back-wizard3" ).click(function(){
			
			window.location.replace("<?php echo base_url(); ?>angkakredit/vstep2/<?php echo $id_angkakredit ?>/<?php echo $hd_id ?>");
		
		});
		
		$( "#simpan-wizard3" ).click(function(){
			window.location.replace("<?php echo base_url(); ?>angkakredit/vstep4/<?php echo $id_angkakredit ?>/<?php echo $hd_id ?>");
		});
		
		$( "#print-wizard3" ).click(function(){
			
			do_print_step3(<?php echo $id_angkakredit ?>, <?php echo $hd_id ?>, '<?php echo $data_pegawai->nip_baru; ?>');
		
		});
		
	});	
	
	function do_print_step3(id_angkakredit, hd_id, nip) {
		
		$( "#dialog-print_step3" ).load("<?php echo base_url(); ?>angkakredit/print_step3/"+id_angkakredit+"/"+hd_id)
			.dialog({
			  autoOpen: false,
			  height: 600,
			  width: 800,
			  modal: true,
			  title: 'STEP 3 - PERTIMBANGAN TIM PENILAI INSTANSI: '+ nip,
			  buttons: {				
				"Cetak": function() {
					w=window.open("","", "scrollbars=1,height=600, width=700");
					w.document.write($('#dialog-print_step3').html());
					w.print();
					w.close();					
					$( this ).dialog( "close" );
				},
				"Close": function() {
					$( this ).dialog( "close" );
				}
			 },
			  
		}); 
		$( "#dialog-print_step3" ).dialog( "open" );
		
		
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
				    	<h5>Pengajuan Angka Kredit: STEP 3 - PERTIMBANGAN TIM PENILAI INSTANSI</h5>
			    	</div>
			    </div>
			     <!-- /page header -->
				
			    <?php $this->load->view('layout/_actionwrapper'); ?>

				<div>
					<form id="form-wizard3" class="form-horizontal row-fluid well" method="post" action="" >
						<input type="hidden" id="hd_id" name="hd_id" value="<?php echo $hd_id ?>"/>
						<input type="hidden" id="id_angkakredit" name="id_angkakredit" value="<?php echo $id_angkakredit ?>"/>
						
						
						<table cellpadding="4" border="1" style="margin:10px; width:98%;">
							<tr>
								<td><h6>I</h6></td>
								<td colspan="8"><h6>KETERANGAN PERORANGAN</h6></td>
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
								<td><h6>II</h6></td>
								<td colspan="8"><h6>PENILAIAN ANGKA KREDIT</h6></td>
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
							
							$all_instansi_pengusul = 0;
							$all_sekretariat_tim = 0;
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
													$all_instansi_pengusul += $total_detail;													
												}
												$total_detail_text = number_format($total_detail,2,".",",");
											}
											
											$total_pertimbangan = 0;	
											if(!empty($data_step3['total_pertimbangan'][$no_A])){
												if(!empty($data_step3['total_pertimbangan'][$no_A][$row2->id_uk])){
													$total_pertimbangan = $data_step3['total_pertimbangan'][$no_A][$row2->id_uk];													
													$all_sekretariat_tim += $total_pertimbangan;
												}
												$total_pertimbangan_text = number_format($total_pertimbangan,2,".",",");
											}
											
											$persetujuan = 'Setuju/Tidak';	
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
							
							$all_instansi_pengusul_text = number_format($all_instansi_pengusul,2,".",",");
							$all_sekretariat_tim_text = number_format($all_sekretariat_tim,2,".",",");
							?>
							
							<tr>
								<td><h6>III</h6></td>
								<td colspan="4"><h6>JUMLAH KESELURUHAN</h6></td>
								<td align="center"><?php echo $all_instansi_pengusul_text; ?></td>
								<td align="center"><div id="all_sekretariat_tim"><?php echo $all_sekretariat_tim_text; ?></div></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							
							
						</table>
						<br />
									
					</form>							
					<div class="form-actions">
						<button id="back-wizard3" class="btn btn-primary"> &laquo; STEP 2 - PENILAIAN PEGAWAI</button> &nbsp; &nbsp;  
						<button id="print-wizard3" class="btn btn-primary">PRINT</button>  &nbsp; &nbsp; 
						<button id="simpan-wizard3" class="btn btn-primary"> STEP 4: PENETAPAN ANGKA KREDIT &raquo;</button> 
						<div id="validasi-wizard3"></div>
					</div>	
					
				</div>
				
				<br />	 
		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		<div id="dialog-print_step3"></div>
	</div>
	<!-- /content container -->
	
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>