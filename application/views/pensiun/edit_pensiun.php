<!DOCTYPE html>
<html>
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
	
		var jabatan_ttd = $('#jabatan_ttd option:selected').val();
		$('#ttd').val(jabatan_ttd);
			
		$('#jabatan_ttd').change(function(){
			//$('#nama_ttd').val('');
			jabatan_ttd = $('#jabatan_ttd option:selected').val();
			$('#ttd').val(jabatan_ttd);
			//autocomplete Pegawai
			$("#nama_ttd").autocomplete("<?php echo base_url(); ?>kenaikangajipegawai/auto_tandatangan/", {
				width: 250,
				minChars:1,
				max:100,
				selectFirst: false,
				extraParams: { 
					jabatan_ttd: $('#ttd').val()
				}
			});
			
			$("#nama_ttd").result(function(event, data, formatted) {
				if (data){  
					$("#nip_ttd").val(data[1]);					
					
					if($("#nip_ttd").val() == ''){
						$("#nama_ttd").addClass('invalid');
					}else{
						$("#nama_ttd").removeClass('invalid');	
					}
				}
			});			
		});
		
		//autocomplete Pegawai
		$("#nama_ttd").autocomplete("<?php echo base_url(); ?>kenaikangajipegawai/auto_tandatangan/", {
			width: 250,
			minChars:1,
			max:100,
			selectFirst: false,
			extraParams: { 
				jabatan_ttd: $('#ttd').val()
			}
		});
		
		$("#nama_ttd").result(function(event, data, formatted) {
			if (data){  
				$("#nip_ttd").val(data[1]);					
				
				if($("#nip_ttd").val() == ''){
					$("#nama_ttd").addClass('invalid');
				}else{
					$("#nama_ttd").removeClass('invalid');	
				}
			}
		});			
		
		$( "#simpan_pensiun" ).click(function(){
			//pejabat_penetapan, tanggal_sk, no_sk, masa_kerja_gol, tanggal_berlaku, gol_lama, gol_baru
			var err = 0;
			var pejabat_penetapan = $( "#pejabat_penetapan" ).val(); 
			var kepada = $( "#kepada" ).val(); 
			var tanggal_sk = $( "#tanggal_sk" ).val(); 
			var no_sk = $( "#no_sk" ).val(); 
			var masa_kerja_gol = $( "#masa_kerja_gol" ).val(); 
			var tanggal_berlaku = $( "#tanggal_berlaku" ).val(); 
			var gol_baru = $( "#gol_baru" ).val(); 
			
			if(pejabat_penetapan == ''){
				$( "#pejabat_penetapan" ).addClass("invalid");
				err = 1;
			}		
			if(kepada == ''){
				$( "#kepada" ).addClass("invalid");
				err = 1;
			}	
			if(tanggal_sk == ''){
				$( "#tanggal_sk" ).addClass("invalid");
				err = 1;
			}
			if(no_sk == ''){
				$( "#no_sk" ).addClass("invalid");
				err = 1;
			}
			if(masa_kerja_gol == ''){
				$( "#masa_kerja_gol" ).addClass("invalid");
				err = 1;
			}
			if(tanggal_berlaku == ''){
				$( "#tanggal_berlaku" ).addClass("invalid");
				err = 1;
			}
			if(gol_baru == ''){
				$( "#gol_baru" ).addClass("invalid");
				err = 1;
			}
			//alert(err);
			if(err == 0){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>pensiun/update",
					data: $('#form-wizard').serialize(), 
					success: function(msg){	
						if(msg == 'success'){			
							$( "#validasi-kp" ).html( '<font color="blue"> Data sudah disimpan</font>' );						
							window.location.assign("<?php echo base_url().'laporan/pensiun'; ?>");											
						}else{
							$( "#validasi-kp" ).html( '<font color="red"> Data tidak dapat disimpan, coba lagi!</font>' );	
						}
						return false;
					}
				});
			}else{
				$( "#validasi-kp" ).html( '<font color="red"> Input salah, silahkan cek input warna merah!</font>' );	
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
						 <li class="active"><a href="<?php echo base_url(); ?>laporan/pensiun" title="">Rekap Pensiun</a></li>
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
						$nama = $pegawai['nama'];
						$pangkat = $pegawai['pangkat'];
						$golongan = $pegawai['golongan'];
						$jabatan = $pegawai['jabatan'];
						$kantor = $pegawai['kantor'];
						$id_pegawai = $pegawai['id_pegawai'];
						$id = $pegawai['id'];
						$tmt_pensiun = $pegawai['tmt_pensiun'];
						$bup = $pegawai['bup'];
					}
					}else {
						$nip = '';
						$nama = '';
						$pangkat = '';
						$golongan = '';
						$jabatan = '';
						$kantor = '';
						$id_pegawai = '';
						$id = '';
						$tmt_pensiun = '';
						$bup = '';
					}
				?>
				
				 <div class="widget">
					 <div class="navbar">
						<div class="navbar-inner">
							<h6>Edit Pensiun</h6>
						</div>
					</div>
					<form id="form-wizard" class="form-horizontal row-fluid well" method="post" >
						<input type="hidden" id="id" name="id" value="<?php echo $data_kp['id'];?>" />
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
									<input type="text" name="tmt_pensiun" id="tmt_pensiun" class="input-medium datepicker" value="<?php echo $tmt_pensiun ?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">BUP</label>
								<div class="controls">
									<input type="text" name="bup" id="bup" class="input-small" value="<?php echo $bup ?>" /> ( Tahun )
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
									<input id="kepada" type="text" name="kepada" value="<?php echo $data_kp['kepada'];?>" class="input-xlarge" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Jabatan Penandatangan</label>
								<div class="controls">
									<input id="ttd" type="hidden" name="ttd" value="<?php echo $data_kp['id_ttd'];?>"/>
									<select id="jabatan_ttd" name="jabatan_ttd" class="input-xlarge">
										<option value=""></option>
										<?php
											foreach($data_jabatan_ttd as $row){
												$selected = '';	
												if($data_kp['jabatan_ttd'] == $row->id_jabatan){
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
									<input id="nama_ttd" type="text" name="nama_ttd" class="input-xlarge"value="<?php echo $data_kp['nama_ttd'];?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">NIP Penandatangan</label>
								<div class="controls">
									<input id="nip_ttd" type="text" name="nip_ttd" class="input-xlarge" value="<?php echo $data_kp['nip_ttd'];?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Tembusan</label>
								<div class="controls">
									<textarea id="tembusan" name="tembusan" class="input-xxlarge tinymce"  rows="4"><?php echo $data_kp['tembusan'];?></textarea>
								</div>
							</div>
						</div>
						<div id="form-wizard-3" class="step">
							<div class="step-title">
								<i>3</i>
								<h5>Data Surat Keputusan</h5>
								<span>Data 3</span>
							</div>
							<div class="control-group">
								<label class="control-label">Perihal</label>
								<div class="controls">
									<input id="perihal" type="text" name="perihal" class="input-xlarge" value="<?php echo $data_kp['perihal'];?>" />		
									
								</div>
							</div>
						    <div class="control-group">
								<label class="control-label">Pejabat Penetapan</label>
								<div class="controls">
									<input id="pejabat_penetapan" type="text" name="pejabat_penetapan" class="input-xlarge" value="<?php echo $data_kp['pejabat_penetapan'];?>" />		
									
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Tanggal</label>
								<div class="controls">
									<input id="tanggal_sk" type="text" name="tanggal_sk" value="<?php echo date('d-m-Y', strtotime($data_kp['tanggal_sk']));?>" class="input-medium datepicker" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">No</label>
								<div class="controls">
									<input id="no_sk" type="text" name="no_sk" value="<?php echo $data_kp['no_sk'];?>" class="input-xlarge" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Masa Kerja Golongan</label>
								<div class="controls">
									<input id="masakerja" type="text" name="masakerja" value="<?php echo $data_kp['masa_kerja_gol'];?>" class="input-xlarge" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Tanggal Mulai Berlaku</label>
								<div class="controls">
									<input id="tanggalberlaku" type="text" name="tanggalberlaku" value="<?php echo date('d-m-Y', strtotime($data_kp['tanggal_berlaku']));?>" class="input-medium datepicker" />
								</div>
							</div>
						</div>
						
					</form>
						
					<div id="form-wizard-4" class="step">
						<div class="step-title">
							<i>4</i>
							<h5>Dokumen Penunjang</h5>
							<span>Data 4</span>
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
						<a href="<?php echo base_url().'laporan/pensiun'; ?>" class="btn btn-primary" title="List"><< Back</a>
						<button id="simpan_pensiun" class="btn btn-primary">Simpan</button>
						<div id="validasi-kp"></div>
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
		<input type="hidden" id="nip_baru4" name="nip_baru4" value="" />
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
</body>
</html>