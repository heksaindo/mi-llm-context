<!DOCTYPE html>
<html>
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.js"></script>

</head>

<script type="text/javascript">
$(function() {
$( "#cutitahunan" ).hide();
$( "#cutisakit" ).hide();
$( "#cutialasanpenting" ).hide();
$( "#cutidiluartanggungan" ).hide();
	
});
function onAdd_cutitahunan(id) {
open_dialog_cuti_tahunan('', 'Pengajuan Cuti Tahunan');
}
function onAdd_cutisakit(id) {
open_dialog_cuti_sakit('', 'Pengajuan Cuti Sakit');
}
function onAdd_alasanpenting(id) {
open_dialog_cuti_penting('', 'Pengajuan Cuti Karena Alasan Penting');
}
function onAdd_diluartanggungan(id) {
open_dialog_diluar_tanggungan('', 'Pengajuan Cuti di luar Tanggungan Negara');
}

	// -- CUTI TAHUNAN -- //
function open_dialog_cuti_tahunan(id, titlex) {

	$( "#id" ).val( id );
	
	if(id > 0){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>cuti/cek_cutitahunan/"+id,
			//data: $('#form-golongan').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#tgl_mulai" ).val(dt[0]);
				$( "#tgl_akhir" ).val(dt[1]);
			}
		});
	}else{
		$( "[name='tgl_mulai']" ).val("");
		$( "[name='tgl_akhir']" ).val("");
	}
	
	$( "#cutitahunan" ).dialog({
		  autoOpen: false,
		  height: 200,
		  width: 400,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>cuti/do_popup_cutitahunan/"+id,
					data: $('#form-cutitahunan').serialize(), 
					success: function(msg){	
						if(msg == 'success'){		
							window.location.reload();
									
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
	
	$( "#cutitahunan" ).dialog( "open" );
	
} //END CUTI TAHUNAN//

	// -- CUTI SAKIT -- //
function open_dialog_cuti_sakit(id, titlex) {

	$( "#id" ).val( id );
	
	if(id > 0){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>cuti/cek_cutisakit/"+id,
			//data: $('#form-golongan').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#tgl_mulai" ).val(dt[0]);
				$( "#tgl_akhir" ).val(dt[1]);
			}
		});
	}else{
		$( "[name='tgl_mulai']" ).val("");
		$( "[name='tgl_akhir']" ).val("");
	}
	
	$( "#cutisakit" ).dialog({
		  autoOpen: false,
		  height: 200,
		  width: 400,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>cuti/do_popup_cutisakit/"+id,
					data: $('#form-cutisakit').serialize(), 
					success: function(msg){	
						if(msg == 'success'){		
							window.location.reload();
									
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
	
	$( "#cutisakit" ).dialog( "open" );
	
}
	// -- END OF CUTI SAKIT -- //
	
	
	// -- CUTI ALASAN PENTING -- //
function open_dialog_cuti_penting(id, titlex) {

	$( "#id" ).val( id );
	
	if(id > 0){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>cuti/cek_cutialasanpenting/"+id,
			//data: $('#form-golongan').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#tgl_mulai" ).val(dt[0]);
				$( "#tgl_akhir" ).val(dt[1]);
			}
		});
	}else{
		$( "[name='tgl_mulai']" ).val("");
		$( "[name='tgl_akhir']" ).val("");
	}
	
	$( "#cutialasanpenting" ).dialog({
		  autoOpen: false,
		  height: 200,
		  width: 400,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>cuti/do_popup_cutialasanpenting/"+id,
					data: $('#form-cutialasanpenting').serialize(), 
					success: function(msg){	
						if(msg == 'success'){		
							window.location.reload();
									
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
	
	$( "#cutialasanpenting" ).dialog( "open" );
	
}
	// -- END OF CUTI ALASAN PENTING -- //

	
	// CUTI DI LUAR TANGGUNGAN //
function open_dialog_diluar_tanggungan(id, titlex) {

	$( "#id" ).val( id );
	
	if(id > 0){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>cuti/cek_cutidiluartanggungan/"+id,
			//data: $('#form-golongan').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#tgl_mulai" ).val(dt[0]);
				$( "#tgl_akhir" ).val(dt[1]);
			}
		});
	}else{
		$( "[name='tgl_mulai']" ).val("");
		$( "[name='tgl_akhir']" ).val("");
	}
	
	$( "#cutidiluartanggungan" ).dialog({
		  autoOpen: false,
		  height: 200,
		  width: 400,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>cuti/do_popup_cutidiluartanggungan/"+id,
					data: $('#form-cutidiluartanggungan').serialize(), 
					success: function(msg){	
						if(msg == 'success'){		
							window.location.reload();
									
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
	
	$( "#cutidiluartanggungan" ).dialog( "open" );
	
}
// -- END OF CUTI DILUAR TANGGUNGAN -- //


$(document).ready(function(){
	
	$('#tanggal_mulai').datepicker({
        inline: true,
		option: "sildeDown",
		changeMonth : true,
		changeYear : true,
		dateFormat: 'yy-mm-dd'
    });
	
	$("#nip").autocomplete("<?php echo base_url(); ?>angkakredit/check_nip_baru/", {
			width: 250,
			minChars:1,
			max:100,
			selectFirst: false
		});

	$("#nip").result(function(event, data, formatted) {
			if (data[0] != 'error'){  
				$("#nip").val(data[1]);					
				if(data[4] != ''){
					$("#nama").val(data[3]+' '+data[2]+', '+data[4]);	
				}else{
					$("#nama").val(data[3]+' '+data[2]);	
				}
				
				$("#UnitKerja").val(data[17]);					
				//alert(data[6]);
			}
		});
	
	$("#UnitKerja").autocomplete("<?php echo base_url(); ?>cuti/CekUnitKerja/", {
			width: 250,
			minChars:1,
			max:100,
			selectFirst: false
		});
	
	$("#UnitKerja").result(function(event, data, formatted) {
			if (data[0] != 'error'){  
				$("#UnitKerja").val(data[0]);										
				//alert(data[6]);
			}
		});
		
	$('#tanggal_akhir').datepicker({
        inline: true,
		option: "sildeDown",
		changeMonth : true,
		changeYear : true,
		dateFormat: 'yy-mm-dd'
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
				}else{
					$("#nip_ttd").val('');		
					$("#nama_ttd").val('');	
				}
				return false;
			}
		});
		
	});
	
});
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
						 <li class="active"><a href="<?php echo base_url(); ?>cuti" title="">Penugasan & Kehadiran</a></li>
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
				
				 <div class="widget">
					 <div class="navbar">
						<div class="navbar-inner">
							<h6>Detail Jatah Cuti
							</h6>
						</div>
					</div>
					 <div class="form-horizontal row-fluid well">
						<label class="control-label">Cuti Tahunan<span class="text-error">*</span></label>
								<div class="controls">
									<?php
									$where = array('pegawai_id' => $this->session->userdata('pegawai_id'), 'jenis_cuti' => 1, 'status_cuti' => 'approved');
									$this->db->select_sum('jumlah')
											->where($where);
									$qcuti = $this->db->get('cuti')->row();
									
									if($qcuti->jumlah != 26){
									 ?>
									<button onclick="javascript:onAdd_cutitahunan()"  class="btn btn-primary">Ambil Cuti</button> Sisa Cuti <?php echo 30 - $qcuti->jumlah;?>
									<?php }else{?>
									<button onclick="javascript:onAdd_cutitahunan()"  class="btn btn-danger" disabled>Ambil Cuti</button> Sisa Cuti <?php echo 30 - $qcuti->jumlah; }?>
									
								</div>
						<div id="cutitahunan">
							<form id="form-cutitahunan" method="post" action="">
								<?php
								$db = $this->db->from('pegawai')->where('id', $this->session->userdata('pegawai_id'))->get()->row(); ?>
								<input type="hidden" name="id" id="id" />
								<input type="hidden" id="pegawai_id" name="pegawai_id" value="<?php echo $this->session->userdata('pegawai_id'); ?>" />
								<input type="hidden" id="tgl_pengajuan" name="tgl_pengajuan" value="<?php echo date("d-m-Y"); ?>" />
								<input type="hidden" id="yang_mengajukan" name="yang_mengajukan" value="<?php echo $db->nama; ?>" />
								<input type="hidden" id="jenis_cuti" name="jenis_cuti" value="1" />
								<table>
									<tr>
										<td>Tanggal Mulai</td>
										<td>:</td>
										<td>
											<input type="text" name="tgl_mulai" class="datepicker" value="">
										</td>
									</tr>
									<tr>
										<td>Tanggal Selesai</td>
										<td>:</td>
										<td>
											<input type="text" name="tgl_akhir" class="datepicker" value="">
										</td>
									</tr>
									<input type="hidden" name="jumlah" value="">
									<input type="hidden" name="status_cuti" value="submit">
								</table>
							</form>
						</div>
						<label class="control-label">Cuti Sakit<span class="text-error">*</span></label>
								<div class="controls">
									<?php
									$where = array('pegawai_id' => $this->session->userdata('pegawai_id'), 'jenis_cuti' => 3, 'status_cuti' => 'approved');
									$this->db->select_sum('jumlah')
											->where($where);
									$qcuti = $this->db->get('cuti')->row();
									
									if($qcuti->jumlah != 26){
									 ?>
									<button onclick="javascript:onAdd_cutisakit()"  class="btn btn-primary">Ambil Cuti</button> Sisa Cuti <?php echo 30 - $qcuti->jumlah;?>
									<?php }else{?>
									<button onclick="javascript:onAdd_cutisakit()"  class="btn btn-danger" disabled>Ambil Cuti</button> Sisa Cuti <?php echo 30 - $qcuti->jumlah; }?>
									
								</div>
						<div id="cutisakit">
							<form id="form-cutisakit" method="post" action="">
								<?php
								$db = $this->db->from('pegawai')->where('id', $this->session->userdata('pegawai_id'))->get()->row(); ?>
								<input type="hidden" name="id" id="id" />
								<input type="hidden" id="pegawai_id" name="pegawai_id" value="<?php echo $this->session->userdata('pegawai_id'); ?>" />
								<input type="hidden" id="tgl_pengajuan" name="tgl_pengajuan" value="<?php echo date("d-m-Y"); ?>" />
								<input type="hidden" id="yang_mengajukan" name="yang_mengajukan" value="<?php echo $db->nama; ?>" />
								<input type="hidden" id="jenis_cuti" name="jenis_cuti" value="3" />
								<table>
									<tr>
										<td>Tanggal Mulai</td>
										<td>:</td>
										<td>
											<input type="text" name="tgl_mulai" class="datepicker" value="">
										</td>
									</tr>
									<tr>
										<td>Tanggal Selesai</td>
										<td>:</td>
										<td>
											<input type="text" name="tgl_akhir" class="datepicker" value="">
										</td>
									</tr>
									<input type="hidden" name="status_cuti" value="submit">
								</table>
							</form>
						</div>
						<label class="control-label">Cuti Karena Alasan Penting<span class="text-error">*</span></label>
								<div class="controls">
									<?php
									$where = array('pegawai_id' => $this->session->userdata('pegawai_id'), 'jenis_cuti' => 5, 'status_cuti' => 'approved');
									$this->db->select_sum('jumlah')
											->where($where);
									$qcuti = $this->db->get('cuti')->row();
									
									if($qcuti->jumlah != 26){
									 ?>
									<button onclick="javascript:onAdd_alasanpenting()"  class="btn btn-primary">Ambil Cuti</button> Sisa Cuti <?php echo 30 - $qcuti->jumlah;?>
									<?php }else{?>
									<button onclick="javascript:onAdd_alasanpenting()"  class="btn btn-danger" disabled>Ambil Cuti</button> Sisa Cuti <?php echo 30 - $qcuti->jumlah; }?>
									
								</div>
						<div id="cutialasanpenting">
							<form id="form-cutialasanpenting" method="post" action="">
								<?php
								$db = $this->db->from('pegawai')->where('id', $this->session->userdata('pegawai_id'))->get()->row(); ?>
								<input type="hidden" name="id" id="id" />
								<input type="hidden" id="pegawai_id" name="pegawai_id" value="<?php echo $this->session->userdata('pegawai_id'); ?>" />
								<input type="hidden" id="tgl_pengajuan" name="tgl_pengajuan" value="<?php echo date("d-m-Y"); ?>" />
								<input type="hidden" id="yang_mengajukan" name="yang_mengajukan" value="<?php echo $db->nama; ?>" />
								<input type="hidden" id="jenis_cuti" name="jenis_cuti" value="5" />
								<table>
									<tr>
										<td>Tanggal Mulai</td>
										<td>:</td>
										<td>
											<input type="text" name="tgl_mulai" class="datepicker" value="">
										</td>
									</tr>
									<tr>
										<td>Tanggal Selesai</td>
										<td>:</td>
										<td>
											<input type="text" name="tgl_akhir" class="datepicker" value="">
										</td>
									</tr>
									<input type="hidden" name="status_cuti" value="submit">
								</table>
							</form>
						</div>
						<label class="control-label">Cuti di luar Tanggungan Negara<span class="text-error">*</span></label>
								<div class="controls">
									<?php
									$where = array('pegawai_id' => $this->session->userdata('pegawai_id'), 'jenis_cuti' => 5, 'status_cuti' => 'approved');
									$this->db->select_sum('jumlah')
											->where($where);
									$qcuti = $this->db->get('cuti')->row();
									
									if($qcuti->jumlah != 26){
									 ?>
									<button onclick="javascript:onAdd_diluartanggungan()"  class="btn btn-primary">Ambil Cuti</button> Sisa Cuti <?php echo 30 - $qcuti->jumlah;?>
									<?php }else{?>
									<button onclick="javascript:onAdd_diluartanggungan()"  class="btn btn-danger" disabled>Ambil Cuti</button> Sisa Cuti <?php echo 30 - $qcuti->jumlah; }?>
									
								</div>
						<div id="cutidiluartanggungan">
							<form id="form-cutidiluartanggungan" method="post" action="">
								<?php
								$db = $this->db->from('pegawai')->where('id', $this->session->userdata('pegawai_id'))->get()->row(); ?>
								<input type="hidden" name="id" id="id" />
								<input type="hidden" id="pegawai_id" name="pegawai_id" value="<?php echo $this->session->userdata('pegawai_id'); ?>" />
								<input type="hidden" id="tgl_pengajuan" name="tgl_pengajuan" value="<?php echo date("d-m-Y"); ?>" />
								<input type="hidden" id="yang_mengajukan" name="yang_mengajukan" value="<?php echo $db->nama; ?>" />
								<input type="hidden" id="jenis_cuti" name="jenis_cuti" value="6" />
								<table>
									<tr>
										<td>Tanggal Mulai</td>
										<td>:</td>
										<td>
											<input type="text" name="tgl_mulai" class="datepicker" value="">
										</td>
									</tr>
									<tr>
										<td>Tanggal Selesai</td>
										<td>:</td>
										<td>
											<input type="text" name="tgl_akhir" class="datepicker" value="">
										</td>
									</tr>
								</table>
								<input type="hidden" name="status_cuti" value="submit">
							</form>
						</div>
						<div class="form-actions">
							<a href="<?php echo base_url();?>cuti" class="btn btn-primary" > Kembali</a>
						</div>
					 </div>
				</div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		
	</div>
	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>