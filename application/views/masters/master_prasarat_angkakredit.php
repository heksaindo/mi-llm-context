<!DOCTYPE html>
<html>
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript"> 
$(function() {
	$( "#dialog-prasarat_angkakredit" ).hide();
	
});
		
function onEdit_prasarat_angkakredit(id) {
	open_dialog(id, 'Edit Prasarat Angkakredit');
}
function onAdd_prasarat_angkakredit(id) {
	open_dialog('', 'Tambah Prasarat Angkakredit');
}

function onDelete_prasarat_angkakredit(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_prasarat_angkakredit/do_delete_prasarat_angkakredit/"+id,
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
			url: "<?php echo base_url(); ?>master_prasarat_angkakredit/cek_prasarat_angkakredit/"+id,
			//data: $('#form-prasarat_angkakredit').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#id_jabatan" ).val( dt[0] );
				$( "#id_golongan" ).val( dt[1] );
				$( "#jenjang" ).val( dt[2] );
				$( "#nilai_ak" ).val( dt[3] );
			}
		});
	}else{
		$( "#id_jabatan" ).val( "" );
		$( "#id_golongan" ).val( "" );
		$( "#jenjang" ).val( "" );
		$( "#nilai_ak" ).val( "" );
	}
	
	$( "#dialog-prasarat_angkakredit" ).dialog({
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
					url: "<?php echo base_url(); ?>master_prasarat_angkakredit/do_popup_prasarat_angkakredit/"+id,
					data: $('#form-prasarat_angkakredit').serialize(), 
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
	
	$( "#dialog-prasarat_angkakredit" ).dialog( "open" );
	
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
						 <li class="active"><a href="<?php echo base_url(); ?>master_prasarat_angkakredit" title="">Master Prasarat Angka Kredit</a></li>
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
                            
				<button onclick="javascript:onAdd_prasarat_angkakredit()"  class="btn btn-primary">Tambah</button>				
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Master Prasarat Angka Kredit</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-prasarat_angkakredit" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Jabatan Fungsional</th>
                                    <th>Golongan</th>
                                    <th>Jenjang</th>
                                    <th>Nilai AK</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_prasarat_angkakredit as $row){
									$id = $row['id_ak'];
								?>
									<tr>
										<td><?php echo $no; ?></td>										
										<td><?php echo get_name('m_jabatan','nama_jabatan','id_jabatan',$row['id_jabatan']); ?></td>
										<td><?php echo get_name('m_golongan','kode_golongan','id_golongan',$row['id_golongan']); ?></td>
										<td><?php echo $row['jenjang']; ?></td>
										<td><?php echo $row['nilai_ak']; ?></td>
										<td>
											<span id="edit-rprasarat_angkakredit" onclick="javascript:onEdit_prasarat_angkakredit(<?php echo $id;?>)" class="fam-application-edit"></span>
											<span id="delete-rprasarat_angkakredit" onclick="javascript:onDelete_prasarat_angkakredit(<?php echo $id;?>)" class="fam-application-delete"></span>
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
<div id="dialog-prasarat_angkakredit" title=""> 
	<form id="form-prasarat_angkakredit" method="post" action="" >
		<input type="hidden" id="id" name="id" value="" />
		<table>
			<tr>
				<td>Jabatan Fungsional</td>
				<td>:</td>
				<td>					
					<select name="id_jabatan" id="id_jabatan" class="input-large">
						<option value=""></option>
					<?php
						$this->db->order_by('id_jabatan','ASC');
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
				
				</td>
			</tr>
			<tr>
				<td>Golongan</td>
				<td>:</td>
				<td>
					<select name="id_golongan" id="id_golongan" class="input-large">
						<option value=""></option>
					<?php

						$query = $this->db->get("m_golongan");
						
						if($query->num_rows() > 0){
							foreach($query->result() as $row){
								$selected="";
								if($sel_id==$row->id_golongan){
									$selected='selected="selected"';
								}
								echo "<option value='".$row->id_golongan."' ".$selected."> ".$row->kode_golongan.' - '.$row->nama_golongan."</option>";
							}
						}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Jenjang</td>
				<td>:</td>
				<td>
					<select id="jenjang" name="jenjang" class="input-medium">
						<option value="Terampil">Terampil</option>
						<option value="Ahli">Ahli</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Nilai AK</td>
				<td>:</td>
				<td>
					<input id="nilai_ak" type="text" name="nilai_ak" class="input-medium is_required" />
				</td>
			</tr>
			
			
		</table>	
	</form>
</div>


	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>