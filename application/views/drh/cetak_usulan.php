<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.js"></script>
	
<script type="text/javascript"> 
 $(function() {
	$("#nama_usulan").val('');	
	$('#cetak_karpeg').attr('disabled','disabled');
	$('#cetak_karsu').attr('disabled','disabled');
	$('#cetak_karis').attr('disabled','disabled');
	
	//===== Datatables =====//
	oTable_usulan = $('table#list-usulan').dataTable({
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
		"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_usulan",
		"fnServerData": function(sSource,aoData,fnCallback)
		{
			
			//aoData.push({name: "nip_baru", value: $('#hd_nip_baru').val() });
			$.ajax({
				"dataType": 'json', 
				"type": "POST", 
				"url": sSource, 
				"data": aoData, 
				"success": fnCallback
			});
		}
			
	});
	
	//autocomplete Pegawai
		$("#nama_usulan").autocomplete("<?php echo base_url(); ?>pegawai/auto_pegawai", {
			width: 400,
			minChars:0,
			max:100,
			selectFirst: false
		});
		
		$("#nama_usulan").result(function(event, data, formatted) {
			if (data){  
				$("#nama_usulan").val(data[0]);					
				$("#nip_baru_us").val(data[1]);					
				$("#nama_us").val(data[2]);					
				$("#status_us").val(data[3]);					
				
			}
		});
		
	$("#add-usulan").click(function(){
		////nama_usulan, nip_baru_us, nama_us, status_us
		var nip_baru_us = $("#nip_baru_us").val();
		var nama_us = $("#nama_us").val();
		var status_us = $("#status_us").val();
		if(nip_baru_us){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>pegawai/add_usulan",
				data: "nip_baru_us="+nip_baru_us+"&nama_us="+nama_us+"&status_us="+status_us, 
				success: function(msg){	
					if(msg == 'success'){			
						oTable_usulan.fnDraw();	
						$("#nama_usulan").val('');									
						$("#nip_baru_us").val('');									
						$("#nama_us").val('');									
						$("#status_us").val('');									
					}
					return false;
				}
			});
		}else{
			$( "#validasi_usulan" ).html( '<font color="red"> Pilih Pegawai.</font>' );	
		}
	});
	
});
	
function do_draft_surat() {
	
	$( "#dialog-draft_usulan" ).load('<?php echo base_url(); ?>pegawai/input_draft_surat')
		.dialog({
		  autoOpen: false,
		  height: 500,
		  width: 600,
		  modal: true,
		  title: 'Draft Cetak Surat',
		  buttons: {
			"Simpan": function() {			
				var err = 0;
				var nosurat = $( "#nosurat" ).val(); 
				var kepada = $( "#kepada" ).val(); 
				var jabatanttd = $( "#jabatanttd" ).val(); 
				var namattd = $( "#namattd" ).val(); 
				var nipttd = $( "#nipttd" ).val(); 
				
				if(nosurat == ''){
					$( "#nosurat" ).addClass("invalid");
					err = 1;
				}		
				if(kepada == ''){
					$( "#kepada" ).addClass("invalid");
					err = 1;
				}
				if(jabatanttd == ''){
					$( "#jabatanttd" ).addClass("invalid");
					err = 1;
				}
				if(namattd == ''){
					$( "#namattd" ).addClass("invalid");
					err = 1;
				}
				if(nipttd == ''){
					$( "#nipttd" ).addClass("invalid");
					err = 1;
				}
				//alert(err);
				if(err == 0){
					$.ajax({
						type: "POST",
						url: "<?php echo base_url(); ?>pegawai/insert_draft",
						data: $('#form-wizard-draft').serialize(), 
						success: function(msg){	
							if(msg == 'success'){			
								alert( 'Data sudah disimpan' );		
								$( "#dialog-draft_usulan" ).dialog( "close" );	
								$('#cetak_karpeg').removeAttr('disabled');
								$('#cetak_karsu').removeAttr('disabled');
								$('#cetak_karis').removeAttr('disabled');
														
							}else{
								alert( 'Data tidak dapat disimpan, coba lagi!' );	
							}
							return false;
						}
					});
				}else{
					alert( 'Input salah, silahkan cek input warna merah!' );	
				}
				
			},
			"Batal": function() {
			  $( this ).dialog( "close" );
			}
		 },
		  
	}); 
	$( "#dialog-draft_usulan" ).dialog( "open" );
	
	
	return false;
}
		
function do_cetak_karpeg() {
	var tipe_usulan = 'Karpeg';
	
	$( "#dialog-cetak_usulan" ).load('<?php echo base_url(); ?>pegawai/view_cetak_usulan/'+tipe_usulan)
		.dialog({
		  autoOpen: false,
		  height: 600,
		  width: 800,
		  modal: true,
		  title: 'Cetak Usulan Karpeg',
		  buttons: {
			"Cetak": function() {			
				do_cetak(tipe_usulan);					
				$( this ).dialog( "close" );
			},
			"Batal": function() {
			  $( this ).dialog( "close" );
			}
		 },
		  
	}); 
	$( "#dialog-cetak_usulan" ).dialog( "open" );
	
	
	return false;
}
	
function do_cetak_karsu() {
	var tipe_usulan = 'Karsu';
	$( "#dialog-cetak_usulan" ).load('<?php echo base_url(); ?>pegawai/view_cetak_usulan/'+tipe_usulan)
		.dialog({
		  autoOpen: false,
		  height: 600,
		  width: 800,
		  modal: true,
		  title: 'Cetak Usulan Karpeg',
		  buttons: {
			"Cetak": function() {
				do_cetak(tipe_usulan);					
				$( this ).dialog( "close" );
			},
			"Batal": function() {
			  $( this ).dialog( "close" );
			}
		 },
		  
	}); 
	$( "#dialog-cetak_usulan" ).dialog( "open" );
	
	return false;
}
	
function do_cetak_karis() {
	var tipe_usulan = 'Karis';
	$( "#dialog-cetak_usulan" ).load('<?php echo base_url(); ?>pegawai/view_cetak_usulan/'+tipe_usulan)
		.dialog({
		  autoOpen: false,
		  height: 600,
		  width: 800,
		  modal: true,
		  title: 'Cetak Usulan Karpeg',
		  buttons: {
			"Cetak": function() {
				do_cetak(tipe_usulan);
				$( this ).dialog( "close" );
			},
			"Batal": function() {
			  $( this ).dialog( "close" );
			}
		 },
		  
	}); 
	$( "#dialog-cetak_usulan" ).dialog( "open" );
	
	return false;
}

function tmp_cetak(){
	w=window.open("","", "scrollbars=1,height=600, width=800");
	w.document.write('<html><head><title></title>');
	w.document.write('<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css" type="text/css"  media="print" />');
	w.document.write('<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css" type="text/css"  media="print" />');
	w.document.write("<style>#usulan_{font-size: inherit !important;font-family: 'Arial','sans-serif';}</style>");
	w.document.write('<body id="usulan_">');
	w.document.write($('#dialog-cetak_usulan').html());
	w.document.write('</body>');
	w.document.close();
	w.focus();
	w.print();
	w.close();
}

function do_cetak(tipe_usulan){
	
	$.ajax({
		type: "POST",
		url: "<?php echo base_url(); ?>pegawai/cek_cetak_usulan",
		data: 'tipe_usulan='+tipe_usulan, 
		success: function(msg){	
			if(msg == 'success'){	
				tmp_cetak();	
				oTable_usulan.fnDraw();
			}else{
				alert('Gagal menyimpan data');
			}
			return false;
			
		}
	});

}
	
function onDeleteTemp(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pegawai/do_delete_usulan_temp/"+id,
			data: "id="+id, 
			success: function(msg){	
				if(msg == 'success'){		
					oTable_usulan.fnDraw();
				}else{
					alert( 'Data tidak dapat dihapus!' );	
				}						
			}
		});
	}
}
</script>
<style>
.content-add {
	margin: 5px; 0px 5px 0px;
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
						<li><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
						<li><a href="<?php echo base_url(); ?>administrasipegawai" title="">Administrasi Pegawai</a></li>
						<li><a href="<?php echo base_url(); ?>pegawai" title="">Daftar Riwayat Hidup Pegawai</a></li>
						<li class="active"><a href="#" title="">Usulan Pegawai</a></li>					 
					</ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Add Cetak Usulan</h5>
			    	</div>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>

				<!-- Media datatable -->
				
				 
                <div class="widget">
					
                    <div class="table-overflow">
						<div class="content-add" style="float: left;">
							<input id="nama_usulan" type="text" name="nama_usulan" class="input-xlarge" style="width:400px;" value="" />
							<input id="nip_baru_us" type="hidden" name="nip_baru_us" />
							<input id="nama_us" type="hidden" name="nama_us" />
							<input id="status_us" type="hidden" name="status_us" />
							<button id="add-usulan" class="btn btn-primary">Tambah</button>
							<div id="validasi_usulan"></div>
						</div>
						<div style="float: right;">
							<a href="<?php echo base_url().'pegawai/list_usulan'; ?>"  class="btn btn-primary">List Histori Usulan >></a>
						</div>
						<div style="clear: both;"></div>
						<div class="widget-content">									
						<table id="list-usulan" class="table table-bordered table-striped with-check">
							<thead>
								<tr>
									<th width="50">No</th>
									<th width="150">NIP Baru</th>
									<th>Nama</th>
									<th width="100">Status Pegawai</th>
									<th width="70">Action</th>
								</tr>
							</thead>									  
						</table>
						</div>
				
                    </div>
                </div>
                <!-- /media datatable -->

				
				<div class="form-actions">
					 <table width="100%">
						<tr>
							<td style="width:70px;">
								<a href="<?php echo base_url().'pegawai'; ?>"  class="btn btn-primary"><< Back</a>
							</td>
							<td>&nbsp;</td>
							<td align="right" style="width:100px;">
								<button id="draft_surat" onclick="return do_draft_surat();" class="btn btn-primary">Draft Surat Usulan</button> 
							</td>
							<td align="right" style="width:100px;">
								<button id="cetak_karpeg" onclick="return do_cetak_karpeg();" class="btn btn-primary">Cetak Usulan Karpeg</button> 
							</td>
							<td align="right" style="width:100px;">
								<button id="cetak_karsu" onclick="return do_cetak_karsu();" class="btn btn-primary">Cetak Usulan Karsu</button> 
							</td>
							<td align="right" style="width:100px;">
								<button id="cetak_karis" onclick="return do_cetak_karis();" class="btn btn-primary">Cetak Usulan Karis</button> 
							</td>
						</tr>
					 </table>
					
				</div>
				
				<br />	 
		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		
	</div>
	<!-- /content container -->
	
	<div id="dialog-cetak_usulan_list"></div>	
	<div id="dialog-cetak_usulan"></div>
	<div id="dialog-draft_usulan"></div>
	
	
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>