
<!DOCTYPE html>
<html>
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript"> 
$(function() {
	$( "#dialog-city" ).hide();
	
});
		
function onEdit_city(id) {
	open_dialog(id, 'Edit city');
}
function onAdd_city(id) {
	open_dialog('', 'Tambah city');
}

function onDelete_city(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_city/do_delete_city/"+id,
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
			url: "<?php echo base_url(); ?>master_city/cek_city/"+id,
			//data: $('#form-city').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#city_name" ).val( dt[0] );
				$( "#prov_id" ).val( dt[1] );
			}
		});
	}else{
		$( "#city_name" ).val( "" );
		$( "#prov_id" ).val( "" );
	}
	
	$( "#dialog-city" ).dialog({
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
					url: "<?php echo base_url(); ?>master_city/do_popup_city/"+id,
					data: $('#form-city').serialize(), 
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
	
	$( "#dialog-city" ).dialog( "open" );
	
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
						 <li class="active"><a href="<?php echo base_url(); ?>master_city" title="">Master Kabupaten/Kota</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header 
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Administrasi Kabupaten/Kota</h5>
			    	</div>
			    </div>-->
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                            
				<button onclick="javascript:onAdd_city()"  class="btn btn-primary">Tambah</button>				
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Master Kabupaten/Kota</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-city" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Kabupaten/Kota</th>
                                    <th>Propinsi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_city as $row){
									$id = $row['city_id'];
								?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $row['city_name']; ?></td>
										<td><?php echo get_name('m_provinces','prov_name','prov_id',$row['prov_id']); ?></td>
										<td>
											<span id="edit-rjabatan" onclick="javascript:onEdit_city(<?php echo $id;?>)" class="fam-application-edit"></span>
											<span id="delete-rjabatan" onclick="javascript:onDelete_city(<?php echo $id;?>)" class="fam-application-delete"></span>
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
<div id="dialog-city" title=""> 
	<form id="form-city" method="post" action="" >
		<input type="hidden" id="id" name="id" value="" />
		<table>
			<tr>
				<td>Propinsi</td>
				<td>:</td>
				<td>					
					<select name="prov_id" id="prov_id" class="input-xlarge">
					<?php

						$q_account = $this->db->get("m_provinces");
						
						if($q_account->num_rows() > 0){
							foreach($q_account->result() as $row){
								$selected="";
								if($sel_id==$row->prov_id){
									$selected='selected="selected"';
								}
								echo "<option value='".$row->prov_id."' ".$selected."> ".$row->prov_name."</option>";
							}
						}
					?>
					</select>
				
				</td>
			</tr>
			<tr>
				<td>Nama Kabupaten/Kota</td>
				<td>:</td>
				<td>
					<input id="city_name" type="text" name="city_name" class="input-xlarge is_required" />
				</td>
			</tr>
			
			
		</table>	
	</form>
</div>


	<!-- /content container -->
	<?php $this->load->view('layout/_actionwrapper'); ?>
</body>
</html>