<!DOCTYPE html>
<html>
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript"> 
$(function() {
	$( "#dialog-unsurpenilaian" ).hide();
	
});
		
function onEdit_unsurpenilaian(id) {
	open_dialog(id, 'Edit Status Jabatan');
}
function onAdd_unsurpenilaian(id) {
	open_dialog('', 'Tambah Status Jabatan');
}

function onDelete_unsurpenilaian(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_unsurpenilaian/do_delete_unsurpenilaian/"+id,
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
			url: "<?php echo base_url(); ?>master_unsurpenilaian/cek_unsurpenilaian/"+id,
			//data: $('#form-unsurpenilaian').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#nama_unsur" ).val( dt[0] );
			}
		});
	}else{
		$( "#nama_unsur" ).val( "" );
	}
	
	$( "#dialog-unsurpenilaian" ).dialog({
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
					url: "<?php echo base_url(); ?>master_unsurpenilaian/do_popup_unsurpenilaian/"+id,
					data: $('#form-unsurpenilaian').serialize(), 
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
	
	$( "#dialog-unsurpenilaian" ).dialog( "open" );
	
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
						 <li class="active"><a href="<?php echo base_url(); ?>master_unsurpenilaian" title="">Unsur Penilaian</a></li>
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
                <!--            
				<button onclick="javascript:onAdd_unsurpenilaian()"  class="btn btn-primary">Tambah</button>				
				-->
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Master Unsur Penilaian</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-unsurpenilaian" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Nama Unsur</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_unsurpenilaian as $status){
									$id = $status['id_unsur'];
								?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $status['nama_unsur']; ?></td>
										<td>
											<span id="edit-rjabatan" onclick="javascript:onEdit_unsurpenilaian(<?php echo $id;?>)" class="fam-application-edit"></span>
											<!--<span id="delete-rjabatan" onclick="javascript:onDelete_unsurpenilaian(<?php echo $id;?>)" class="fam-application-delete"></span>-->
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
<div id="dialog-unsurpenilaian" title=""> 
	<form id="form-unsurpenilaian" method="post" action="" >
		<input type="hidden" id="id" name="id" value="" />
		<div>Nama Unsur :</div>
		<div><input id="nama_unsur" type="text" name="nama_unsur" class="input-xlarge is_required" /></div>
	</form>
</div>


	<!-- /content container -->
	<?php $this->load->view('layout/_actionwrapper'); ?>
</body>
</html>