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
			$html.="<option value='".$row_child->id_unit_kerja."' ".$selected.">".$space."&nbsp;&nbsp;|_&nbsp;(".$row_child->kode_unit_kerja.') '.$row_child->nama_unit_kerja."</option>";
			$next_level=$level+1;
			$html.= cek_child_unit($row_child->id_unit_kerja,$next_level,$sel_id, $curr_id);	
		}
	}
	return $html;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
<?php $this->load->view('layout/_head3'); ?>
<script type="text/javascript"> 
$(function() {
	$( "#dialog-unitkerja" ).hide(); 
	
	$( "#parent_unit" ).change(function(){
		var parent_unit = $( "#parent_unit" ).val();
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_unitkerja/cek_kode/",
			data: "parent_unit="+parent_unit, 
			success: function(msg){	
				$( "#kode_unit_kerja" ).val(msg);					
			}
		});
	});
});
		
function onEdit_unitkerja(id) {
	open_dialog(id, 'Edit unitkerja');
}
function onAdd_unitkerja(id) {
	open_dialog('', 'Tambah unitkerja');
}

function onDelete_unitkerja(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_unitkerja/do_delete_unitkerja/"+id,
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
			url: "<?php echo base_url(); ?>master_unitkerja/cek_unitkerja/"+id,
			//data: $('#form-unitkerja').serialize(), 
			success: function(data){	
				var dt = explode('|', data);
				$( "#nama_unit_kerja" ).val( dt[0] );
				$( "#kode_unit_kerja" ).val( dt[1] );
				$( "#level" ).val( dt[2] );
				$( "#parent_unit" ).val( dt[3] );
				$( "#prov_id" ).val( dt[4] );
			}
		});
	}else{
		$( "#nama_unit_kerja" ).val( "" );
		$( "#kode_unit_kerja" ).val( "" );
		$( "#level" ).val( "" );
		$( "#parent_unit" ).val( "" );
		$( "#prov_id" ).val( "" );
	}
	
	$( "#dialog-unitkerja" ).dialog({
		  autoOpen: false,
		  height: 350,
		  width: 500,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>master_unitkerja/do_popup_unitkerja/"+id,
					data: $('#form-unitkerja').serialize(), 
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
	
	$( "#dialog-unitkerja" ).dialog( "open" );
	
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
						 <li class="active"><a href="<?php echo base_url(); ?>master_unitkerja" title="">Master Unit Kerja</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header 
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Administrasi Unit Kerja</h5>
			    	</div>
			    </div>-->
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
        
				<button onclick="javascript:onAdd_unitkerja()"  class="btn btn-primary">Tambah</button>				
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Master Unit Kerja</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-unitkerja" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
									<th>Kode</th>
                                    <th>Nama Unit Kerja</th>
                                    <th>Parent Unit</th>                                    
                                    <th>Lokasi Kerja</th>                                    
                                    <th>Level</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
								$no = 1;
								
								foreach ($data_unitkerja as $row){
									$id = $row['id_unit_kerja'];
									$sub = '';
									if($row['level'] == '2'){
										$sub = '&nbsp; &nbsp; '; 
									}
									if($row['level'] == '3'){
										$sub = '&nbsp; &nbsp; &nbsp; &nbsp; '; 
									}
									if($row['level'] == '4'){
										$sub = ' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; '; 
									}
									if($row['level'] == '5'){
										$sub = '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; '; 
									}
									if($row['level'] == '6'){
										$sub = '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; '; 
									}
								?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $row['kode_unit_kerja']; ?></td>
										<td><?php echo $sub.$row['nama_unit_kerja']; ?></td>
										<td><?php echo get_name('m_unit_kerja','nama_unit_kerja','id_unit_kerja',$row['parent_unit']); ?></td>
										<td><?php echo $row['prov_name']; ?></td>
										<td><?php echo $row['level']; ?></td>
										<td>
											<span id="edit-rjabatan" onclick="javascript:onEdit_unitkerja(<?php echo $id;?>)" class="fam-application-edit"></span>
											<span id="delete-rjabatan" onclick="javascript:onDelete_unitkerja(<?php echo $id;?>)" class="fam-application-delete"></span>
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
<div id="dialog-unitkerja" title=""> 
	<form id="form-unitkerja" method="post" action="" >
		<input type="hidden" id="id" name="id" value="" />
		<table>
			<tr>
				<td>Parent</td>
				<td>:</td>
				<td align="left">					
					<select name="parent_unit" id="parent_unit" class="input-xlarge">
						<option value="">-Pilih-</option>
					<?php
						
						$curr_id ='';
						echo "<option value='0' ".$selected.">Root Level</option>";
						$this->db->where("parent_unit = '0'");
						//$this->db->where("id_unit_kerja != '".$curr_id."'");
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
				<td>Kode</td>
				<td>:</td>
				<td>
					<input id="kode_unit_kerja" type="text" name="kode_unit_kerja" readonly class="input-medium" />
				</td>
			</tr>
			<tr>
				<td>Nama Unit Kerja</td>
				<td>:</td>
				<td>
					<input id="nama_unit_kerja" type="text" name="nama_unit_kerja" class="input-xlarge is_required" />
				</td>
			</tr>
			<tr>
				<td>Lokasi_kerja</td>
				<td>:</td>
				<td>					
					<select name="prov_id" id="prov_id" class="input-xlarge">
						<option value="">-Pilih Lokasi-</option>
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
				<td>Level</td>
				<td>:</td>
				<td>
					<input id="level" type="text" name="level" class="input-small is_required" />
				</td>
			</tr>
		</table>	
	</form>
</div>


	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>