<!DOCTYPE html>
<html>
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript"> 
$(function() {
	$( "#dialog-unsur_kegiatan" ).hide();
	
});
		
function onEdit_unsur_kegiatan(id) {
	open_dialog(id, 'Edit Unsur Kegiatan');
}
function onAdd_unsur_kegiatan(id) {
	open_dialog('', 'Tambah Unsur Kegiatan');
}

function onDelete_unsur_kegiatan(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_unsur_kegiatan/do_delete_unsur_kegiatan/"+id,
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
			url: "<?php echo base_url(); ?>master_unsur_kegiatan/cek_unsur_kegiatan/"+id,
			//data: $('#form-unsur_kegiatan').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#nama_uk" ).val( dt[0] );
				$( "#kategori_uk" ).val( dt[1] );
			}
		});
	}else{
		$( "#nama_uk" ).val( "" );
		$( "#kategori_uk" ).val( "" );
	}
	
	$( "#dialog-unsur_kegiatan" ).dialog({
		  autoOpen: false,
		  height: 250,
		  width: 450,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>master_unsur_kegiatan/do_popup_unsur_kegiatan/"+id,
					data: $('#form-unsur_kegiatan').serialize(), 
					success: function(msg){	
						if(msg == 'success'){		
							window.location.reload();
							$( this ).dialog( "close" );
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
	
	$( "#dialog-unsur_kegiatan" ).dialog( "open" );
	
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
						 <li><a href="<?php echo base_url(); ?>master_data" title="">Administrasi Master Data</a></li>
						 <li class="active"><a href="<?php echo base_url(); ?>master_unsur_kegiatan" title="">Master Unsur Kegiatan</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header 
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Master Jabatan</h5>
			    	</div>
			    </div>-->
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                            
				<button onclick="javascript:onAdd_unsur_kegiatan()"  class="btn btn-primary">Tambah</button>				
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Master Unsur Kegiatan</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-unsur_kegiatan" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Nama Unsur</th>
                                    <th>Kategori</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_unsur_kegiatan as $row){
									$id = $row['id_uk'];
								?>
									<tr>
										<td><?php echo $no; ?></td>										
										<td><?php echo $row['nama_uk']; ?></td>
										<td><?php echo $row['kategori_uk']; ?></td>
										<td>
											<span id="edit-runsur_kegiatan" onclick="javascript:onEdit_unsur_kegiatan(<?php echo $id;?>)" class="fam-application-edit"></span>
											<span id="delete-runsur_kegiatan" onclick="javascript:onDelete_unsur_kegiatan(<?php echo $id;?>)" class="fam-application-delete"></span>
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
<div id="dialog-unsur_kegiatan" title=""> 
	<form id="form-unsur_kegiatan" method="post" action="" >
		<input type="hidden" id="id" name="id" value="" />
		<table>
			
			<tr>
				<td>Sub Unsur</td>
				<td>:</td>
				<td>
					<input id="nama_uk" type="text" name="nama_uk" class="input-xlarge" />
				</td>
			</tr>
			<tr>
				<td>Butir Kegiatan</td>
				<td>:</td>
				<td>
					<input id="kategori_uk" type="text" name="kategori_uk" class="input-xlarge" />
				</td>
			</tr>
			
		</table>	
	</form>
</div>


	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>