<!DOCTYPE html>
<html>
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript"> 
$(function() {
	$( "#dialog-pelatihan" ).hide();

});
		
function onEdit_pelatihan(id) {
	open_dialog(id, 'Edit pelatihan');
}
function onAdd_pelatihan(id) {
	open_dialog('', 'Tambah pelatihan');
}

function onDelete_pelatihan(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_pelatihan/do_delete_pelatihan/"+id,
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
			url: "<?php echo base_url(); ?>master_pelatihan/cek_pelatihan/"+id,
			//data: $('#form-pelatihan').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#nama_pelatihan" ).val( dt[0] );
				$( "#level" ).val( dt[1] );
			}
		});
	}else{
		$( "#nama_pelatihan" ).val( "" );
	}
	
	$( "#dialog-pelatihan" ).dialog({
		  autoOpen: false,
		  height: 300,
		  width: 400,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>master_pelatihan/do_popup_pelatihan/"+id,
					data: $('#form-pelatihan').serialize(), 
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
	
	$( "#dialog-pelatihan" ).dialog( "open" );
	
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
						 <li class="active"><a href="<?php echo base_url(); ?>master_pelatihan" title="">Master Pelatihan</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header 
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Master Pelatihan</h5>
			    	</div>
			    </div>-->
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                            
				<button onclick="javascript:onAdd_pelatihan()"  class="btn btn-primary">Tambah</button>				
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Master Pelatihan</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-pelatihan" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Nama Pelatihan</th>
                                    <th>Level</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_pelatihan as $row){
									$id = $row['id_pelatihan'];
								?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $row['nama_pelatihan']; ?></td>
										<td><?php echo $row['level']; ?></td>
										<td>
											<span id="edit-rjabatan" onclick="javascript:onEdit_pelatihan(<?php echo $id;?>)" class="fam-application-edit"></span>
											<span id="delete-rjabatan" onclick="javascript:onDelete_pelatihan(<?php echo $id;?>)" class="fam-application-delete"></span>
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
<div id="dialog-pelatihan" title=""> 
	<form id="form-pelatihan" method="post" action="" >
		<input type="hidden" id="id" name="id" value="" />
		<table>
			<tr>
				<td>Nama Pelatihan</td>
				<td>:</td>
				<td>
					<input id="nama_pelatihan" type="text" name="nama_pelatihan" class="input-xlarge is_required" />
				</td>
			</tr>
			<tr>
				<td>Level</td>
				<td>:</td>
				<td>
					<input id="level" type="text" name="level" class="input-small is_required" />
				</td>
			</tr>
			
		</table>	
	</form>
</div>


	<!-- /content container -->
	<?php $this->load->view('layout/_actionwrapper'); ?>
</body>
</html>