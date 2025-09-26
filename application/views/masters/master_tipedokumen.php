<!DOCTYPE html>
<html>
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript"> 
$(function() {
	$( "#dialog-tipedokumen" ).hide();
	
});
		
function onEdit_tipedokumen(id) {
	open_dialog(id, 'Edit Tipe Dokumen');
}
function onAdd_tipedokumen(id) {
	open_dialog('', 'Tambah Tipe Dokumen');
}

function onDelete_tipedokumen(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_tipedokumen/do_delete_tipedokumen/"+id,
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
			url: "<?php echo base_url(); ?>master_tipedokumen/cek_tipedokumen/"+id,
			//data: $('#form-golongan').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#tipedokumen" ).val( dt[0] );
			}
		});
	}else{
		$( "#tipedokumen" ).val("");
	}
	
	$( "#dialog-tipedokumen" ).dialog({
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
					url: "<?php echo base_url(); ?>master_tipedokumen/do_popup_tipedokumen/"+id,
					data: $('#form-tipedokumen').serialize(), 
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
	
	$( "#dialog-tipedokumen" ).dialog( "open" );
	
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
						 <li class="active"><a title="">Master Tipe Dokumen</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                            
				<button onclick="javascript:onAdd_tipedokumen()"  class="btn btn-primary">Tambah</button>				
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>Master Tipe Dokumen</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-tipedokumen" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Nama Dokumen</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_tipedokumen as $row){
								?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $row['tipe_dokumen']; ?></td>
										<td>
											<span id="edit-rtipedokumen" onclick="javascript:onEdit_tipedokumen(<?php echo $row['id']; ?>)" class="fam-application-edit"></span>
											<span id="delete-rtipedokumen" onclick="javascript:onDelete_tipedokumen(<?php echo $row['id']; ?>)" class="fam-application-delete"></span>
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
<div id="dialog-tipedokumen" title=""> 
	<form id="form-tipedokumen" method="post" action="" >
		<input type="hidden" id="id" name="id" value="" />
		<table>
			<tr>
				<td>Nama Dokumen</td>
				<td>:</td>
				<td>
					<input id="tipedokumen" type="text" name="tipe_dokumen" class="input-xlarge is_required" />
				</td>
			</tr>
		</table>	
	</form>
</div>


	<!-- /content container -->
	<?php $this->load->view('layout/_actionwrapper'); ?>
</body>
</html>