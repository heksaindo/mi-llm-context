<!DOCTYPE html>
<html>
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript"> 
$(function() {
	$( "#dialog-cuti" ).hide();
	
});
		
function onEdit_cuti(id) {
	open_dialog(id, 'Edit Cuti');
}
function onAdd_cuti(id) {
	open_dialog('', 'Tambah Cuti');
}

function onDelete_cuti(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_cuti/do_delete_cuti/"+id,
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
			url: "<?php echo base_url(); ?>master_cuti/cek_cuti/"+id,
			//data: $('#form-golongan').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#tahun" ).val( dt[0] );
				$( "#libur_bersama" ).val( dt[1] );
				$( "#libur_tahunan" ).val( dt[2] );
			}
		});
	}else{
		$( "#tahun" ).val("");
		$( "#libur_bersama" ).val("");
		$( "#libur_tahunan" ).val("");
	}
	
	$( "#dialog-cuti" ).dialog({
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
					url: "<?php echo base_url(); ?>master_cuti/do_popup_cuti/"+id,
					data: $('#form-cuti').serialize(), 
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
	
	$( "#dialog-cuti" ).dialog( "open" );
	
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
						 <li class="active"><a title="">Master Cuti</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                            
				<button onclick="javascript:onAdd_cuti()"  class="btn btn-primary">Tambah</button>				
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>Master Cuti</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-cuti" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Tahun</th>
                                    <th>Libur Bersama</th>
									<th>Libur Tahunan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_cuti as $row){
								?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $row['tahun']; ?></td>
										<td><?php echo $row['libur_bersama']; ?></td>
										<td><?php echo $row['libur_tahunan']; ?></td>
										<td>
											<span id="edit-rcuti" onclick="javascript:onEdit_cuti(<?php echo $row['id']; ?>)" class="fam-application-edit"></span>
											<span id="delete-rcuti" onclick="javascript:onDelete_cuti(<?php echo $row['id']; ?>)" class="fam-application-delete"></span>
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
<div id="dialog-cuti" title=""> 
	<form id="form-cuti" method="post" action="" >
		<input type="hidden" id="id" name="id" value="" />
		<table>
			<tr>
				<td>Tahun</td>
				<td>:</td>
				<td>
					<input id="tahun" type="text" name="tahun" class="input-xlarge is_required" />
				</td>
			</tr>
			<tr>
				<tr>
				<td>Libur Bersama</td>
				<td>:</td>
				<td>
					<input id="libur_bersama" type="text" name="libur_bersama" class="input-xlarge is_required" />
				</td>
			</tr>
			<tr>
				<td>Libur Tahunan</td>
				<td>:</td>
				<td>
					<input id="libur_tahunan" type="text" name="libur_tahunan" class="input-xlarge is_required" />
				</td>
			</tr>
		</table>	
	</form>
</div>


	<!-- /content container -->
	<?php $this->load->view('layout/_actionwrapper'); ?>
</body>
</html>