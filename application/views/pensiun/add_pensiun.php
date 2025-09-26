<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head_tiny.php'); ?>
	
<script type="text/javascript"> 	

	$(document).ready(function(){
	
		$( "#dialog-rdokumen" ).hide();
		var id_pegawai = $( "#id_pegawai" ).val();
		
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
			"sAjaxSource": "<?php echo base_url(); ?>pensiun/ajax_rdokumen/edit/",
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
		
		$('#nama_ttd').val('');
		$('#jabatan_ttd').val('');
		
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
					}else{
						$("#nip_ttd").val('');		
						$("#nama_ttd").val('');	
					}
					return false;
				}
			});
			
		});
		
	
		$( "#simpan-pensiun" ).click(function(){
			//kepada, jabatan_ttd, nama_ttd, nip_ttd, tembusan
			var err = 0;
			var kepada = $( "#kepada" ).val(); 
			var jabatan_ttd = $( "#jabatan_ttd" ).val(); 
			var nama_ttd = $( "#nama_ttd" ).val(); 
			var nip_ttd = $( "#nip_ttd" ).val(); 
			var tmt_pensiun = $("#tmt_pensiun").val();
			var bup = $( "#bup" ).val();
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
			if(tmt_pensiun === ''){
				$( "#tmt_pensiun" ).addClass("invalid");
				err = 1;
			}
			if(bup === ''){
				$( "#bup" ).addClass("invalid");
				err = 1;
			}
			//alert(err);
			if(err === 0){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>pensiun/insert",
					data: $('#form-wizard').serialize(), 
					success: function(msg){	
						if(msg == 'success'){			
							$( "#validasi-pensiun" ).html( '<font color="blue"> Data sudah disimpan</font>' );						
							window.location.assign("<?php echo base_url().'pensiun/'; ?>");											
						}else{
							$( "#validasi-pensiun" ).html( '<font color="red"> Data tidak dapat disimpan, coba lagi!</font>' );	
						}
						return false;
					}
				});
			}else{
				$( "#validasi-pensiun" ).html( '<font color="red"> Input salah, silahkan cek input warna merah!</font>' );	
			}
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
				if(nama_dokumen4 == ''){
					$( "#nama_dokumen4" ).addClass("invalid");
					bValid = false;
				}		
				if(tipe_dokumen4 == ''){
					$( "#tipe_dokumen4" ).addClass("invalid");
					bValid = false;
				}		
	
			  if ( bValid ) {
					$( "#nama_dokumen4" ).removeClass("invalid");		
					$( "#tipe_dokumen4" ).removeClass("invalid");	
					var tipe = $("#tipe_dokumen4").val();
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
			success: function (data, status)
			{
				if(status != 'success')
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
	
	return false;
}

</script>	
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
						 <li class="active"><a href="<?php echo base_url(); ?>pensiun" title="">Pensiun Pegawai</a></li>
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
					if ($data_pegawai){
					foreach ($data_pegawai as $pegawai){
						$nip = $pegawai['nip_baru'];
						if(!empty($pegawai['gelar_belakang'])){
							$nama = $pegawai['gelar_depan'].' '.ucwords(strtolower($pegawai['nama'])).', '.$pegawai['gelar_belakang'];
						}else{
							$nama = trim($pegawai['gelar_depan'].' '.ucwords(strtolower($pegawai['nama'])));
						}
						
						$pangkat = $pegawai['pangkat'];
						$golongan = $pegawai['golongan'];
						$jabatan = $pegawai['jabatan'];
						$kantor = $pegawai['kantor'];
						$id_pegawai = $pegawai['id_pegawai'];
						$bup = $pegawai['bup'];
						$tmt_pensiun = date("d-m-Y",strtotime($pegawai['tmt_pensiun']));
					}
					}else {
						$nip = '';
						$nama = '';
						$pangkat = '';
						$golongan = '';
						$jabatan = '';
						$kantor = '';
						$id_pegawai = '';
						$bup = '';
						$tmt_pensiun = '';
					}
				?>
				
				 <div class="widget">
					 <div class="navbar">
						<div class="navbar-inner">
							<h6>Add Pensiun</h6>
						</div>
					</div>
					<form id="form-wizard" class="form-horizontal row-fluid well" method="post" action="" >
						<div id="form-wizard-1" class="step">
							<div class="step-title">
								<i>1</i>
								<h5>Data Pegawai</h5>
								<span>Data 1</span>
							</div>
							<div class="control-group">
								<label class="control-label">NIP</label>
								<div class="controls">
									<input id="nip" type="text" name="nip" class="input-xlarge" value="<?php echo $nip ?>" />
									<input type="hidden" name="id_pegawai" id="id_pegawai" value="<?php echo $id_pegawai; ?>" />
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
									<input id="golongan" type="hidden" name="golongan" value="<?php echo $golongan ?>" />
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
							<div class="control-group">
								<label class="control-label">TMT Pensiun</label>
								<div class="controls">
									<input type="text" name="tmt_pensiun" id="tmt_pensiun" class="input-medium datepicker" value="<?php echo $tmt_pensiun; ?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">BUP</label>
								<div class="controls">
									<input type="text" name="bup" id="bup" class="input-small" value="<?php echo $bup; ?>" /> ( Tahun )
								</div>
							</div>
						</div>
						<div id="form-wizard-2" class="step">
							<div class="step-title">
								<i>2</i>
								<h5>Draft Cetak Surat Pensiun</h5>
								<span>Data 2</span>
							</div>
						   <div class="control-group">
								<label class="control-label">Kepada</label>
								<div class="controls">
									<input id="kepada" type="text" name="kepada" class="input-xlarge" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Jabatan Penandatangan</label>
								<div class="controls">
									<input id="ttd" type="hidden" name="ttd" />
									<select id="jabatan_ttd" name="jabatan_ttd" class="input-xlarge">
										<option value=""></option>
										<?php
											foreach($data_jabatan_ttd as $row){
												$selected = '';	
												if(strtoupper($data_kp->jabatan_ttd) == strtoupper($row->id_jabatan)){
													$selected =  'selected = "selected"'; 
												}
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
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Tembusan</label>
								<div class="controls">
									<textarea id="tembusan" name="tembusan" class="input-xxlarge tinymce" rows="4">
										<p class=MsoNormal><span lang=SV style='font-family:"Arial Narrow","sans-serif"'>1.
										</span><span
										lang=SV style='font-family:"Arial Narrow","sans-serif"'>Direktur Jenderal Bina
										Upaya Kesehatan di Jakarta ;</span></p>

										<p class=MsoNormal><span lang=SV style='font-family:"Arial Narrow","sans-serif"'>2.
										</span><span
										lang=SV style='font-family:"Arial Narrow","sans-serif"'>Kepala Badan
										Kepegawaian Negara di Jakarta ;</span></p>

										<p class=MsoNormal style='text-align:justify'><span lang=SV style='font-family:
										"Arial Narrow","sans-serif"'>3. </span><span
										lang=SV style='font-family:"Arial Narrow","sans-serif"'>Kabag. Hukum,
										Organisasi dan Humas</span><span lang=SV style='font-family:"Arial Narrow","sans-serif"'>
										di </span><span
										lang=SV style='font-family:"Arial Narrow","sans-serif"'>Jakarta</span><span
										lang=SV style='font-family:"Arial Narrow","sans-serif"'> ;</span></p>

										<p class=MsoNormal><span lang=SV style='font-family:"Arial Narrow","sans-serif"'>4.
										</span><span
										lang=SV style='font-family:"Arial Narrow","sans-serif"'>Yang bersangkutan.</span></p>
									</textarea>
								</div>
							</div>
						</div>
					<!--	<div id="form-wizard-3" class="step">
							<div class="step-title">
								<i>3</i>
								<h5>Data Surat Keputusan</h5>
								<span>Data 3</span>
							</div>
						   <div class="control-group">
								<label class="control-label">Pejabat Penetapan</label>
								<div class="controls">
									<input id="pejabat_penetapan" type="text" name="pejabat_penetapan" class="input-xlarge" value="" />		
									
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Tanggal SK</label>
								<div class="controls">
									<input id="tanggal_sk" type="text" name="tanggal_sk" class="input-medium datepicker" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">No SK</label>
								<div class="controls">
									<input id="no_sk" type="text" name="no_sk" class="input-xlarge" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Masa Kerja Golongan</label>
								<div class="controls">
									<input id="masakerja" type="text" name="masakerja" class="input-xlarge" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Tanggal Mulai Berlaku</label>
								<div class="controls">
									<input id="tanggalberlaku" type="text" name="tanggalberlaku" class="input-medium datepicker" />
								</div>
							</div>
						</div>-->
						
						</form>
						
						<div id="form-wizard-4" class="step">
							<div class="step-title">
								<i>3</i>
								<h5>Dokumen Penunjang</h5>
								<span>Data 3</span>
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
						<a href="<?php echo base_url().'pensiun'; ?>" class="btn btn-primary" title="List"><< Back</a>
						<button id="simpan-pensiun" class="btn btn-primary">Simpan</button>
						<div id="validasi-pensiun"></div>
					</div>
			</div>
				 

		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
</div>		
		
<div id="dialog-rdokumen" title=""> 
	<form id="form-popup4" method="post" action=""  enctype="multipart/form-data">
		<input type="hidden" id="id_rdokumen" name="id_rdokumen" value="" />
		<input type="hidden" id="nip_baru4" name="nip_baru4" value="<?php echo $nip ?>" />
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

		
	
	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>