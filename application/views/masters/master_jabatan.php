<!DOCTYPE html>
<html>
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript"> 
$(function() {
	$( "#dialog-jabatan" ).hide();
	
});
		
function onEdit_jabatan(id) {
	open_dialog(id, 'Edit jabatan');
}
function onAdd_jabatan(id) {
	open_dialog('', 'Tambah jabatan');
}

function onDelete_jabatan(id, use_pak) {
	if(confirm('Delete data ?')){	
		if(use_pak == '1'){
			alert( 'Data tidak dapat dihapus, karena di gunakan untuk Penilaian Angka Kredit' );
		}else{
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>master_jabatan/do_delete_jabatan/"+id,
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
}

function open_dialog(id, titlex) {

	$( "#id" ).val( id );
	
	if(id > 0){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_jabatan/cek_jabatan/"+id,
			//data: $('#form-jabatan').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$("#nama_jabatan").removeAttr('readonly');
				$("#id_status_jabatan").removeAttr('readonly');

				$( "#nama_jabatan" ).val( dt[0] );
				$( "#id_status_jabatan" ).val( dt[1] );
				$( "#use_pak" ).val( dt[2] );
				if(dt[2] == '1'){
					$("#nama_jabatan").attr('readonly','readonly');
					$("#id_status_jabatan").attr('readonly','readonly');
					
					alert('Data digunakan untuk Penilaian Angka Kredit, Nama dan Status Jabatan tidak boleh diubah!');
				}
			}
		});
	}else{
		$( "#nama_jabatan" ).val( "" );
		$( "#id_status_jabatan" ).val( "" );
		$( "#use_pak" ).val( "" );
	}
	
	$( "#dialog-jabatan" ).dialog({
		  autoOpen: false,
		  height: 200,
		  width: 500,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>master_jabatan/do_popup_jabatan/"+id,
					data: $('#form-jabatan').serialize(), 
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
	
	$( "#dialog-jabatan" ).dialog( "open" );
	
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
						 <li class="active"><a href="<?php echo base_url(); ?>master_jabatan" title="">Master Jabatan</a></li>
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
                            
				<button onclick="javascript:onAdd_jabatan()"  class="btn btn-primary">Tambah</button>				
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Master Jabatan</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-jabatan" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Nama Jabatan</th>
                                    <th>Status Jabatan</th>
                                    <th>Jabatan PAK</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_jabatan as $row){
									$id = $row['id_jabatan'];
								?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $row['nama_jabatan']; ?></td>
										<td><?php echo get_name('m_status_jabatan','nama_status_jabatan','id_status_jabatan',$row['id_status_jabatan']); ?></td>
										<td><?php if($row['use_pak'] == '1'){ echo 'Ya'; }else{ echo 'Tidak'; } ?></td>
										<td>
											<span id="edit-rjabatan" onclick="javascript:onEdit_jabatan(<?php echo $id;?>, <?php echo $row['use_pak'];?>)" class="fam-application-edit"></span>
											<span id="delete-rjabatan" onclick="javascript:onDelete_jabatan(<?php echo $id;?>, <?php echo $row['use_pak'];?>)" class="fam-application-delete"></span>
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
<div id="dialog-jabatan" title=""> 
	<form id="form-jabatan" method="post" action="" >
		<input type="hidden" id="id" name="id" value="" />
		<table>
			<tr>
				<td>Nama Jabatan</td>
				<td>:</td>
				<td>
					<input id="nama_jabatan" type="text" name="nama_jabatan" class="input-xlarge is_required" />
				</td>
			</tr>
			<tr>
				<td>Status Jabatan</td>
				<td>:</td>
				<td>					
					<select name="id_status_jabatan" id="id_status_jabatan" class="input-large">
						<option value=""></option>
					<?php

						$query = $this->db->get("m_status_jabatan");
						
						if($query->num_rows() > 0){
							foreach($query->result() as $row){
								$selected="";
								if($sel_id==$row->id_status_jabatan){
									$selected='selected="selected"';
								}
								echo "<option value='".$row->id_status_jabatan."' ".$selected."> ".$row->nama_status_jabatan."</option>";
							}
						}
					?>
					</select>
				
				</td>
			</tr>
			<tr>
				<td>Untuk Jabatan PAK</td>
				<td>:</td>
				<td>					
					<select name="use_pak" id="use_pak" class="input-small">
						<option value="0">Tidak</option>
						<option value="1">Ya</option>
						
					</select>
				</td>
			</tr>
		</table>	
	</form>
</div>


	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>