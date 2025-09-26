<!DOCTYPE html>
<html>
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript"> 
$(function() {
	$( "#dialog-jenispegawai" ).hide();
	
});
		
function onEdit_jenispegawai(id) {
	open_dialog(id, 'Edit Jenis Pegawai');
}
function onAdd_jenispegawai(id) {
	open_dialog('', 'Tambah Jenis Pegawai');
}

function onDelete_jenispegawai(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_jenispegawai/do_delete_jenispegawai/"+id,
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
			url: "<?php echo base_url(); ?>master_jenispegawai/cek_jenispegawai/"+id,
			success: function(data){	
				var dt = explode('|', data);
				$( "#nama_jenis_kepegawaian" ).val( dt[0] );
			}
		});
	}else{
		$( "#nama_jenis_kepegawaian" ).val( "" );
	}
	
	$( "#dialog-jenispegawai" ).dialog({
		  autoOpen: false,
		  height: 150,
		  width: 400,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>master_jenispegawai/do_popup_jenispegawai/"+id,
					data: $('#form-jenispegawai').serialize(), 
					success: function(msg,e){	
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
	
	$( "#dialog-jenispegawai" ).dialog( "open" );
	
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
						 <li class="active"><a title="">Master Kat Masalah</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <?php $this->load->view('layout/_actionwrapper'); ?>
                            
				<button onclick="javascript:onAdd_jenispegawai()"  class="btn btn-primary">Tambah</button>				
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Kat Masalah</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-jenispegawai" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Kategori</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_jenispegawai as $row){
								?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $row['nama_jenis_kepegawaian']; ?></td>
										<td>
											<span id="edit-rjenispegawai" onclick="javascript:onEdit_jenispegawai(<?php echo $row['id_jenis_kepegawaian'] ?>)" class="fam-application-edit"></span>
											<span id="delete-rjenispegawai" onclick="javascript:onDelete_jenispegawai(<?php echo $row['id_jenis_kepegawaian'] ?>)" class="fam-application-delete"></span>
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
<div id="dialog-jenispegawai" title=""> 
	<form id="form-jenispegawai" method="post" action="" >
		<input type="hidden" id="id" name="id" value="" />
		<table>
			<tr>
				<td>Kategori</td>
				<td>:</td>
				<td>
					<input id="nama_jenis_kepegawaian" type="text" name="nama_jenis_kepegawaian" class="input-xlarge is_required" />
				</td>
			</tr>
		</table>	
	</form>
</div>


	<!-- /content container -->
	<?php $this->load->view('layout/_actionwrapper'); ?>
</body>
</html>