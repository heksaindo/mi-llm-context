<!DOCTYPE html>
<html>
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head_tiny.php'); ?>
	
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
		                <li><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
						 <li><a href="<?php echo base_url(); ?>administrasipegawai" title="">Administrasi Pegawai</a></li>
						 <li><a href="<?php echo base_url(); ?>kenaikangajipegawai" title="">Kenaikan Gaji Berkala</a></li>
						 <li class="active"><a href="#" title="">Add Kenaikan Gaji Berkala</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
			    	</div>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                <?php
					if ($pegawai){
						
						$nip_baru = $pegawai['nip_baru'];
						if(!empty($pegawai['gelar_belakang'])){
							$nama = $pegawai['gelar_depan'].' '.ucwords(strtolower($pegawai['nama'])).', '.$pegawai['gelar_belakang'];
						}else{
							$nama = trim($pegawai['gelar_depan'].' '.ucwords(strtolower($pegawai['nama'])));
						}
						$daper = $pegawai['daper'];
						$id_pegawai = $pegawai['id_pegawai'];
						$jabatan = $pegawai['nama_jabatan'];
						$kantor = $pegawai['kantor'];
						$pangkat = $pegawai['gol_terakhir'].' - '.$pegawai['kepangkatan'];						
						$no_sk = $pegawai['no_sk'];
						$tanggal_sk = date('d-m-Y', strtotime($pegawai['tanggal_sk']));
						$pejabat = $pegawai['pejabat_penetapan'];
						$tmt_pangkat = date('d-m-Y', strtotime($pegawai['tmt_gol_terakhir']));
						
						$masa_kerja_tahun = $pegawai['masa_kerja_tahun'];
						$masa_kerja_bulan = $pegawai['masa_kerja_bulan'];
						
						//$masa_kerja_golongan = $masa_kerja_tahun.' Thn '.$masa_kerja_bulan.' Bln';
						//$gapok_lama = getGapok($pegawai['gol_terakhir'], $masa_kerja_tahun);
						$gapok_lama = number_format_nr($pegawai['gapok_lama']);
						$tmt_kepangkatan = date('d-m-Y', strtotime($tmt_pangkat));
						if($pegawai['tmt_kgb_terakhir'] !=''){
							if(strtotime($pegawai['tmt_gol_terakhir']) < strtotime($pegawai['tmt_kgb_terakhir'])){
								$tmt_kepangkatan = date('d-m-Y', strtotime($pegawai['tmt_kgb_terakhir']));
							}
						}
						//Baru
						$golongan = nextGolongan($pegawai['gol_terakhir']);
						//$new_golongan = $golongan .' - '.get_name('m_golongan','nama_golongan','kode_golongan', $golongan);
						$masa_kerja = $masa_kerja_tahun;
						$tgl_laku = date("d-m-Y",strtotime($tmt_kepangkatan.' +2 years'));
						if($masa_kerja_bulan>0){
							$tanggal_berlaku2 = date("d-m-Y",strtotime($tgl_laku.' -'.$masa_kerja_bulan.' month'));
						}else{
							$tanggal_berlaku2 = $tgl_laku;
						}
						//$gapok_baru = getGapok($golongan, $masa_kerja);
						
						$gapok_data = getGapokNew($pegawai['gol_terakhir'], $masa_kerja_tahun, $masa_kerja_bulan);
						$xdata = explode('#', $gapok_data);
						$gapok_baru = number_format_nr($xdata[0]);
						$new_golongan = $xdata[1];
						
						$masa_kerja_gol_tahun = $masa_kerja_tahun;
						$masa_kerja_gol_bulan = $masa_kerja_bulan;
						$new_masa_kerja_tahun = $xdata[2];
						$new_masa_kerja_bulan = $xdata[3];
						
					}else {
						$nip_baru = '';
						$nama = '';
						$id_pegawai = '';
						$jabatan = '';
						$kantor = '';
						$pangkat = '';
						$gapok_lama = '';
						$no_sk = '';
						$daper = '';
						$tanggal_sk = '';
						$pejabat = '';
						$tmt_kepangkatan = '';
						$masa_kerja_gol_tahun = '';
						$masa_kerja_gol_bulan = '';
						$new_masa_kerja_tahun = '';
						$new_masa_kerja_bulan = '';
						$new_golongan = '';
						$gapok_baru = '';
						$tanggal_berlaku2 = '';
					}
				?>
				
				 <div class="widget">
					 <div class="navbar">
						<div class="navbar-inner">
							<h6>Add Kenaikan Gaji Berkala</h6>
						</div>
					</div>
					<form id="form-wizard-kgp" class="form-horizontal row-fluid well" method="post" >
						<div id="form-wizard-1" class="step">
							<div class="step-title">
								<i>1</i>
								<h5>Data Pegawai</h5>
								<span>Data 1</span>
							</div>
							<div class="control-group">
								<label class="control-label">NIP</label>
								<div class="controls">
									<input id="nip_baru" type="text" name="nip_baru" class="input-xlarge" value="<?php echo $nip_baru ?>" />
									<input type="hidden" id="id_pegawai" name="id_pegawai" value="<?php echo $id_pegawai;?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Nama</label>
								<div class="controls">
									<input id="nama" type="text" name="nama" class="input-xlarge" value="<?php echo $nama ?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Pangkat</label>
								<div class="controls">
									<input id="pangkat" type="text" name="pangkat" class="input-xlarge" value="<?php echo $pangkat ?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Jabatan</label>
								<div class="controls">
									<input id="jabatan" type="text" name="jabatan" class="input-xlarge" value="<?php echo $jabatan ?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Kantor</label>
								<div class="controls">
									<input id="kantor" type="text" name="kantor" class="input-xlarge" value="<?php echo $kantor ?>" />
								</div>
							</div>
						</div>
						<div id="form-wizard-2" class="step">
							<div class="step-title">
								<i>2</i>
								<h5>Draft Cetak Surat Keputusan</h5>
								<span>Data 2</span>
							</div>
							<div class="control-group">
								<label class="control-label">Nomor Surat</label>
								<div class="controls">
									<input id="no_surat" type="text" name="no_surat" class="input-xlarge" value="" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Ditujukan Kepada</label>
								<div class="controls">
									<input id="kepada" type="text" name="kepada" class="input-xlarge" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Jabatan Penandatangan</label>
								<div class="controls">
									<input id="ttd" type="hidden" name="ttd" />
									<select id="jabatan_ttd" name="jabatan_ttd" class="input-xlarge selectpicker">
										<option value=""></option>
										<?php
											foreach($data_jabatan_ttd as $row){
												$selected = '';	
												
												echo "<option value='".$row->id_jabatan."' ".$selected.">".$row->nama_jabatan."</option>";
											}
										?>
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Nama Penandatangan</label>
								<div class="controls">
									<input id="nama_ttd" type="text" name="nama_ttd" class="input-xlarge" value="" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">NIP Penandatangan</label>
								<div class="controls">
									<input id="nip_ttd" type="text" name="nip_ttd" class="input-xlarge" value="" />
									<input id="id_ttd" type="hidden" name="id_ttd"/>
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Tembusan</label>
								<div class="controls">
									<textarea id="tembusan" name="tembusan" class="input-xxlarge tinymce" rows="4">
										<p class=MsoNormal style='margin-left:.25in;text-indent:-.25in'><span lang=SV
											style='font-size:11.5pt;font-family:"Arial Narrow","sans-serif"'>1.<span
											style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span
											lang=SV style='font-size:11.5pt;font-family:"Arial Narrow","sans-serif"'>Kepala
											Badan Kepegawaian Negara di Jakarta ;</span></p>

											<p class=MsoNormal style='margin-left:.25in;text-indent:-.25in'><span lang=SV
											style='font-size:11.5pt;font-family:"Arial Narrow","sans-serif"'>2.<span
											style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span
											lang=SV style='font-size:11.5pt;font-family:"Arial Narrow","sans-serif"'>Kepala
											Biro Kepegawaian Set.Jen. Kemenkes RI di Jakarta ;</span></p>

											<p class=MsoNormal style='margin-left:.25in;text-indent:-.25in'><span lang=SV
											style='font-size:11.5pt;font-family:"Arial Narrow","sans-serif"'>3.<span
											style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span
											lang=SV style='font-size:11.5pt;font-family:"Arial Narrow","sans-serif"'>Direksi
											PT. TASPEN Jln. Letjen Suprapto di Jakarta ;</span></p>

											<p class=MsoNormal style='margin-left:.25in;text-indent:-.25in'><span lang=SV
											style='font-size:11.5pt;font-family:"Arial Narrow","sans-serif"'>4.<span
											style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span
											lang=SV style='font-size:11.5pt;font-family:"Arial Narrow","sans-serif"'>Direktur
											</span><span
											lang=SV style='font-size:11.5pt;font-family:"Arial Narrow","sans-serif"'>Bina
											Pelayanan Penunjang Medik dan Sarana Kesehatan Direktorat Jenderal Bina Upaya
											Kesehatan</span><span lang=SV style='font-size:11.5pt;font-family:"Arial Narrow","sans-serif"'>
											di </span><span
											lang=SV style='font-size:11.5pt;font-family:"Arial Narrow","sans-serif"'>Jakarta</span><span
											lang=SV style='font-size:11.5pt;font-family:"Arial Narrow","sans-serif"'> ;</span></p>

											<p class=MsoNormal style='margin-left:.25in;text-indent:-.25in'><span lang=SV
											style='font-size:11.5pt;font-family:"Arial Narrow","sans-serif"'>5.<span
											style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span
											lang=SV style='font-size:11.5pt;font-family:"Arial Narrow","sans-serif"'>Pejabat
											Pembuat Daftar Gaji Direktorat Jenderal Bina Upaya Kesehatan di Jakarta ;</span></p>

											<p class=MsoNormal style='margin-left:.25in;text-indent:-.25in'><span lang=SV
											style='font-size:11.5pt;font-family:"Arial Narrow","sans-serif"'>6.<span
											style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span
											lang=SV style='font-size:11.5pt;font-family:"Arial Narrow","sans-serif"'>Yang
											bersangkutan. </span>
										</p>
									</textarea>
								</div>
							</div>
						</div>
						<div id="form-wizard-3" class="step">
							<div class="step-title">
								<i>3</i>
								<h5>Data Surat Keputusan Sebelumnya</h5>
								<span>Data 3</span>
							</div>
							
							<div class="control-group">
								<label class="control-label">Gaji Pokok Lama</label>
								<div class="controls">
									<input id="gapok_lama" type="text" name="gapok_lama" onkeyup="NumberOnly(this)" class="input-xlarge" value="<?php echo $gapok_lama ?>"  />
								</div>
							</div>
						   <div class="control-group">
								<label class="control-label">Ditetapkan Oleh</label>
								<div class="controls">
									<input id="pejabat_penetapan" type="text" name="pejabat_penetapan" class="input-xlarge" value="<?php echo $pejabat ?>" />		
									
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">No SK</label>
								<div class="controls">
									<input id="no_sk" type="text" name="no_sk" class="input-xlarge" value="<?php echo $no_sk ?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Tanggal</label>
								<div class="controls">
									<input id="tanggal_sk" type="text" name="tanggal_sk" class="input-medium datepicker" value="<?php echo $tanggal_sk ?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">T M T</label>
								<div class="controls">
									<input id="tanggal_berlaku" type="text" name="tanggal_berlaku" class="input-medium datepicker" value="<?php echo $tmt_kepangkatan ?>" />
									<input id="tmt_gol" type="hidden" name="tmt_gol" class="input-medium datepicker" value="<?php echo $tmt_pangkat;?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Masa Kerja Golongan</label>
								<div class="controls">
									<input id="masa_kerja_gol_tahun" type="text" name="masa_kerja_gol_tahun" class="input-small" value="<?php echo $masa_kerja_gol_tahun ?>" /> Tahun &nbsp;
									<input id="masa_kerja_gol_bulan" type="text" name="masa_kerja_gol_bulan" class="input-small" value="<?php echo $masa_kerja_gol_bulan ?>" /> Bulan
								</div>
							</div>
						</div>
						<div id="form-wizard-4" class="step">
							<div class="step-title">
								<i>4</i>
								<h5>Data Kenaikan Gaji Berkala</h5>
								<span>Data 4</span>
							</div>
							<div class="control-group">
								<label class="control-label">Golongan</label>
								<div class="controls">
									<!--<select id="golongan" name="golongan" class="input-small">
										<option><?php/* echo $new_golongan*/ ?></option>
									</select>-->
										
										<?php
											$query = $this->db->query("SELECT kdkelgapok FROM m_golongan WHERE kode_golongan = '$new_golongan' ");
											$row = $query->row();
										?>
										<input id="golongan" type="text" name="golongan" class="input-xlarge" value="<?php echo $new_golongan ?>"/> (Auto Complete)
										<input id="golongan_kd" type="hidden" name="golongan_kd" value="<?php echo $row->kdkelgapok;?>">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Berdasar Masa Kerja</label>
								<div class="controls">
									<input id="new_masa_kerja_tahun" type="text" name="new_masa_kerja_tahun" class="input-small" value="<?php echo $new_masa_kerja_tahun ?>" /> Tahun &nbsp;
									<input id="new_masa_kerja_bulan" type="text" name="new_masa_kerja_bulan" class="input-small" value="0<?php //echo $new_masa_kerja_bulan ?>" /> Bulan
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Dasar Peraturan</label>
								<div class="controls">
									<input type="hidden" id="dasar_peraturan" name="dasar_peraturan" value="<?php echo $daper;?>"/>
									<select id="dasar_per" name="dasar_per" class="selectpicker">
										<?php
											$op = '<option value="">- Pilih Dasar Peraturan -</option>';
											//$r_gol = getgolongan($new_golongan);
											$db = $this->db->from('m_gapok')->where('kdkelgapok',$daper)->get();
											foreach($db->result() as $gol){
												$gapok = number_format_nr($gol->gapok);
												if($gol->daper != ""){
													if($gol->daper==$daper){
														$op .='<option value="'.$gol->id_gapok.'#'.$gapok.'#'.$gol->daper.'" selected>'.$gol->daper.'</option>';
													}else{
														$op .='<option value="'.$gol->id_gapok.'#'.$gapok.'#'.$gol->daper.'">'.$gol->daper.'</option>';
													}
												}
											 }
											echo $op;
										?>
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Gaji Pokok Baru</label>
								<div class="controls">
									<input id="gapok_baru" type="text" name="gapok_baru" onkeyup="NumberOnly(this)" class="input-xlarge" value="<?php echo $gapok_baru ?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">T M T</label>
								<div class="controls">
									<input id="tanggal_berlaku2" type="text" name="tanggal_berlaku2" class="input-medium datepicker" value="<?php echo $tanggal_berlaku2 ?>"/>
								</div>
							</div>
						</div>
					</form>
					
					<div id="form-wizard-3" class="step">
						<div class="step-title">
							<i>5</i>
							<h5>Dokumen Penunjang</h5>
							<span>Data 5</span>
						</div>
						<div class="table-overflow">
							
							<table id="list-rdokumen" class="table table-striped table-bordered table-checks media-table">
								<thead>
									<tr>
										<th>No</th>
										<th>Tipe Dokumen</th>
										<th>File Tersedia</th>
										<th></th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
					
					<div class="form-actions">
						<a href="<?php echo base_url().'kenaikangajipegawai'; ?>" class="btn btn-primary" title="List"><< Back</a>
						<button id="simpan-kgp" class="btn btn-primary">Simpan</button>
						<div id="validasi-kgp"></div>
					</div>
			</div>
				 

		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		
	</div>
	<!-- /content container -->
	
<div id="dialog-rdokumen" title=""> 
	<form id="form-popup4" method="post" action=""  enctype="multipart/form-data">
		<input type="hidden" id="id_rdokumen" name="id_rdokumen" value="" />
		<input type="hidden" id="nip_baru4" name="nip_baru4" value="<?php echo $nip_baru ?>" />
		<table>
			<tr>
				<td>Tipe Dokumen</td>
				<td>:</td>
				<td>
					<input id="tipe_dokumen4_txt" type="text" name="tipe_dokumen4_txt" readonly class="input-xlarge is_required" />
					<input id="tipe_dokumen4" type="hidden" name="tipe_dokumen4" />
					
				</td>
			</tr>
			<tr>
				<td>Nama Dokumen</td>
				<td>:</td>
				<td>
					<input id="nama_dokumen4" type="text" name="nama_dokumen4" class="input-xlarge is_required" />
				</td>
			</tr>
			<tr>
				<td>Upload Dokumen</td>
				<td>:</td>
				<td>
					<span id="filename4_txt"></span>
					<br />
					<input id="filename4" type="file" name="filename4" accept="application/pdf" class="input-medium" />
				
				</td>
			</tr>
			
		</table>	
	</form>
</div>

	
	<?php $this->load->view('layout/_footer'); ?>
	
<script type="text/javascript"> 	
		
	$(document).ready(function(){
		$( "#dialog-rdokumen" ).hide();
		var id_pegawai = $( "#id_pegawai" ).val();
		$('.selectpicker').selectBoxIt();
		oTable_rdokumen = $('table#list-rdokumen').dataTable({
			//"iDisplayLength": 25,
			"aaSorting": [[ 0, 'desc']],
			"oLanguage": {
			  "sEmptyTable": "No data yet!"
			},
			"bPaginate": false,
			"bLengthChange": false,
			"bFilter": false,
			"bSort": false,
			"bInfo": false,
			"bAutoWidth": true,
			"bServerSide": true,
			"bProcessing": true,
			"sAjaxSource": "<?php echo base_url(); ?>kenaikangajipegawai/ajax_rdokumen/edit/",
			"fnServerData": function(sSource,aoData,fnCallback)
			{
				aoData.push({name: "id_pegawai", value: $('#id_pegawai').val() });
				$.ajax({
					"dataType": 'json', 
					"type": "POST", 
					"url": sSource, 
					"data": aoData, 
					"success": fnCallback
				});
			}
				
		});
		
		
		/*$('#dasar_peraturan').on('change', function(){
			var gapok_baru = $(this).find(':selected').data('gapok');
			$('#gapok_baru').val(gapok_baru);
			});*/
		$("select#dasar_per").bind({
			"changed": function(ev, obj) {
				var v = $(this).val();
				var val = v.split("#");
				$('#dasar_peraturan').val(val[2]);
				$('#gapok_baru').val(val[1]);
			}
		});
		$('#new_masa_kerja_tahun').on('change', function(){
			var mkt = $(this).val(); // 11
			var mkg_lama = $("[name='tanggal_berlaku']").val(); // tmt lama
			var tahun_lama = mkg_lama.split("-");
			
			var mkg_baru = $("[name='tanggal_berlaku2']").val(); 
			var mkgt = $("[name='masa_kerja_gol_tahun']").val(); // mkg lama 
			date = mkg_baru.split("-");
			date[2] = parseInt(tahun_lama[2]) + parseInt(mkt) - parseInt(mkgt);
			//console.log(date[2]);
			new_tmt = date[0]+"-"+date[1]+"-"+date[2];
			
			$("[name='tanggal_berlaku2']").val(new_tmt);
		});
		
		//$('#new_masa_kerja_tahun').keydown(function(){
		//	cek_gol_baru();
		//});
		//
		
		$( "#simpan-kgp" ).click(function(){
			//no_surat, kepada, jabatan_ttd, nama_ttd, nip_ttd, tembusan, gapok_baru, masa_kerja, golongan, tanggal_berlaku2
			var err = 0;
			var pejabat_penetapan = $( "#pejabat_penetapan" ).val(); 
			var no_surat = $( "#no_surat" ).val(); 
			var kepada = $( "#kepada" ).val(); 
			var jabatan_ttd = $( "#jabatan_ttd" ).val(); 
			var nama_ttd = $( "#nama_ttd" ).val(); 
			var nip_ttd = $( "#nip_ttd" ).val(); 
			var gapok_baru = $( "#gapok_baru" ).val(); 
			var masa_kerja_gol_tahun = $( "#masa_kerja_gol_tahun" ).val(); 
			var masa_kerja_gol_bulan = $( "#masa_kerja_gol_bulan" ).val(); 
			var new_masa_kerja_tahun = $( "#new_masa_kerja_tahun" ).val(); 
			var new_masa_kerja_bulan = $( "#new_masa_kerja_bulan" ).val(); 
			var golongan = $( "#golongan" ).val(); 
			var tanggal_berlaku2 = $( "#tanggal_berlaku2" ).val(); 
			
			if(pejabat_penetapan === ''){
				$( "#pejabat_penetapan" ).addClass("invalid");
				err = 1;
			}
			//if(no_surat == ''){
			//	$( "#no_surat" ).addClass("invalid");
			//	err = 1;
			//}		
			if(kepada === ''){
				$( "#kepada" ).addClass("invalid");
				err = 1;
			}
			if(jabatan_ttd === ''){
				$( "#jabatan_ttd" ).addClass("invalid");
				err = 1;
			}
			if(nama_ttd === ''){
				$( "#nama_ttd" ).addClass("invalid");
				err = 1;
			}
			if(nip_ttd === ''){
				$( "#nip_ttd" ).addClass("invalid");
				err = 1;
			}
			if(gapok_baru === ''){
				$( "#gapok_baru" ).addClass("invalid");
				err = 1;
			}
			if(masa_kerja_gol_tahun === ''){
				$( "#masa_kerja_gol_tahun" ).addClass("invalid");
				err = 1;
			}
			if(new_masa_kerja_tahun === ''){
				$( "#new_masa_kerja_tahun" ).addClass("invalid");
				err = 1;
			}
			if(golongan === ''){
				$( "#golongan" ).addClass("invalid");
				err = 1;
			}
			if(tanggal_berlaku2 === ''){
				$( "#tanggal_berlaku2" ).addClass("invalid");
				err = 1;
			}
			//alert(err);
			if(err === 0){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>kenaikangajipegawai/insert",
					data: $('#form-wizard-kgp').serialize(), 
					success: function(msg){	
						if(msg == 'success'){			
							$( "#validasi-kgp" ).html( '<font color="blue"> Data sudah disimpan</font>' );						
							var r = confirm("Klik Ok untuk ke halaman rekap KGP atau Klik Cancel untuk kembali ke Ewars");
							if (r === true) {
								window.location.assign("<?php echo base_url().'laporan/kgp'; ?>");
							} else {
								window.location.assign("<?php echo base_url().'kenaikangajipegawai'; ?>");
							}											
						}else{
							$( "#validasi-kgp" ).html( '<font color="red"> Data tidak dapat disimpan, coba lagi!</font>' );	
						}
						return false;
					}
				});
			}else{
				$( "#validasi-kgp" ).html( '<font color="red"> Input salah, silahkan cek input warna merah!</font>' );	
			}
		});
		
		$('#nama_ttd').val('');
		$('#jabatan_ttd').val('');
		
		$("#golongan").autocomplete("<?php echo base_url(); ?>kenaikangajipegawai/auto_golongan/", {
			width: 250,
			minChars:1,
			max:100,
			selectFirst: false,
			
		});
		
		$("#golongan").result(function(event, data, formatted) {
			if (data){
				$("#golongan").val(data[0]);
				$("#golongan_kd").val(data[1]);
				cek_gol_baru();
			}
		});
		
		$("#new_masa_kerja_tahun").autocomplete("<?php echo base_url(); ?>kenaikangajipegawai/auto_tahun/", {
			width: 200,
			minChars:1,
			max:100,
			selectFirst: false,
			
			
		});
		
		$("#new_masa_kerja_tahun").result(function(event, data, formatted) {
			if (data){
				$("#new_masa_kerja_tahun").val(data[0]);
				cek_tmt_baru(data[0],data[1]);
			}
		});
		
		$('#jabatan_ttd').change(function(){
			//$('#nama_ttd').val('');
			jabatan_ttd = $('#jabatan_ttd option:selected').val();
			$('#ttd').val(jabatan_ttd);
			
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>kenaikangajipegawai/get_tandatangan",
				data: 'jabatan_ttd='+jabatan_ttd, 
				success: function(msg){	
					if(msg){			
						var data = explode('|', msg);
						$("#nip_ttd").val(data[0]);		
						$("#nama_ttd").val(data[1]);
						$("#id_ttd").val(data[2]);
					}else{
						$("#nip_ttd").val('');		
						$("#nama_ttd").val('');
						$("#id_ttd").val('');
					}
					return false;
				}
			});
			
		});
		
	});

	
//===Dokumen===	
function onAddrdokumen(id_tipe_dokumen, tipe_dokumen) {
	open_dialog_rdokumen(id_tipe_dokumen, 'Add Dokumen', '', tipe_dokumen);
}
function onEditrdokumen(id_tipe_dokumen, tipe_dokumen, id) {
	open_dialog_rdokumen(id_tipe_dokumen, 'Add Dokumen', id, tipe_dokumen);
}


function open_dialog_rdokumen(id_tipe_dokumen, titlex, id, tipe_dokumen) {
	
	if(id > 0){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/cek_edit_rdokumen/"+id,
			data: $('#form-popup4').serialize(), 
			success: function(data){	
				var dt2 = explode('|', data);
				$( "#tipe_dokumen4" ).val( dt2[1] );
				$( "#nama_dokumen4" ).val( dt2[2] );
				$( "#filename4" ).val( '' );
				$( "#filename4_txt" ).html( dt2[3] );
				$( "#tipe_dokumen4_txt" ).val( tipe_dokumen );
				
			}
		});
	}else{
		$( "#nama_dokumen4" ).val( "" );
		$( "#filename4" ).val( "" );
		$( "#filename4_txt" ).html( "" );
		$( "#tipe_dokumen4" ).val( id_tipe_dokumen );
		$( "#tipe_dokumen4_txt" ).val( tipe_dokumen );
	}
	
	$( "#dialog-rdokumen" ).dialog({
		  autoOpen: false,
		  height: 250,
		  width: 450,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				var nama_dokumen4 = $( "#nama_dokumen4" ).val(); 
				var tipe_dokumen4 = $( "#tipe_dokumen4" ).val(); 
				var filename4 = $( "#filename4" ).val(); 
				var id_pegawai = $( "#id_pegawai" ).val();
				if(nama_dokumen4 === ''){
					$( "#nama_dokumen4" ).addClass("invalid");
					bValid = false;
				}		
				if(tipe_dokumen4 === ''){
					$( "#tipe_dokumen4" ).addClass("invalid");
					bValid = false;
				}		
	
			  if ( bValid ) {
					$( "#nama_dokumen4" ).removeClass("invalid");		
					$( "#tipe_dokumen4" ).removeClass("invalid");	
					var tipe = $( "#tipe_dokumen4" ).val();
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>pegawai/do_popup_rdokumen/"+id,
					data: $('#form-popup4').serialize() + "&filename4="+filename4 + "&id_pegawai="+id_pegawai, 
					success: function(msg){	
						datax = explode('#', msg);
						if(datax[0] == 'success'){		
							ajaxDocumentUpload(datax[1],tipe);		
						}else{
							alert( 'Data tidak dapat disimpan, cek input!' );	
						}						
					}
				});
				
				$( this ).dialog( "close" );	
			  }
			},
			"Batal": function() {
			  $( this ).dialog( "close" );
			}
		 },
		  
	}); 
	
	$( "#dialog-rdokumen" ).dialog( "open" );
	
}

function ajaxDocumentUpload(id,tipe) {
	
	var hd_id = $( "#id_pegawai" ).val(); 
	$("#loading")
	.ajaxStart(function(){
		$(this).show();
	})
	.ajaxComplete(function(){
		$(this).hide();
	});
	
	$.ajaxFileUpload
	(
		{
			url:'<?php echo base_url(); ?>pegawai/do_popup_rdokumen/'+id,
			secureuri:false,
			fileElementId:'filename4',
			dataType : 'JSON',
			data:{id:hd_id,tipe:tipe},
			success: function (msg)
			{
				datax = explode('#', msg);
				if(datax[0] != 'success')
				{
					alert('Upload Gagal!');
				}else{
					oTable_rdokumen.fnDraw();
				}
			},
			error: function (data, status, e)
			{
				//alert(e);
			}
		}
	)
}
function cek_gol_baru(){
	var kdkelgapok = $("[name='new_masa_kerja_tahun']").val(),
		golongan = $("#golongan_kd").val();;
	
	$.ajax({
		type: "POST",
		url: "<?php echo base_url(); ?>kenaikangajipegawai/cek_gol_baru",
		data: "golongan="+golongan+"&kdkelgapok="+kdkelgapok, 
		success: function(msg){	
			$("[name='dasar_per']").html(msg);
			$("[name='dasar_peraturan']").val('');
			var selectBox = $("select#dasar_per").data("selectBox-selectBoxIt");
			selectBox.refresh();
		}
	});
}
function cek_tmt_baru(kdgapok){
	var kdkelgapok = $("[name='golongan_kd']").val();
	$.ajax({
		type: "POST",
		url: "<?php echo base_url(); ?>kenaikangajipegawai/cek_tmt_baru",
		data: "kdgapok="+kdgapok+"&kdkelgapok="+kdkelgapok, 
		success: function(msg){	
			$("[name='dasar_per']").html(msg);
			$("[name='dasar_peraturan']").val('');
			var selectBox = $("select#dasar_per").data("selectBox-selectBoxIt");
			selectBox.refresh();
		}
	});
}
	
</script>	
	
</body>
</html>