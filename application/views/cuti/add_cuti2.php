<!DOCTYPE html>
<html>
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head_tiny'); ?>
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
	
	$("#nama").autocomplete("<?php echo base_url(); ?>cuti/get_pegawai", {
			width: 250,
			minChars:1,
			max:100,
			selectFirst: false
		});

	$("#nama").result(function(event, data, formatted) {
		$("#nip").val(data[1]);					
		$("#nama").val(data[0]);	
		$("#pegawai_id").val(data[2]);
	});
	
    $("#form-cuti").submit(function(e){
		e.preventDefault();
	});
	$( "[name='nama']" ).on('keyup',function(){
	 var val = $( "[name='nama']" ).val();
	 if(val !==''){
		$( "[name='nama']" ).removeClass("invalid");
	 }else{
		$( "[name='nama']" ).addClass("invalid");
	 }
	});
	$( "[name='jenis_cuti']" ).on('change',function(){
	 var val = $( "[name='jenis_cuti']" ).val();
	 if(val !==''){
		$( "[name='jenis_cuti']" ).removeClass("invalid");
	 }else{
		$( "[name='jenis_cuti']" ).addClass("invalid");
	 }
	});
	$( "[name='tgl_mulai']" ).on('change',function(){
	 var val = $( "[name='tgl_mulai']" ).val();
	 if(val !==''){
		$( "[name='tgl_mulai']" ).removeClass("invalid");
	 }else{
		$( "[name='tgl_mulai']" ).addClass("invalid");
	 }
	});
	$( "[name='tgl_akhir']" ).on('change',function(){
	 var val = $( "[name='tgl_akhir']" ).val();
	 if(val !==''){
		$( "[name='tgl_akhir']" ).removeClass("invalid");
	 }else{
		$( "[name='tgl_akhir']" ).addClass("invalid");
	 }
	});
    $( "#simpan-cuti" ).click(function(){
		
			$( "[name='pegawai_id']" ).val();
            $( "[name='tgl_pengajuan']" ).val();
            var nama_peg = $( "[name='nama']" ).val();
           /* $( "[name='nama_ttd']" ).val();
            $( "[name='jabatan_ttd']" ).val();
            $( "[name='nip_ttd']" ).val();*/
            var jenis = $( "[name='jenis_cuti']" ).val();
            var tgl_mulai = $( "[name='tgl_mulai']" ).val();
            var tgl_akhir = $( "[name='tgl_akhir']" ).val();
            $( "[name='status_cuti']" ).val();
			var bValid = true;
			if(nama_peg ===''){
				bValid = false;
				$( "[name='nama']" ).addClass("invalid");
			}else{
				$( "[name='nama']" ).removeClass("invalid");
			}
			if(jenis ===''){
				bValid = false;
				$( "[name='jenis_cuti']" ).addClass("invalid");
			}else{
				$( "[name='jenis_cuti']" ).removeClass("invalid");
			}
			if(tgl_mulai ===''){
				bValid = false;
				$( "[name='tgl_mulai']" ).addClass("invalid");
			}else{
				$( "[name='tgl_mulai']" ).removeClass("invalid");
			}
			if(tgl_akhir ===''){
				bValid = false;
				$( "[name='tgl_akhir']" ).addClass("invalid");
			}else{
				$( "[name='tgl_akhir']" ).removeClass("invalid");
			}

			if ($('#simpan-cuti').attr('disabled') == 'true')
			{
				bValid = false;
			}
            if ( bValid ) {
              $.ajax({
                  type: "POST",
                  url: "<?php echo base_url(); ?>cuti/insert/",
                  data: $('#form-cuti').serialize(), 
                  success: function(msg){
					var data = explode('|', msg);
                      if(data[0] == 'success'){		
                          window.location.assign("<?php echo base_url().'cuti'; ?>");
                      }else{
						if(data[1] !==''){
							alert(data[1]);	
						}else{
							alert( 'Data tidak dapat disimpan, cek input!' );	
						}
                      }						
                  }
              });
            }
		});
   
	$('.datepicker').datepicker({
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
	
	$("[name='jenis_cuti']").change(function(e){
		//var idx = $("[name='jenis_cuti'] option:selected").data('id');
		//if(idx > 0){
			
		//}
		if($(this).val()){
			var txt= $("[name='jenis_cuti'] option:selected").text();
			var sisa = $("[name='sisa']").val();
			if(sisa !=='' && sisa === 0){
				alert("Sisa Cuti dari jenis "+txt+" telah habis!");
				$('#simpan-cuti').attr('disabled',true);
			}
		}
	});
	<?php
	if((array_key_exists('id',$datapeg) && $datapeg->id !='') && $this->session->userdata('login_state') =='User') :?>
		$('#nama').val('<?php echo $datapeg->nama;?>').change();
		$('#nama').attr('readonly',true);
		$('#nip').val('<?php echo $datapeg->nip_baru;?>').change();
		$('#nip').attr('readonly',true);
		$('#pegawai_id').val('<?php echo $datapeg->id;?>').change();
		$('#sisa').val('<?php echo $datapeg->sisa;?>');
	<?php endif;?>
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
							<h6>Pengajuan Cuti
							</h6>
						</div>
					</div>
					<div class="form-horizontal row-fluid well">
                        <form id="form-cuti" method="post" action="">
                            <input type="hidden" name="id" id="id" value="" />
							<input type="hidden" name="sisa" id="sisa" value="" />
                            <input type="hidden" name="pegawai_id" id="pegawai_id" />
                            <input type="hidden" name="tgl_pengajuan" id="tgl_pengajuan" value="<?php echo date('d-m-Y');?>" />
                            <div class="control-group">
                                <label class="control-label">Nama</label>
                                <input id="nama" name="nama" type="text" class="input-xlarge" value="" /> (Auto Complete)
                            </div>
                            <div class="control-group">
                                <label class="control-label">NIP</label>
                                <input id="nip" name="nip" type="text" class="input-xlarge" />
                            </div>
                            <!--<div class="control-group">
                                <label class="control-label">Jabatan Penandatangan</label>
                                <select id="jabatan_ttd" name="jabatan_ttd" class="input-xlarge">
										<option value=""></option>
										<?php
											foreach($data_jabatan_ttd as $row){
												$selected = '';	
												
												echo "<option value='".$row->id_jabatan."' ".$selected.">".$row->nama_jabatan."</option>";
											}
										?>
									</select>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nama Penandatangan</label>
                                <input id="nama_ttd" type="text" name="nama_ttd" class="input-xlarge" value="" />
                            </div>
                            <div class="control-group">
                                <label class="control-label">NIP Penandatangan</label>
                                <input id="nip_ttd" type="text" name="nip_ttd" class="input-xlarge" value="" />
                            </div>-->
                            <div class="control-group">
                                <label class="control-label">Jenis Cuti</label>
                                <select class="input-xlarge" name="jenis_cuti">
                                    <option value=""></option>
                                    <?php foreach($jenis_cuti->result() as $row){?>
                                    <option value="<?php echo $row->id_tipe_cuti;?>" data-id="<?php echo $row->kuota;?>"><?php echo $row->nama_tipe_cuti; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tanggal Mulai</label>
                                <input class="datepicker" type="text" class="input-medium" name="tgl_mulai" />
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tanggal Selesai</label>
                                <input class="datepicker" type="text" class="input-medium" name="tgl_akhir" />
                            </div>
                            <div class="control-group">
                                <input type="hidden" name="status_cuti" value="2" />
                            </div>
                            <div class="form-actions">
                                <a href="<?php echo base_url();?>cuti" class="btn btn-primary" >&laquo Kembali</a>
                                <button id="simpan-cuti" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
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