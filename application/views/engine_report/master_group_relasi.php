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
	open_dialog(id, 'Edit Relasi Group/Table');
}
function onAdd_report(id) {
	open_dialog('', 'Tambah Relasi Group/Table');
}

function onDelete_report(id, title) {
	if(confirm('Delete Relasi Group/Table: '+title+'?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>engine_report_master_group_relasi/do_delete_report/"+id,
			data: "id="+id, 
			success: function(msg){	
				if(msg == 'success'){		
					window.location.reload();
				}else{
					alert( 'Relasi Group/Table tidak dapat dihapus!' );	
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
			url: "<?php echo base_url(); ?>engine_report_master_group_relasi/cek_report/"+id,
			//data: $('#form-report').serialize(), 
			success: function(response){	
				var dt = response.data;
				$( "#id_rtg_from" ).val( dt.id_rtg_from );
				$( "#id_rtg_to" ).val( dt.id_rtg_to );
				$( "#relasi_rtg" ).val( dt.relasi_rtg );
			}
		});
	}else{
		$( "#id_rtg_from" ).val( "" );
		$( "#id_rtg_to" ).val( "" );
		$( "#relasi_rtg" ).val( "" );
	}
	
	$( "#dialog-report" ).dialog({
		  autoOpen: false,
		  height: 350,
		  width: 450,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>engine_report_master_group_relasi/do_popup_report/"+id,
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
						 <li class="active"><a href="<?php echo base_url(); ?>engine_report_master_group_relasi" title="">Master Relasi Group/Table</a></li>
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
                        	<h6>Relasi Group/Table</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-report-data" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Group/Table 1</th>
                                    <th>Group/Table 2</th>
                                    <th>Relasi Antar Table</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_relas_rtg as $row){
									$id = $row['id_rtgr'];
								?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $row['table_name1'].' ('.$row['ref_table1'].')'; ?></td>
										<td><?php echo $row['table_name2'].' ('.$row['ref_table2'].')'; ?></td>
										<td><?php echo $row['relasi_rtg']; ?></td>
										<td>
											<span onclick="javascript:onEdit_report(<?php echo $id;?>)" class="fam-application-edit"></span> &nbsp; 
											<span onclick="javascript:onDelete_report(<?php echo $id;?>, '<?php echo $row['table_name1'].' - '.$row['table_name2']; ?>')" class="fam-application-delete"></span>
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
				<td>Group/Table 1</td>
				<td>:</td>
				<td>
					<select id="id_rtg_from" name="id_rtg_from" class="input-xlarge is_required">
						<option value=""> </option>
						<?php
						if($data_table_group){
							foreach($data_table_group as $row){
								
								echo '<option value="'.$row['id_rtg'].'" >'.$row['group_name'].' ('.$row['ref_table'].')</option>';
							}
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Group/Table 2</td>
				<td>:</td>
				<td>
					<select id="id_rtg_to" name="id_rtg_to" class="input-xlarge is_required">
						<option value=""> </option>
						<?php
						if($data_table_group){
							foreach($data_table_group as $row){
								
								echo '<option value="'.$row['id_rtg'].'" >'.$row['group_name'].' ('.$row['ref_table'].')</option>';
							}
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Relasi Antar Table</td>
				<td>:</td>
				<td>
					<textarea cols="200" rows="8" id="relasi_rtg" name="relasi_rtg" class="input-xlarge"></textarea>
				</td>
			</tr>
			
		</table>	
	</form>
</div>


	<!-- /content container -->
	<?php $this->load->view('layout/_actionwrapper'); ?>
</body>
</html>