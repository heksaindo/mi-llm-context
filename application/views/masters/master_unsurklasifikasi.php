<!DOCTYPE html>
<html>
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript"> 
$(function() {
	$( "#dialog-klasifikasi" ).hide();
	
});
		
function onEdit_klasifikasi(id) {
	open_dialog(id, 'Edit klasifikasi');
}
function onAdd_klasifikasi(id) {
	open_dialog('', 'Tambah klasifikasi');
}

function onDelete_klasifikasi(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_unsurklasifikasi/do_delete_klasifikasi/"+id,
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
			url: "<?php echo base_url(); ?>master_unsurklasifikasi/cek_klasifikasi/"+id,
			//data: $('#form-klasifikasi').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#nama_klasifikasi" ).val( dt[0] );
				$( "#id_unsur" ).val( dt[1] );
				$( "#skor" ).val( dt[2] );
				$( "#tolok_ukur" ).val( dt[3] );
			}
		});
	}else{
		$( "#nama_klasifikasi" ).val( "" );
		$( "#id_unsur" ).val( "" );
		$( "#skor" ).val( "" );
		$( "#tolok_ukur" ).val( "" );
	}
	
	$( "#dialog-klasifikasi" ).dialog({
		  autoOpen: false,
		  height: 300,
		  width: 500,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>master_unsurklasifikasi/do_popup_klasifikasi/"+id,
					data: $('#form-klasifikasi').serialize(), 
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
	
	$( "#dialog-klasifikasi" ).dialog( "open" );
	
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
						 <li class="active"><a href="<?php echo base_url(); ?>master_unsurklasifikasi" title="">Master Unsur Klasifikasi</a></li>
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
                            
				<button onclick="javascript:onAdd_klasifikasi()"  class="btn btn-primary">Tambah</button>				
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Master Unsur Klasifikasi</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-klasifikasi" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Nama Klasifikasi</th>
                                    <th>Unsur Penilaian</th>
                                    <th>Skor</th>
                                    <th>Tolok Ukur</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_klasifikasi as $row){
									$id = $row['id_klasifikasi'];
								?>
									<tr>
										<td><?php echo $no; ?></td>										
										<td><?php echo $row['nama_klasifikasi']; ?></td>
										<td><?php echo get_name('m_unsur_penilaian','nama_unsur','id_unsur',$row['id_unsur']); ?></td>
										<td><?php echo $row['skor']; ?></td>
										<td><?php echo $row['tolok_ukur']; ?></td>
										<td>
											<span id="edit-rklasifikasi" onclick="javascript:onEdit_klasifikasi(<?php echo $id;?>)" class="fam-application-edit"></span>
											<span id="delete-rklasifikasi" onclick="javascript:onDelete_klasifikasi(<?php echo $id;?>)" class="fam-application-delete"></span>
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
<div id="dialog-klasifikasi" title=""> 
	<form id="form-klasifikasi" method="post" action="" >
		<input type="hidden" id="id" name="id" value="" />
		<table>
			<tr>
				<td>Unsur Penilaian</td>
				<td>:</td>
				<td>					
					<select name="id_unsur" id="id_unsur" class="input-large">
						<option value=""></option>
					<?php

						$query = $this->db->get("m_unsur_penilaian");
						
						if($query->num_rows() > 0){
							foreach($query->result() as $row){
								$selected="";
								if($sel_id==$row->id_unsur){
									$selected='selected="selected"';
								}
								echo "<option value='".$row->id_unsur."' ".$selected."> ".$row->nama_unsur."</option>";
							}
						}
					?>
					</select>
				
				</td>
			</tr>
			<tr>
				<td>Unsur Klasifikasi</td>
				<td>:</td>
				<td>
					<input id="nama_klasifikasi" type="text" name="nama_klasifikasi" class="input-xlarge is_required" />
				</td>
			</tr>
			<tr>
				<td>Skor</td>
				<td>:</td>
				<td>
					<input id="skor" type="text" name="skor" class="input-medium is_required" />
				</td>
			</tr>
			<tr>
				<td>Tolok Ukur</td>
				<td>:</td>
				<td>
					<input id="tolok_ukur" type="text" name="tolok_ukur" class="input-medium is_required" />
				</td>
			</tr>
			
			
		</table>	
	</form>
</div>


	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>