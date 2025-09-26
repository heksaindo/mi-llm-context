<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript"> 
$(document).ready(function(){
	$( "#dialog-report" ).hide();
	
	//onChange group/table
	$( "#id_rtg" ).change(function() {
		var id_rtg = $( "#id_rtg" ).val();
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>engine_report_master_field/get_field",
			data: "id_rtg="+id_rtg, 
			success: function(msg){	
				if(msg){
					$( "#ref_field" ).html(msg);
				}
				return false;
			}
		});
	});	
	
	//onChange group/table
	$( "#ref_field" ).change(function() {
		var ref_field = $( "#ref_field" ).val();
		$( "#ref_field2" ).val( ref_field );
	});	
	
});
		
function onEdit_report(id) {
	open_dialog(id, 'Edit Field');
}
function onAdd_report(id) {
	open_dialog('', 'Tambah Field');
}

function onDelete_report(id, title) {
	if(confirm('Delete Field: '+title+'?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>engine_report_master_field/do_delete_report/"+id,
			data: "id="+id, 
			success: function(msg){	
				if(msg == 'success'){		
					window.location.reload();
				}else{
					alert( 'Field tidak dapat dihapus!' );	
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
			url: "<?php echo base_url(); ?>engine_report_master_field/cek_report/"+id,
			//data: $('#form-report').serialize(), 
			success: function(response){	
				var dt = response.data;
				
				if(dt.require_sql == 0){
					dt.require_sql = '';
				}
				
				$( "#tf_name" ).val( dt.tf_name );
				$( "#id_rtg" ).val( dt.id_rtg );
				$( "#ref_field2" ).val( dt.ref_field );
				$( "#tf_tipe" ).val( dt.tf_tipe );
				$( "#option_value" ).val( dt.option_value );
				$( "#tf_additional_sql_select" ).val( dt.tf_additional_sql_select );
				$( "#tf_additional_sql_join" ).val( dt.tf_additional_sql_join );
				$( "#tf_additional_sql_where" ).val( dt.tf_additional_sql_where );
				$( "#tf_additional_sql_order_group" ).val( dt.tf_additional_sql_order_group );
				$( "#require_sql" ).val( dt.require_sql );
				$( "#keterangan" ).val( dt.keterangan );
				
				
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>engine_report_master_field/get_field",
					data: "id_rtg="+dt.id_rtg, 
					success: function(msg){	
						if(msg){
							$( "#ref_field" ).html(msg);							
							$( "#ref_field" ).val( dt.ref_field );
							$( "#ref_field2" ).val( dt.ref_field );
						}
						return false;
					}
				});
			}
		});
	}else{
		$( "#tf_name" ).val( "" );
		$( "#id_rtg" ).val( "" );
		$( "#ref_field" ).val( "" );
		$( "#ref_field2" ).val( "" );
		$( "#tf_tipe" ).val( "" );
		$( "#option_value" ).val( "" );
		$( "#tf_additional_sql_select" ).val( "" );
		$( "#tf_additional_sql_join" ).val( "" );
		$( "#tf_additional_sql_where" ).val( "" );
		$( "#tf_additional_sql_order_group" ).val( "" );
		$( "#require_sql" ).val( "" );
		$( "#keterangan" ).val( "" );
	}
	
	$( "#dialog-report" ).dialog({
		  autoOpen: false,
		  height: 550,
		  width: 450,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>engine_report_master_field/do_popup_report/"+id,
					data: $('#form-report').serialize(), 
					success: function(msg){	
						if(msg == 'success'){		
							window.location.reload();
									
						}else{
							alert( 'Field tidak dapat disimpan, cek input!' );	
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
						 <li class="active"><a href="<?php echo base_url(); ?>engine_report_master_field" title="">Master Field</a></li>
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
                        	<h6>List Field</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-report-data" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>NO</th>
									<th>#ID</th>
                                    <th>Nama Field</th>
                                    <th>Ref. Field</th>
                                    <th>Req. Field</th>
                                    <th>Nama Group/Table</th>
                                    <th>Add.Sql Select</th>
                                    <th>Add.Sql Join</th>
                                    <th>Add.Sql Where</th>
                                    <th>Add.Sql Order/Group</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_rtf as $row){
									$id = $row['id_rtf'];
									
									if(!empty($row['require_sql'])){
										$row['require_sql'] = '#'.$row['require_sql'];
									}else{
										$row['require_sql'] = '';
									}
								?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $row['id_rtf']; ?></td>
										<td><?php echo $row['tf_name']; ?></td>
										<td><?php echo $row['ref_field']; ?></td>
										<td><?php echo $row['require_sql']; ?></td>
										<td><?php echo $row['group_name']; ?></td>
										<td><?php echo $row['tf_additional_sql_select']; ?></td>
										<td><?php echo $row['tf_additional_sql_join']; ?></td>
										<td><?php echo $row['tf_additional_sql_where']; ?></td>
										<td><?php echo $row['tf_additional_sql_order_group']; ?></td>
										<td>
											<span onclick="javascript:onEdit_report(<?php echo $id;?>)" class="fam-application-edit"></span> &nbsp; 
											<span onclick="javascript:onDelete_report(<?php echo $id;?>, '<?php echo $row['tf_name']; ?>')" class="fam-application-delete"></span>
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
				<td>Group/Table</td>
				<td>:</td>
				<td>
					<select id="id_rtg" name="id_rtg" class="input-xlarge is_required">
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
				<td>Nama Field</td>
				<td>:</td>
				<td>
					<input id="tf_name" type="text" name="tf_name" class="input-xlarge is_required" />
				</td>
			</tr>
			<tr>
				<td>Ref.Field (database)</td>
				<td>:</td>
				<td>
					<select id="ref_field" name="ref_field" class="input-xlarge">
						<option value="">Pilih Data/Field</option>
					</select>
				</td>
			</tr>			
			<tr>
				<td>Ref.Field (Custom)</td>
				<td>:</td>
				<td>
					<input id="ref_field2" type="text" name="ref_field2" class="input-xlarge"/>
				</td>
			</tr>			
			<tr>
				<td>Req.Field</td>
				<td>:</td>
				<td>
					<input id="require_sql" type="text" name="require_sql" class="input-xlarge" />
				</td>
			</tr>			
			<tr>
				<td>Tipe Field</td>
				<td>:</td>
				<td>
					<select id="tf_tipe" name="tf_tipe" class="input-xlarge is_required">
						<option value="text">Text</option>
						<option value="date">Date</option>
						<option value="option">Option</option>
					</select>
				</td>
			</tr>			
			<tr>
				<td>Option Value *tipe=Option</td>
				<td>:</td>
				<td>
					<textarea cols="200" rows="8" id="option_value" name="option_value" class="input-xlarge"></textarea>
				</td>
			</tr>				
			<tr>
				<td>Add. Sql Select</td>
				<td>:</td>
				<td>
					<textarea cols="200" rows="8" id="tf_additional_sql_select" name="tf_additional_sql_select" class="input-xlarge"></textarea>
				</td>
			</tr>			
			<tr>
				<td>Add. Sql Join</td>
				<td>:</td>
				<td>
					<textarea cols="200" rows="8" id="tf_additional_sql_join" name="tf_additional_sql_join" class="input-xlarge"></textarea>
				</td>
			</tr						
			<tr>
				<td>Add. Sql Where</td>
				<td>:</td>
				<td>
					<textarea cols="200" rows="8" id="tf_additional_sql_where" name="tf_additional_sql_where" class="input-xlarge"></textarea>
				</td>
			</tr>						
			<tr>
				<td>Add. Sql Order/Group</td>
				<td>:</td>
				<td>
					<textarea cols="200" rows="8" id="tf_additional_sql_order_group" name="tf_additional_sql_order_group" class="input-xlarge"></textarea>
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