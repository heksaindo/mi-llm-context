<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript"> 
$(function() {
	$( "#dialog-report" ).hide();
	
});
		
function onEdit_report(id) {
	open_dialog(id, 'Edit Group/Table');
}
function onAdd_report(id) {
	open_dialog('', 'Tambah Group/Table');
}

function onDelete_report(id, title) {
	if(confirm('Delete Group/Table: '+title+'?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>engine_report_master_group/do_delete_report/"+id,
			data: "id="+id, 
			success: function(msg){	
				if(msg == 'success'){		
					window.location.reload();
				}else{
					alert( 'Group/Table tidak dapat dihapus!' );	
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
			dataType: "json",
			url: "<?php echo base_url(); ?>engine_report_master_group/cek_report/"+id,
			//data: $('#form-report').serialize(), 
			success: function(response){	
				var dt = response.data;
				$( "#group_name" ).val( dt.group_name );
				$( "#ref_table" ).val( dt.ref_table );
				$( "#keterangan" ).val( dt.keterangan );
			}
		});
	}else{
		$( "#group_name" ).val( "" );
		$( "#ref_table" ).val( "" );
		$( "#keterangan" ).val( "" );
	}
	
	$( "#dialog-report" ).dialog({
		  autoOpen: false,
		  height: 250,
		  width: 450,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>engine_report_master_group/do_popup_report/"+id,
					data: $('#form-report').serialize(), 
					success: function(msg){	
						if(msg == 'success'){		
							window.location.reload();
									
						}else{
							alert( 'Group/Table tidak dapat disimpan, cek input!' );	
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
	
	$( "#dialog-report" ).dialog( "open" );
	
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
		                <li><a href="<?php echo base_url(); ?>Home">Dashboard</a></li>
						 <li><a href="<?php echo base_url(); ?>engine_report" title="">Engine Report</a></li>
						 <li class="active"><a href="<?php echo base_url(); ?>engine_report_master_group" title="">Master Group/Table</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                
				<br/>
				<button onclick="javascript:onAdd_report()"  class="btn btn-primary">Tambah</button>				
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Group/Table</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-report-data" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Nama Group/Table</th>
                                    <th>Ref.Table</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_rtg as $row){
									$id = $row['id_rtg'];
								?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $row['group_name']; ?></td>
										<td><?php echo $row['ref_table']; ?></td>
										<td><?php echo $row['keterangan']; ?></td>
										<td>
											<span onclick="javascript:onEdit_report(<?php echo $id;?>)" class="fam-application-edit"></span> &nbsp; 
											<span onclick="javascript:onDelete_report(<?php echo $id;?>, '<?php echo $row['group_name']; ?>')" class="fam-application-delete"></span>
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
<div id="dialog-report" title=""> 
	<form id="form-report" method="post" action="" >
		<input type="hidden" id="id" name="id" value="" />
		<table>
			<tr>
				<td>Nama Group/Table</td>
				<td>:</td>
				<td>
					<input id="group_name" type="text" name="group_name" class="input-xlarge is_required" />
				</td>
			</tr>
			<tr>
				<td>Ref.Table</td>
				<td>:</td>
				<td>
					<select id="ref_table" name="ref_table" class="input-xlarge is_required">
						<option value="">Pilih Table</option>					
					<?php
					$data_tables = $this->db->list_tables();
					foreach($data_tables as $dt){
						?>
						<option value="<?php echo $dt; ?>"><?php echo $dt; ?></option>
						<?php
					}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td>:</td>
				<td>
					<input id="keterangan" type="text" name="keterangan" class="input-xlarge" />
				</td>
			</tr>
			
		</table>	
	</form>
</div>


	<!-- /content container -->
	<?php $this->load->view('layout/_actionwrapper'); ?>
</body>
</html>