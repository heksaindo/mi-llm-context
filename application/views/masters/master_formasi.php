<!DOCTYPE html>
<html>
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript"> 
$(function() {
	$( "#dialog-formasi" ).hide();
	
});
		
function onEdit_formasi(id) {
	open_dialog(id, 'Edit Formasi');
}
function onAdd_formasi(id) {
	open_dialog('', 'Tambah Formasi');
}

function onDelete_formasi(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_formasi/do_delete_formasi/"+id,
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
			url: "<?php echo base_url(); ?>master_formasi/cek_formasi/"+id,
			//data: $('#form-golongan').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#tipe_formasi" ).val( dt[0] );
				$( "#nama_formasi" ).val( dt[1] );
			}
		});
	}else{
		$( "#tipe_formasi" ).val( "" );
		$( "#nama_formasi" ).val( "" );
	}
	
	$( "#dialog-formasi" ).dialog({
		  autoOpen: false,
		  height: 400,
		  width: 400,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>master_formasi/do_popup_formasi/"+id,
					data: $('#form-formasi').serialize(), 
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
	
	$( "#dialog-formasi" ).dialog( "open" );
	
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
						 <li class="active"><a title="">Master Formasi Jabatan</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                            
				<button onclick="javascript:onAdd_formasi()"  class="btn btn-primary">Tambah</button>				
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>Master Formasi Jabatan</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-formasi" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Tipe Formasi</th>
                                    <th>Nama Formasi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_formasi as $row){
								?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $row['tipe_formasi']; ?></td>
										<td><?php echo $row['nama_formasi']; ?></td>
										<td>
											<span id="edit-rformasi" onclick="javascript:onEdit_formasi(<?php echo $row['id_formasi']; ?>)" class="fam-application-edit"></span>
											<span id="delete-rformasi" onclick="javascript:onDelete_formasi(<?php echo $row['id_formasi']; ?>)" class="fam-application-delete"></span>
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
<div id="dialog-formasi" title=""> 
	<form id="form-formasi" method="post" action="" >
		<input type="hidden" id="id_formasi" name="id_formasi" value="" />
		<table>
			<tr>
				<td>Tipe Formasi</td>
				<td>:</td>
				<td>
					<input id="tipe_formasi" type="text" name="tipe_formasi" class="input-xlarge is_required" />
				</td>
			</tr>
			<tr>
				<td>Nama Formasi</td>
				<td>:</td>
				<td>
					<input id="nama_formasi" type="text" name="nama_formasi" class="input-xlarge is_required" />
				</td>
			</tr>
		</table>	
	</form>
</div>


	<!-- /content container -->
	<?php $this->load->view('layout/_actionwrapper'); ?>
</body>
</html>