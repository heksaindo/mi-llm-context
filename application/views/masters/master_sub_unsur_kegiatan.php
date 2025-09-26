<!DOCTYPE html>
<html>
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript"> 
$(function() {
	$( "#dialog-sub_unsur_kegiatan" ).hide();
	
});
		
function onEdit_sub_unsur_kegiatan(id) {
	open_dialog(id, 'Edit Sub Unsur Kegiatan');
}
function onAdd_sub_unsur_kegiatan(id) {
	open_dialog('', 'Tambah Sub Unsur Kegiatan');
}

function onDelete_sub_unsur_kegiatan(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_sub_unsur_kegiatan/do_delete_sub_unsur_kegiatan/"+id,
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
			url: "<?php echo base_url(); ?>master_sub_unsur_kegiatan/cek_sub_unsur_kegiatan/"+id,
			//data: $('#form-sub_unsur_kegiatan').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#id_uk" ).val( dt[0] );
				$( "#sub_unsur" ).val( dt[1] );
				$( "#butir_kegiatan" ).val( dt[2] );
				$( "#nilai_uk" ).val( dt[3] );
				$( "#satuan_hasil" ).val( dt[4] );
				$( "#id_jabatan" ).val( dt[5] );
				$( "#pelaksana" ).val( dt[6] );
				$( "#satuan_bagi" ).val( dt[7] );
			}
		});
	}else{
		$( "#id_uk" ).val( "" );
		$( "#sub_unsur" ).val( "" );
		$( "#butir_kegiatan" ).val( "" );
		$( "#nilai_uk" ).val( "" );
		$( "#satuan_hasil" ).val( "" );
		$( "#id_jabatan" ).val( "" );
		$( "#pelaksana" ).val( "" );
		$( "#satuan_bagi" ).val( "" );
	}
	
	$( "#dialog-sub_unsur_kegiatan" ).dialog({
		  autoOpen: false,
		  height: 320,
		  width: 680,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>master_sub_unsur_kegiatan/do_popup_sub_unsur_kegiatan/"+id,
					data: $('#form-sub_unsur_kegiatan').serialize(), 
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
	
	$( "#dialog-sub_unsur_kegiatan" ).dialog( "open" );
	
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
						 <li class="active"><a href="<?php echo base_url(); ?>master_sub_unsur_kegiatan" title="">Master Sub Unsur Kegiatan</a></li>
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
                            
				<button onclick="javascript:onAdd_sub_unsur_kegiatan()"  class="btn btn-primary">Tambah</button>				
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Master Sub Unsur Kegiatan</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-sub_unsur_kegiatan" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Unsur</th>
                                    <th>Sub Unsur</th>
                                    <th>Butir Kegiatan</th>
                                    <th>Satuan</th>
                                    <th>Angka Kredit</th>
                                    <th>Pelaksana</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_sub_unsur_kegiatan as $row){
									$id = $row['id_sub_uk'];
								?>
									<tr>
										<td><?php echo $no; ?></td>										
										<td><?php echo $row['nama_uk']; ?></td>
										<td><?php echo $row['sub_unsur']; ?></td>
										<td><?php echo $row['butir_kegiatan']; ?></td>
										<td><?php echo $row['satuan_hasil']; ?></td>
										<td><?php echo $row['nilai_uk']; ?></td>
										<td><?php echo $row['pelaksana']; ?></td>
										<td>
											<span id="edit-rsub_unsur_kegiatan" onclick="javascript:onEdit_sub_unsur_kegiatan(<?php echo $id;?>)" class="fam-application-edit"></span>
											<span id="delete-rsub_unsur_kegiatan" onclick="javascript:onDelete_sub_unsur_kegiatan(<?php echo $id;?>)" class="fam-application-delete"></span>
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
<div id="dialog-sub_unsur_kegiatan" title=""> 
	<form id="form-sub_unsur_kegiatan" method="post" action="" >
		<input type="hidden" id="id" name="id" value="" />
		<table>
			<tr>
				<td>Unsur</td>
				<td>:</td>
				<td>					
					<select name="id_uk" id="id_uk" class="input-large">
						<option value=""></option>
					<?php
						$this->db->order_by('id_uk','ASC');
						$query = $this->db->get("m_unsur_kegiatan");
						
						if($query->num_rows() > 0){
							foreach($query->result() as $row){
								$selected="";
								if($sel_id==$row->id_uk){
									$selected='selected="selected"';
								}
								echo "<option value='".$row->id_uk."' ".$selected."> ".$row->nama_uk."</option>";
							}
						}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Sub Unsur</td>
				<td>:</td>
				<td>
					<input id="sub_unsur" type="text" name="sub_unsur" class="input-xxlarge" />
				</td>
			</tr>
			<tr>
				<td>Butir Kegiatan</td>
				<td>:</td>
				<td>
					<input id="butir_kegiatan" type="text" name="butir_kegiatan" class="input-xxlarge" />
				</td>
			</tr>
			<tr>
				<td>Satuan Hasil</td>
				<td>:</td>
				<td>
					<input id="satuan_hasil" type="text" name="satuan_hasil" class="input-medium" />
					&nbsp; &nbsp; Satuan Bagi :  
					<input id="satuan_bagi" type="text" name="satuan_bagi" class="input-small" />
				</td>
			</tr>
			<tr>
				<td>Satuan Bagi</td>
				<td>:</td>
				<td>
					
				</td>
			</tr>
			<tr>
				<td>Nilai AK</td>
				<td>:</td>
				<td>
					<input id="nilai_uk" type="text" name="nilai_uk" class="input-medium" />
				</td>
			</tr>
			
			<tr>
				<td>Pelaksana</td>
				<td>:</td>
				<td>					
					<select name="id_jabatan" id="id_jabatan" class="input-large">
						<option value="">Semua Jenjang</option>
					<?php
						$this->db->order_by('nama_jabatan','ASC');
						$this->db->where('id_status_jabatan','2');
						$this->db->where('use_pak','1');
						$query = $this->db->get("m_jabatan");
						
						if($query->num_rows() > 0){
							foreach($query->result() as $row){
								$selected="";
								if($sel_id==$row->id_jabatan){
									$selected='selected="selected"';
								}
								echo "<option value='".$row->id_jabatan."' ".$selected."> ".$row->nama_jabatan."</option>";
							}
						}
					?>
					</select>
					<input type="hidden" name="pelaksana" id="pelaksana" />
				</td>
			</tr>
			
			
			
		</table>	
	</form>
</div>


	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>