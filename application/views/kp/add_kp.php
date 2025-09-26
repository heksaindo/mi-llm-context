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
			"sAjaxSource": "<?php echo base_url(); ?>kenaikanpangkat/ajax_rdokumen/edit/",
			"fnServerData": function(sSource,aoData,fnCallback)
			{
				aoData.push({name: "id_pegawai", value: $('#id_pegawai').val() });
				aoData.push({name: "nip_baru", value: $('#nip').val() });
				aoData.push({name: "id_kp", value: $('#id_kp').val() });
				$.ajax({
					"dataType": 'json', 
					"type": "POST", 
					"url": sSource, 
					"data": aoData, 
					"success": fnCallback
				});
			}
				
		});
		
		$( "#simpan-kp" ).click(function(){
			//pejabatpenetapan, tanggal_sk, no_sk, masa_kerja_gol, tanggal_berlaku, gol_lama, gol_baru
			var err = 0;
		/*	var pejabatpenetapan = $( "#pejabatpenetapan" ).val(); 
			var tanggal_sk = $( "#tanggal_sk" ).val(); 
			var no_sk = $( "#no_sk" ).val(); 
			var masa_kerja_gol = $( "#masa_kerja_gol" ).val(); 
			var tanggal_berlaku = $( "#tanggal_berlaku" ).val(); 
			var gol_baru = $( "#gol_baru" ).val(); 
			
			if(pejabatpenetapan == ''){
				$( "#pejabatpenetapan" ).addClass("invalid");
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
			*/
			//alert(err);
			if(err == 0){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>kenaikanpangkat/update_status_kp",
					data: $('#form-wizard').serialize(), 
					success: function(msg){	
						if(msg == 'success'){			
							$( "#validasi-kp" ).html( '<font color="blue"> Data sudah disimpan</font>' );						
							window.location.assign("<?php echo base_url().'kenaikanpangkat'; ?>");											
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
							alert( 'Data tidak dapat disimpan, format dokumen harus file pdf!' );	
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
		                <li><a href="<?php echo base_url(); ?>Home">Dashboard</a></li>
						 <li><a href="<?php echo base_url(); ?>administrasipegawai" title="">Administrasi Pegawai</a></li>
						 <li><a href="<?php echo base_url(); ?>kenaikanpangkat" title="">Kenaikan Pangkat</a></li>
						 <li class="active"><a href="#" title="">Add Kenaikan Pangkat</a></li>
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
						$id_pegawai = $pegawai['id'];
						$nip = $pegawai['nip_baru'];
						$nama = $pegawai['nama'];
						$pangkat = $pegawai['kepangkatan'];
						$jabatan = $pegawai['nama_jabatan'];
						$kantor = $pegawai['nama_unit_kerja'];
						$unit_kerja = $pegawai['kode_unit_kerja'];
						$gol_lama = $pegawai['gol_terakhir'];
					}
					}else {
						$id_pegawai = '';
						$nip = '';
						$nama = '';
						$pangkat = '';
						$jabatan = '';
						$kantor = '';
						$unit_kerja = '';
						$gol_lama = '';
					}
				?>
				
				 <div class="widget">
					 <div class="navbar">
						<div class="navbar-inner">
							<h6>Add Kenaikan Pangkat</h6>
						</div>
					</div>
					<form id="form-wizard" class="form-horizontal row-fluid well" method="post" >
						<input id="id_kp" type="hidden" name="id_kp" value="<?php echo $id_kp; ?>" />
						<div id="form-wizard-1" class="step">
							<div class="step-title">
								<i>1</i>
								<h5>Data Pegawai</h5>
								<span>Data 1</span>
							</div>
							<div class="control-group">
								<label class="control-label">NIP</label>
								<div class="controls">
									<input id="id_pegawai" type="hidden" name="id_pegawai" value="<?php echo $id_pegawai ?>" />
									<input id="nip" type="text" name="nip" class="input-xlarge" readonly="readonly" value="<?php echo $nip ?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Nama</label>
								<div class="controls">
									<input id="nama" type="text" name="nama" class="input-xlarge" readonly="readonly" value="<?php echo $nama ?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Pangkat</label>
								<div class="controls">
									<input id="pangkat" type="text" name="pangkat" class="input-xlarge" readonly="readonly" value="<?php echo $pangkat ?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Jabatan</label>
								<div class="controls">
									<input id="jabatan" type="text" name="jabatan" class="input-xlarge" readonly="readonly" value="<?php echo $jabatan ?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Kantor</label>
								<div class="controls">
									<input id="kantor" type="text" name="kantor" class="input-xlarge" readonly="readonly" value="<?php echo $kantor ?>" />
									<input id="unit_kerja" type="hidden" name="unit_kerja" value="<?php echo $unit_kerja ?>" />
								</div>
							</div>
						</div>
						<!--
						<div id="form-wizard-2" class="step">
							<div class="step-title">
								<i>2</i>
								<h5>Data Surat Keputusan</h5>
								<span>Data 2</span>
							</div>
							
						   <div class="control-group">
								<label class="control-label">Pejabat Penetapan</label>
								<div class="controls">
									<input id="pejabatpenetapan" type="text" name="pejabatpenetapan" class="input-xlarge" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Tanggal SK</label>
								<div class="controls">
									<input id="tanggal_sk" type="text" name="tanggal_sk" class="datepicker input-medium" />
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
									<input id="masa_kerja_gol" type="text" name="masa_kerja_gol" class="input-xlarge" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Tanggal Mulai Berlaku</label>
								<div class="controls">
									<input id="tanggal_berlaku" type="text" name="tanggal_berlaku" class="datepicker input-medium" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Golongan Lama</label>
								<div class="controls">
									<input id="gol_lama" type="text" name="gol_lama" value="<?php echo $gol_lama;?>" class="input-medium" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Golongan Baru</label>
								<div class="controls">
									<select id="gol_baru" name="gol_baru" class="input-medium is_required">
										<option value=""> </option>
										<?php
											//foreach($data_golongan as $row){
												
												//echo "<option value='".$row->kode_golongan."' ".$selected.">".$row->kode_golongan."</option>";
											//}
										?>
									</select>
								</div>
							</div>
							
						</div>
						-->
						
						</form>
						
						<div id="form-wizard-3" class="step">
							<div class="step-title">
								<i>2</i>
								<h5>Dokumen Penunjang</h5>
								<span>Data 2</span>
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
						<a href="<?php echo base_url().'kenaikanpangkat'; ?>" class="btn btn-primary" title="List"><< Back</a>
						<button id="simpan-kp" class="btn btn-primary">Simpan</button>
						<div id="validasi-kp"></div>
					</div>
			</div>
				 

		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		
	</div>
	
<div id="dialog-rdokumen" title=""> 
	<form id="form-popup4" method="post" action=""  enctype="multipart/form-data">
		<input type="hidden" name="id_kp" value="<?php echo $id_kp; ?>" />
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
					<input id="filename4" type="file" name="filename4" multiple="multiple"  accept="application/pdf" class="input-medium" />
				
				</td>
			</tr>
			
		</table>	
	</form>
</div>

	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>