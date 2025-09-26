<?php
function cek_child_unit($parent_id,$level,$sel_id, $curr_id = ''){
	$html="";
	$objCI =& get_instance();
	
	$objCI->db->where("parent_unit = '".$parent_id."'");
	if(!empty($curr_id)){
		$objCI->db->where("id_unit_kerja != '".$curr_id."'");
	}
	$objCI->db->order_by("level ASC");
	$q_child = $objCI->db->get("m_unit_kerja");
	
	if($q_child->num_rows() > 0){
		foreach($q_child->result() as $row_child){
			$space="";
			for($i=1;$i<=$level;$i++){
				$space.="&nbsp;&nbsp;&nbsp;&nbsp;";
			}
			$selected="";
			if($sel_id==$row_child->id_unit_kerja){
				$selected='selected="selected"';
			}
			$html.="<option value='".$row_child->id_unit_kerja."' ".$selected.">".$space."&nbsp;&nbsp;|_&nbsp;".$row_child->nama_unit_kerja."</option>";
			$next_level=$level+1;
			$html.= cek_child_unit($row_child->id_unit_kerja,$next_level,$sel_id, $curr_id);	
		}
	}
	return $html;
}
?>
<!DOCTYPE html>
<html>
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript"> 
$(function() {
	$( "#dialog-satuankerja" ).hide();
	
});
		
function onEdit_satuankerja(id) {
	open_dialog(id, 'Edit satuankerja');
}
function onAdd_satuankerja(id) {
	open_dialog('', 'Tambah satuankerja');
}

function onDelete_satuankerja(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_satuankerja/do_delete_satuankerja/"+id,
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
			url: "<?php echo base_url(); ?>master_satuankerja/cek_satuankerja/"+id,
			//data: $('#form-satuankerja').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#nama_unit_kerja" ).val( dt[0] );
				$( "#eselon" ).val( dt[1] );
				$( "#level" ).val( dt[2] );
				$( "#parent_unit" ).val( dt[3] );
			}
		});
	}else{
		$( "#nama_unit_kerja" ).val( "" );
	}
	
	$( "#dialog-satuankerja" ).dialog({
		  autoOpen: false,
		  height: 300,
		  width: 700,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>master_satuankerja/do_popup_satuankerja/"+id,
					data: $('#form-satuankerja').serialize(), 
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
	
	$( "#dialog-satuankerja" ).dialog( "open" );
	
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
						 <li class="active"><a href="<?php echo base_url(); ?>master_satuankerja" title="">Master Satuan Kerja</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header 
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Administrasi Satuan Kerja</h5>
			    	</div>
			    </div>-->
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                            
				<button onclick="javascript:onAdd_satuankerja()"  class="btn btn-primary">Tambah</button>				
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Master Satuan Kerja</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-satuankerja" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Nama Satuan Kerja</th>
                                    <th>Parent Unit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_satuankerja as $row){
									$id = $row['id_satuan_kerja'];
								?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $row['nama_satuan_kerja']; ?></td>
										<td><?php echo get_name('m_unit_kerja','nama_unit_kerja','id_unit_kerja',$row['parent_unit']); ?></td>
										<td>
											<span id="edit-rjabatan" onclick="javascript:onEdit_satuankerja(<?php echo $id;?>)" class="fam-application-edit"></span>
											<span id="delete-rjabatan" onclick="javascript:onDelete_satuankerja(<?php echo $id;?>)" class="fam-application-delete"></span>
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
<div id="dialog-satuankerja" title=""> 
	<form id="form-satuankerja" method="post" action="" >
		<input type="hidden" id="id" name="id" value="" />
		<table>
			<tr>
				<td>Parent</td>
				<td>:</td>
				<td>					
					<select name="parent_unit" id="parent_unit" class="input-xxlarge">
					<?php
						
						$curr_id ='';
						echo "<option value='0' ".$selected.">Root Level</option>";
						$this->db->where("parent_unit = '0'");
						$this->db->where("id_unit_kerja != '".$curr_id."'");
						$this->db->order_by("level ASC");
						$q_account = $this->db->get("m_unit_kerja");
						
						if($q_account->num_rows() > 0){
							foreach($q_account->result() as $row){
								$selected="";
								if($sel_id==$row->id_unit_kerja){
									$selected='selected="selected"';
								}
								echo "<option value='".$row->id_unit_kerja."' ".$selected."> ".$row->nama_unit_kerja."</option>";
								echo cek_child_unit($row->id_unit_kerja,1,$sel_id, $curr_id);
								$selected="";
							}
						}
					?>
					</select>
				
				</td>
			</tr>
			<tr>
				<td>Nama Satuan Kerja</td>
				<td>:</td>
				<td>
					<input id="nama_satuan_kerja" type="text" name="nama_satuan_kerja" class="input-xxlarge is_required" />
				</td>
			</tr>
			
			
		</table>	
	</form>
</div>


	<!-- /content container -->
	<?php $this->load->view('layout/_actionwrapper'); ?>
</body>
</html>