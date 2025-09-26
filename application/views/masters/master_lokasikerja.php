<!DOCTYPE html>
<html>
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript"> 
$(function() {
	$( "#dialog-lokasikerja" ).hide();
	
});
		
function onEdit_lokasikerja(id) {
	open_dialog(id, 'Edit Lokasi Kerja');
}
function onAdd_lokasikerja(id) {
	open_dialog('', 'Tambah Lokasi Kerja');
}

function onDelete_lokasikerja(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_lokasikerja/do_delete_lokasikerja/"+id,
			data: "id="+id, 
			success: function(msg){	
				if(msg == 'success'){		
					window.location.reload();
				}else{
					alert( 'Data tidak dapat dihapus!' );	
				}						
			}
		});
	}
}

function open_dialog(id, titlex) {

	$( "#id" ).val( id );
	
	if(id > 0){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_lokasikerja/cek_lokasikerja/"+id,
			//data: $('#form-lokasikerja').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#lokasi_kerja" ).val( dt[0] );
			}
		});
	}else{
		$( "#lokasi_kerja" ).val( "" );
	}
	
	$( "#dialog-lokasikerja" ).dialog({
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
					url: "<?php echo base_url(); ?>master_lokasikerja/do_popup_lokasikerja/"+id,
					data: $('#form-lokasikerja').serialize(), 
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
	
	$( "#dialog-lokasikerja" ).dialog( "open" );
	
}

</script>
</head>
<body>
	<?php $this->load->view('layout/_top');?>
	
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
						 <li><a href="<?php echo base_url(); ?>master_data" title="">Administrasi Master Data</a></li>
						 <li class="active"><a href="<?php echo base_url(); ?>master_lokasikerja" title="">Lokasi Kerja</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header 
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Master Lokasi Kerja</h5>
			    	</div>
			    </div>-->
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                            
				<button onclick="javascript:onAdd_lokasikerja()"  class="btn btn-primary">Tambah</button>				
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Master Lokasi Kerja</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-lokasikerja" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Nama Lokasi Kerja</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_lokasi_kerja as $row){
									$id = $row['id_lokasi_kerja'];
								?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $row['lokasi_kerja']; ?></td>
										<td>
											<span id="edit-rjabatan" onclick="javascript:onEdit_lokasikerja(<?php echo $id;?>)" class="fam-application-edit"></span>
											<span id="delete-rjabatan" onclick="javascript:onDelete_lokasikerja(<?php echo $id;?>)" class="fam-application-delete"></span>
										</td>
									</tr>
								<?php
								$no++;
								}
								?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /media datatable -->

				
		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		
	</div>
	
	
<!-- /content Popup -->
<div id="dialog-lokasikerja" title=""> 
	<form id="form-lokasikerja" method="post" action="" >
		<input type="hidden" id="id" name="id" value="" />
		<div>Nama Lokasi Kerja :</div>
		<div><input id="lokasi_kerja" type="text" name="lokasi_kerja" class="input-xlarge is_required" /></div>
		
	</form>
</div>


	<!-- /content container -->
	<?php $this->load->view('layout/_actionwrapper'); ?>
</body>
</html>