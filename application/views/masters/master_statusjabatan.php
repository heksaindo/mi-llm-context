<!DOCTYPE html>
<html>
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript"> 
$(function() {
	$( "#dialog-statusjabatan" ).hide();
	
});
		
function onEdit_statusjabatan(id) {
	open_dialog(id, 'Edit Status Jabatan');
}
function onAdd_statusjabatan(id) {
	open_dialog('', 'Tambah Status Jabatan');
}

function onDelete_statusjabatan(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_statusjabatan/do_delete_statusjabatan/"+id,
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
			url: "<?php echo base_url(); ?>master_statusjabatan/cek_statusjabatan/"+id,
			//data: $('#form-statusjabatan').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#nama_status_jabatan" ).val( dt[0] );
			}
		});
	}else{
		$( "#nama_status_jabatan" ).val( "" );
	}
	
	$( "#dialog-statusjabatan" ).dialog({
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
					url: "<?php echo base_url(); ?>master_statusjabatan/do_popup_statusjabatan/"+id,
					data: $('#form-statusjabatan').serialize(), 
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
	
	$( "#dialog-statusjabatan" ).dialog( "open" );
	
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
						 <li class="active"><a href="<?php echo base_url(); ?>master_statusjabatan" title="">Status Jabatan</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header 
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Master Status Jabatan</h5>
			    	</div>
			    </div>-->
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                            
				<button onclick="javascript:onAdd_statusjabatan()"  class="btn btn-primary">Tambah</button>				
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Master Status Jabatan</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-statusjabatan" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Nama Status Jabatan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_statusjabatan as $status){
									$id = $status['id_status_jabatan'];
								?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $status['nama_status_jabatan']; ?></td>
										<td>
											<span id="edit-rjabatan" onclick="javascript:onEdit_statusjabatan(<?php echo $id;?>)" class="fam-application-edit"></span>
											<span id="delete-rjabatan" onclick="javascript:onDelete_statusjabatan(<?php echo $id;?>)" class="fam-application-delete"></span>
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
<div id="dialog-statusjabatan" title=""> 
	<form id="form-statusjabatan" method="post" action="" >
		<input type="hidden" id="id" name="id" value="" />
		<div>Nama Status Jabatan :</div>
		<div><input id="nama_status_jabatan" type="text" name="nama_status_jabatan" class="input-xlarge is_required" /></div>
	</form>
</div>


	<!-- /content container -->
	<?php $this->load->view('layout/_actionwrapper'); ?>
</body>
</html>