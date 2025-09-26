<!DOCTYPE html>
<html>
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript"> 
$(function() {
	$( "#dialog-golongan" ).hide();
	
});
		
function onEdit_golongan(id) {
	open_dialog(id, 'Edit golongan');
}
function onAdd_golongan(id) {
	open_dialog('', 'Tambah golongan');
}

function onDelete_golongan(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_golongan/do_delete_golongan/"+id,
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
			url: "<?php echo base_url(); ?>master_golongan/cek_golongan/"+id,
			//data: $('#form-golongan').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#kode_golongan" ).val( dt[0] );
				$( "#nama_golongan" ).val( dt[1] );
				$( "#kdkelgapok" ).val( dt[2] );
				$( "#level" ).val( dt[3] );
			}
		});
	}else{
		$( "#kode_golongan" ).val( "" );
		$( "#nama_golongan" ).val( "" );
		$( "#kdkelgapok" ).val( "" );
		$( "#level" ).val( "" );
	}
	
	$( "#dialog-golongan" ).dialog({
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
					url: "<?php echo base_url(); ?>master_golongan/do_popup_golongan/"+id,
					data: $('#form-golongan').serialize(), 
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
	
	$( "#dialog-golongan" ).dialog( "open" );
	
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
						 <li class="active"><a href="<?php echo base_url(); ?>master_golongan" title="">Master Golongan</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header 
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Master Golongan</h5>
			    	</div>
			    </div>-->
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                            
				<button onclick="javascript:onAdd_golongan()"  class="btn btn-primary">Tambah</button>				
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Master Golongan</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-golongan" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Kode Golongan</th>
                                    <th>Nama Golongan</th>
                                    <th>Kode Kel Gapok</th>
                                    <th>Level</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_golongan as $row){
									$id = $row['id_golongan'];
								?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $row['kode_golongan']; ?></td>
										<td><?php echo $row['nama_golongan']; ?></td>
										<td><?php echo $row['kdkelgapok']; ?></td>
										<td><?php echo $row['level']; ?></td>
										<td>
											<span id="edit-rgolongan" onclick="javascript:onEdit_golongan(<?php echo $id;?>)" class="fam-application-edit"></span>
											<span id="delete-rgolongan" onclick="javascript:onDelete_golongan(<?php echo $id;?>)" class="fam-application-delete"></span>
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
<div id="dialog-golongan" title=""> 
	<form id="form-golongan" method="post" action="" >
		<input type="hidden" id="id" name="id" value="" />
		<table>
			<tr>
				<td>Kode Golongan</td>
				<td>:</td>
				<td>
					<input id="kode_golongan" type="text" name="kode_golongan" class="input-xlarge is_required" />
				</td>
			</tr>
			<tr>
				<td>Nama Golongan</td>
				<td>:</td>
				<td>
					<input id="nama_golongan" type="text" name="nama_golongan" class="input-xlarge is_required" />
				</td>
			</tr>
			<tr>
				<td>Kode Kelompok Gapok</td>
				<td>:</td>
				<td>
					<input id="kdkelgapok" type="text" name="kdkelgapok" class="input-small is_required" />
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