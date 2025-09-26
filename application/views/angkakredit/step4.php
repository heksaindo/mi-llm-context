<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.js"></script>
	<script type="text/javascript"> 	

	$(document).ready(function(){
		//Initialisasi
		$( ".datepicker" ).datepicker({ 
			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			changeYear: true,
			yearRange: "-90:+0"
		});
	
		$( "#print-wizard4" ).hide();
		$( "#print_pengantar-wizard4" ).hide();
		$( "#next-wizard4" ).hide();
		
		$( "#back-wizard4" ).click(function(){
			
			window.location.replace("<?php echo base_url(); ?>angkakredit/step3/<?php echo $id_angkakredit ?>/<?php echo $hd_id ?>");
		
		});
		
		$( "#simpan-wizard4" ).click(function(){
			var err = 0;
			
			var no_pak = $( "#no_pak" ).val();
			var tanggal_pak = $( "#tanggal_pak" ).val();
			var pejabat_penetapan = $( "#pejabat_penetapan" ).val();
			
			if(no_pak == ''){
				$( "#no_pak" ).addClass("invalid");
				alert('No PAK Harus di isi!');
				$( "#validasi-wizard4" ).html( '<font color="red"> No PAK Harus di isi!</font>' );
				return false;
			}			
			
			if(tanggal_pak == ''){
				$( "#tanggal_pak" ).addClass("invalid");
				alert('Tanggal Penetapan Harus di isi!');
				$( "#validasi-wizard4" ).html( '<font color="red"> Tanggal Penetapan Harus di isi!</font>' );
				return false;
			}			
			
			if(pejabat_penetapan == ''){
				$( "#pejabat_penetapan" ).addClass("invalid");
				alert('Pejabat Penetapan Harus di isi!');
				$( "#validasi-wizard4" ).html( '<font color="red"> Pejabat Penetapan Harus di isi!</font>' );
				return false;
			}		
			
			//alert(err);
			if(err == 0){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>angkakredit/do_add_wizard4",
					data: $('#form-wizard4').serialize(), 
					success: function(msg){	
						var xdata = explode('#', msg);
						//alert(msg);
						if(xdata[0] == 'success'){					
							//$( "#validasi-wizard4" ).html( '<font color="blue"> Data sudah disimpan</font>' );						
							alert('Data Penetapan Sudah Disimpan');
							//window.location.replace("<?php echo base_url(); ?>angkakredit/step4/"+ xdata[1] + '/' + xdata[2]);
							$( "#print-wizard4" ).show();
							$( "#print_pengantar-wizard4" ).show();
							$( "#next-wizard4" ).show();
		
						}else{
							$( "#validasi-wizard4" ).html( '<font color="red"> Data tidak dapat disimpan, coba lagi!</font>' );	
						}
						return false;
					}
				});
			}else{
				$( "#validasi-wizard4" ).html( '<font color="red"> Input Salah, Silahkan cek input warna merah!</font>' );	
			}
		});
		
		
		
		<?php 
		if(empty($data_step4['status_penetapan'])){
			//disable button
			?>
			//$('#simpan-wizard4').attr('disabled','disabled');
			//$('#no_pak').attr('disabled','disabled');
			//$('#tanggal_pak').attr('disabled','disabled');
			//$('#no_pak').val('');
			//$('#tanggal_pak').val('');
			<?php
		}else
		{
			//enable button
			?>
			//$('#simpan-wizard4').removeAttr('disabled');
			//$('#no_pak').removeAttr('disabled');
			//$('#tanggal_pak').removeAttr('disabled');
			<?php
		}
		?>
	
		$( "#print-wizard4" ).click(function(){
			
			do_print_step4(<?php echo $id_angkakredit ?>, <?php echo $hd_id ?>, '<?php echo $data_pegawai->nip_baru; ?>');
		
		});
		$( "#print_pengantar-wizard4" ).click(function(){
			
			do_print_pengantar4(<?php echo $id_angkakredit ?>, <?php echo $hd_id ?>, '<?php echo $data_pegawai->nip_baru; ?>');
		
		});
		
		$( "#next-wizard4" ).click(function(){
			
			window.location.replace("<?php echo base_url(); ?>angkakredit/histori");
		
		});
		
		//cek_pejabat_penetapan
		$("#cek_pejabat_penetapan").autocomplete("<?php echo base_url(); ?>angkakredit/check_nip_baru/", {
			width: 250,
			minChars:1,
			max:100,
			selectFirst: false
		});
		
		$("#cek_pejabat_penetapan").result(function(event, data, formatted) {
			if (data[0] != 'error'){  
				$("#pejabat_penetapan").val(data[1]);
			}
		});
	});	
	
	function do_print_step4(id_angkakredit, hd_id, nip) {
		
		$( "#dialog-print_step4" ).load("<?php echo base_url(); ?>angkakredit/print_step4/"+id_angkakredit+"/"+hd_id)
			.dialog({
			  autoOpen: false,
			  height: 600,
			  width: 800,
			  modal: true,
			  title: 'STEP 4 - PENETAPAN ANGKA KREDIT: '+ nip,
			  buttons: {				
				"Cetak": function() {
					w=window.open("","", "scrollbars=1,height=600, width=700");
					w.document.write($('#dialog-print_step4').html());
					w.print();
					w.close();					
					$( this ).dialog( "close" );
				},
				"Close": function() {
					$( this ).dialog( "close" );
				}
			 },
			  
		}); 
		$( "#dialog-print_step4" ).dialog( "open" );
		
		
		return false;
	}
	function do_print_pengantar4(id_angkakredit, hd_id, nip) {
		
		$( "#dialog-print_pengantar4" ).load("<?php echo base_url(); ?>angkakredit/print_pengantar4/"+id_angkakredit+"/"+hd_id)
			.dialog({
			  autoOpen: false,
			  height: 600,
			  width: 800,
			  modal: true,
			  title: 'PENGANTAR ANGKA KREDIT: '+ nip,
			  buttons: {				
				"Cetak": function() {
					w=window.open("","", "scrollbars=1,height=600, width=700");
					w.document.write($('#dialog-print_pengantar4').html());
					w.print();
					w.close();					
					$( this ).dialog( "close" );
				},
				"Close": function() {
					$( this ).dialog( "close" );
				}
			 },
			  
		}); 
		$( "#dialog-print_pengantar4" ).dialog( "open" );
		
		
		return false;
	}
	
	function hitung_total_lama(no_A, no_B){
		
		var curr_ak_lama = $('.total_ak_lama_'+no_A+'_'+no_B).val();
		var curr_ak_baru = $('.total_ak_baru_'+no_A+'_'+no_B).val();
		var all_sub_total_ak_AB = parseFloat(curr_ak_lama) + parseFloat(curr_ak_baru);		
		
		var all_sub_total_ak_AB_txt = number_format(all_sub_total_ak_AB,2,".",",");
		all_sub_total_ak_AB_txt = str_replace('.00','',all_sub_total_ak_AB_txt);
		
		$('.all_sub_total_ak_'+no_A+'_'+no_B).html(all_sub_total_ak_AB_txt);
		
		//total All lama
		var total_All = 0;
		$('.total_ak_lama').each(function(idx, xval){
			
			if(empty(xval.value)){
				xval.value = 0;
			}
			
			total_All += parseFloat(xval.value);
		});		
		
		var total_All_text = number_format(total_All,2,".",",");
		total_All_text = str_replace('.00','',total_All_text);		
		$('#all_total_ak_lama').text(total_All_text);
		
		
		var total_All_baru = 0;
		$('.total_ak_baru').each(function(idx, xval){
			
			if(empty(xval.value)){
				xval.value = 0;
			}
			
			total_All_baru += parseFloat(xval.value);
		});		
		
		var total_All_baru_text = number_format(total_All_baru,2,".",",");
		total_All_baru_text = str_replace('.00','',total_All_baru_text);		
		$('#all_total_ak_baru').text(total_All_baru_text);
				
		var total_All_lama_baru = total_All + total_All_baru;
		var total_All_lama_baru_text = number_format(total_All_lama_baru,2,".",",");
		total_All_lama_baru_text = str_replace('.00','',total_All_lama_baru_text);		
		$('#all_total_ak_lama_baru').text(total_All_lama_baru_text);
		
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
	<?php
	//get masakerja
		$masa_kerja_data = dateDifference($data_ak->tmt_pangkat, date('Y-m-d'));
		$masa_kerja_lama_tahun = $masa_kerja_data[0];
		$masa_kerja_lama_bulan = $masa_kerja_data[1];
		
	?>
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
				    	<h5>Pengajuan Angka Kredit: STEP 4 - PENETAPAN ANGKA KREDIT</h5>
						<h6>Masa Penilaian   :  <?php echo toInaPeriode($data_ak->periode_awal);?> s/d <?php echo toInaPeriode($data_ak->periode_akhir);?></h6>
			    	</div>
			    </div>
			     <!-- /page header -->
				
			    <?php $this->load->view('layout/_actionwrapper'); ?>

				<div>
					<form id="form-wizard4" class="form-horizontal row-fluid well" method="post" action="" >
						<input type="hidden" id="hd_id" name="hd_id" value="<?php echo $hd_id ?>"/>
						<input type="hidden" id="id_angkakredit" name="id_angkakredit" value="<?php echo $id_angkakredit ?>"/>
						
						
						<table cellpadding="4" border="1" style="margin:10px; width:98%;">
							<tr>
								<td><h6>I</h6></td>
								<td colspan="7"><h6>KETERANGAN PERORANGAN</h6></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td width="2%">1.</td>
								<td colspan="3" width="35%">N A M A</td>
								<td colspan="3">
								<?php 
			
								$data_pegawai->nama = ucwords(strtolower($data_pegawai->nama));
								if(!empty($data_pegawai->gelar_depan)){
									$data_pegawai->nama = $data_pegawai->gelar_depan.' '.$data_pegawai->nama;
								}
								if(!empty($data_pegawai->gelar_belakang)){
									$data_pegawai->nama = $data_pegawai->nama.' '.$data_pegawai->gelar_belakang;
								}
								
								echo $data_pegawai->nama;?>
								</td>
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
								<td colspan="3"><?php echo ucwords(strtolower($data_pegawai->tempat_lahir)).', '.toInaDate($data_pegawai->tanggal_lahir);?></td>
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
								<td colspan="3"><?php echo $data_ak->pangkat.' '.$data_ak->golongan.' '.date('d-m-Y',strtotime($data_ak->tmt_pangkat));?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>7.</td>
								<td colspan="3">Jabatan Dokter</td>
								<td colspan="3"><?php echo $data_ak->nama_jabatan;?></td>
							</tr>
							<tr>
								<td rowspan="2">&nbsp;</td>
								<td rowspan="2">8.</td>
								<td colspan="3">Masa Kerja Lama</td>
								<td colspan="3">
									<input type="text" id="masa_kerja_lama_tahun" name="masa_kerja_lama_tahun" value="<?php echo $data_ak->masa_kerja_lama_tahun ? $data_ak->masa_kerja_lama_tahun : $masa_kerja_lama_tahun;?>" onkeyup="NumberOnly(this)" class="input-small" /> Tahun &nbsp; &nbsp;
									<input type="text" id="masa_kerja_lama_bulan" name="masa_kerja_lama_bulan" value="<?php echo $data_ak->masa_kerja_lama_bulan ? $data_ak->masa_kerja_lama_bulan : $masa_kerja_lama_bulan;?>" onkeyup="NumberOnly(this)" class="input-small" /> Bulan &nbsp; &nbsp;
								</td>
							</tr>
							<tr>
								<td colspan="3">Masa Kerja Baru</td>
								<td colspan="3">
									<input type="text" id="masa_kerja_baru_tahun" name="masa_kerja_baru_tahun" value="<?php echo $data_ak->masa_kerja_baru_tahun;?>" onkeyup="NumberOnly(this)" class="input-small" /> Tahun &nbsp; &nbsp;
									<input type="text" id="masa_kerja_baru_bulan" name="masa_kerja_baru_bulan" value="<?php echo $data_ak->masa_kerja_baru_bulan;?>" onkeyup="NumberOnly(this)" class="input-small" /> Bulan &nbsp; &nbsp;
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>9.</td>
								<td colspan="3">Unit Kerja</td>
								<td colspan="3"><?php echo get_name('m_unit_kerja','nama_unit_kerja','kode_unit_kerja', $data_ak->unit_kerja);?></td>
							</tr>
							
							<tr>
								<td width="2%"><h6>II</h6></td>
								<td colspan="4"><h6>PENETAPAN ANGKA KREDIT</h6></td>
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
											$total_ak_baru_text .= '<input type="hidden" class="total_ak_baru total_ak_baru_'.$no_A.'_'.$no_B.'" name="total_ak_baru['.$no_A.']['.$no_B.']" value="'.$total_ak_baru.'" />';
											
											$total_ak_lama = 0;	
											$total_ak_lama_text = '';
											if(!empty($data_step4['total_ak_lama'][$no_A])){
											
												if(!empty($data_step4['total_ak_lama'][$no_A][$row2->id_uk])){
													$total_ak_lama = $data_step4['total_ak_lama'][$no_A][$row2->id_uk];													
												}
												//$total_ak_lama_text = number_format($total_ak_lama,2,".",",");
												$total_ak_lama_text .= '<input type="text" class="total_ak_lama total_ak_lama_'.$no_A.'_'.$no_B.'" onChange="hitung_total_lama('.$no_A.','.$no_B.')" name="total_ak_lama['.$no_A.']['.$no_B.']" value="'.$total_ak_lama.'" />';
												$all_total_ak_lama += $total_ak_lama;
												
											}else{
											
												$total_ak_lama_text = '<input type="text" class="total_ak_lama total_ak_lama_'.$no_A.'_'.$no_B.'" onChange="hitung_total_lama('.$no_A.','.$no_B.')" name="total_ak_lama['.$no_A.']['.$no_B.']"  />';
											
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
											
											$id_penetapan = 0;	
											if(!empty($data_step4['id_penetapan'][$no_A])){
												if(!empty($data_step4['id_penetapan'][$no_A][$row2->id_uk])){
													$id_penetapan = $data_step4['id_penetapan'][$no_A][$row2->id_uk];													
												}
											}
											
											?>
											<tr>
												<td>&nbsp;<input type="hidden" name="id_penetapan[<?php echo $no_A;?>][<?php echo $no_B;?>]" value="<?php echo $id_penetapan;?>" /></td>
												<td width="2%">&nbsp;</td>
												<td width="2%"><?php echo $bb; ?></td>
												<td colspan="2"><?php echo $row2->nama_uk; ?></td>
												<td align="center"><?php echo $total_ak_lama_text; ?></td>
												<td align="center"><?php echo $total_ak_baru_text; ?></td>
												<td align="center"><div class="all_sub_total_ak all_sub_total_ak_<?php echo $no_A.'_'.$no_B; ?>"><?php echo $jumlah_text; ?></div></td>
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
								<td align="center"><b><div id="all_total_ak_lama"><?php echo $all_total_ak_lama; ?></div></b></td>
								<td align="center"><b><div id="all_total_ak_baru"><?php echo $all_total_ak_baru; ?></div></b></td>
								<td align="center"><b><div id="all_total_ak_lama_baru"><?php echo $all_total_jumlah; ?></div></b></td>
							</tr>
							<tr>
								<td><h6>III</h6></td>
								<td colspan="7">
									<?php
									if(!empty($data_step4['hasil_penetapan'])){
										echo $data_step4['hasil_penetapan'];
									}									
									?>
								</td>
							</tr>
							
							
						</table>
						<br />
						<div class="control-group">
							<label class="control-label">No Penetapan Angka Kredit :</label>
							<div class="controls">
								<input type="text" id="no_pak" name="no_pak" class="input-xxlarge uppercase" value="<?php echo $data_ak->no_pak;?>"  />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Tanggal Penetapan :</label>
							<div class="controls">
								<?php
									if(!empty($data_ak->tanggal_pak)){
										$get_date = strtotime($data_ak->tanggal_pak);
										$data_ak->tanggal_pak = date('d-m-Y',$get_date);
									}else{
										$data_ak->tanggal_pak = '';
									}
								?>
									<input type="text" id="tanggal_pak" name="tanggal_pak" class="input-medium datepicker is_required" value="<?php echo $data_ak->tanggal_pak;?>"/>
								</div>
						</div>
						<?php
						$nama_pejabat_penetapan = '';
						if(!empty($data_ak->pejabat_penetapan)){
							$nama_pejabat_penetapan = $data_ak->pejabat_penetapan.' ('.$data_ak->nama_pejabat_penetapan.')';
						}
						?>
						<div class="control-group">
							<label class="control-label">Pejabat Penetapan :</label>
							<div class="controls">
								<input id="cek_pejabat_penetapan" type="text" name="cek_pejabat_penetapan" value="<?php echo $nama_pejabat_penetapan; ?>" class="input-xxlarge uppercase is_required" />
								<input type="hidden" name="pejabat_penetapan" id="pejabat_penetapan" value="<?php echo $data_ak->pejabat_penetapan; ?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Tembusan Penetapan :</label>
							<div class="controls">
								<textarea id="tembusan_penetapan" name="tembusan_penetapan" cols="100" rows="8"><?php echo $data_ak->tembusan_penetapan; ?></textarea>
							</div>
						</div>	
					</form>							
					<div class="form-actions">
						<button id="back-wizard4" class="btn btn-primary"> &laquo; STEP 3 - PERTIMBANGAN TIM PENILAI INSTANSI</button> &nbsp; &nbsp; 
						<button id="simpan-wizard4" class="btn btn-primary"> SIMPAN </button> &nbsp; 
						<button id="print-wizard4" class="btn btn-primary"> PRINT </button> &nbsp; 
						<button id="print_pengantar-wizard4" class="btn btn-primary"> PRINT PENGANTAR </button> &nbsp; 
						<button id="next-wizard4" class="btn btn-primary"> SELESAI &raquo;</button> 
						<div id="validasi-wizard4"></div>
					</div>	
					
				</div>
				
				<br />	 
		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		<div id="dialog-print_step4"></div>
		<div id="dialog-print_pengantar4"></div>
	</div>
	<!-- /content container -->
	
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>