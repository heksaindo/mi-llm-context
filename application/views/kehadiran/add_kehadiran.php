<?php
	if (isset($id)){
		$this->db->where('id', $id);
		$query = $this->db->get('kehadiran');
		foreach ($query->result() as $row)
		{
			$tanggal=$row->tanggal;
			$dirjen=$row->dirgen;
			$sekdir=$row->sekdir;
			$unit=$row->unit;
			$subunit=$row->sub_unit;
			$DatangTepat=$row->datang_tepat;
			$DatangTelat=$row->datang_telat;
			$PulangTepat=$row->pulang_tepat;
			$PulangTelat=$row->pulang_telat;
			$PulangTelatDinas=$row->pulang_telat_dinas;
			$TidakAbsen=$row->tidak_absen;
		}
		$query->free_result();
	}
	else 
	{	
		$tanggal=set_value('tanggal');
		$id=set_value('id');
		$dirjen=set_value('dirgen');
		$sekdir=set_value('sekdir');
		$unit=set_value('unit');
		$subunit=set_value('subunit');
		$DatangTepat=set_value('DatangTepat');
		$DatangTelat=set_value('DatangTelat');
		$PulangTepat=set_value('PulangTepat');
		$PulangTelat=set_value('PulangTelat');
		$PulangTelatDinas=set_value('PulangTelatDinas');
		$TidakAbsen=set_value('TidakAbsen');
	}
	//print $dirjen;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>

</head>

<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.autosize.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.inputmask.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.listbox.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$('#tanggal').datepicker({
        inline: true,
		option: "sildeDown",
		changeMonth : true,
		changeYear : true,
    });
	
	$('#tanggal_akhir').datepicker({
        inline: true,
		option: "sildeDown",
		changeMonth : true,
		changeYear : true,
    });
	

	
	//$("#validate").validationEngine({promptPosition : "topRight:-122,-5"});
	
	$('#dirgen').change(function(){
		$.post("<?php echo base_url();?>kehadiran/get_sekdir/"+$('#dirgen').val(),{},function(obj){
			$('#sekdir').html(obj);
		});
	});
	
	$('#sekdir').change(function(){
		$.post("<?php echo base_url();?>kehadiran/get_unit/"+$('#sekdir').val(),{},function(obj){
			$('#unit').html(obj);
		});
	});
	
	$('#unit').change(function(){
		$.post("<?php echo base_url();?>kehadiran/get_subunit/"+$('#unit').val(),{},function(obj){
			$('#subunit').html(obj);
		});
	});
	
	$("#dirgen").select2({ maximumSelectionSize: 1 });
	//$("#sekdir").select2({ maximumSelectionSize: 1 });
	//$("#unit").select2({ maximumSelectionSize: 1 });
	//$("#subunit").select2({ maximumSelectionSize: 1 });
	$("#dirgen").select2();
	$("#sekdir").select2();
	$("#unit").select2();
	$("#subunit").select2();
});

function validasi()
{
	/*
	var nip = $("#nip").val();
	var UnitKerja = $("#UnitKerja").val();
	var TujuanPindah = $("#TujuanPindah").val();
	var UnitAsal = $("#UnitAsal").val();
	var UnitTujuan = $("#UnitTujuan").val();
	if (nip=="" || nip==null) { 
		alert("NIP/Nama Pegawai tidak boleh kosong");
		$("#nip").focus();
		return false;
	}
	
	else if (UnitKerja=="" || UnitKerja==null) { 
		alert("Unit Kerja tidak boleh kosong");
		$("#UnitKerja").focus();
		return false;
	}
	else if (TujuanPindah=="" || TujuanPindah==null) { 
		alert("Tujuan Pindah tidak boleh kosong");
		$("#TujuanPindah").focus();
		return false;
	}
	else if (UnitAsal=="" || UnitAsal==null) { 
		alert("Unit Asal tidak boleh kosong");
		$("#UnitAsal").focus();
		return false;
	}
	else if (UnitTujuan=="" || UnitTujuan==null) { 
		alert("Unit Tujuan tidak boleh kosong");
		$("#UnitTujuan").focus();
		return false;
	}
	else {
		return true;
	}
	*/
}
</script>

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
		                <li><a href="<?php echo base_url(); ?>Home">Dashboard</a></li>
						<li ><a href="<?php echo base_url(); ?>penugasandankehadiran" title="">Penugasan & Kehadiran</a></li>
						<li class="active"><a href="<?php echo base_url(); ?>kehadiran" title="">Kehadiran</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
			    	</div>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                            
				
				<form id="Frm" class="form-horizontal" method="post" action="<?php echo base_url(); ?>kehadiran/simpan" onsubmit="return validasi();">
	                <fieldset>

	                    <!-- Form validation -->
	                    <div class="widget">
	                        <div class="navbar"><div class="navbar-inner"><h6><?php echo $title?></h6></div></div>
	                    	<div class="well row-fluid">
								<div class="control-group <?php $error=form_error('tanggal'); if (!empty($error)) { ?> error <?php } ?>">
	                                <label class="control-label">Tanggal: <span class="text-error">*</span></label>
	                                <div class="controls">
	                                   <input type="text" class="validate[required]" name="tanggal" id="tanggal" value="<?php echo $tanggal?>" />
									   <?php echo form_error('tanggal'); ?>
	                                </div>
	                            </div>
								
	                            <div class="control-group <?php $error=form_error('dirgen'); if (!empty($error)) { ?> error <?php } ?>">
	                                <label class="control-label">Direktorat Jenderal: <span class="text-error">*</span></label>
	                                <div class="controls">
	                                    <select id="dirgen" name="dirgen" class="input-xlarge" data-placeholder="--Pilih--">
										<option value=""></option>
										<?php 
											foreach ($dirgen as $row)
											{
												if ($dirjen==$row->id_unit_kerja)
												{
													echo "<option value=".$row->id_unit_kerja." selected='selected'>".$row->kode." - ".$row->nama."</option>";	
												} else {
													echo "<option value=".$row->id_unit_kerja.">".$row->kode." - ".$row->nama."</option>";	
												}
											}
										?>
									</select>
									<?php echo form_error('dirgen'); ?>
	                                </div>
	                            </div>
								
								<div class="control-group <?php $error=form_error('sekdir'); if (!empty($error)) { ?> error <?php } ?>">
	                                <label class="control-label">Direktorat/Sekretariat: <span class="text-error">*</span></label>
	                                <div class="controls">
	                                    <select id="sekdir" name="sekdir" class="input-xlarge" data-placeholder="--Pilih--">
										<option value=""></option>
										<?php
											$this->db->order_by("kode_unit_kerja", "ASC");
											$this->db->where("parent_unit", $dirjen);
											$this->db->where("level", '2');
											$query = $this->db->get("m_unit_kerja");
											foreach($query->result() as $row) {   
												if ($sekdir==$row->id_unit_kerja)
												{
													echo "<option value='".$row->id_unit_kerja."' selected='selected'>".$row->kode_unit_kerja." - ".$row->nama_unit_kerja."</option>";
												} else {
													echo "<option value='".$row->id_unit_kerja."'>".$row->kode_unit_kerja." - ".$row->nama_unit_kerja."</option>";
												}
											}
											$query->free_result();
										?>
										</select>
										<?php echo form_error('sekdir'); ?>
	                                </div>
	                            </div>
								
	                            <div class="control-group <?php $error=form_error('unit'); if (!empty($error)) { ?> error <?php } ?>">
	                                <label class="control-label">Unit Kerja: <span class="text-error">*</span></label>
	                                <div class="controls">
	                                   <select id="unit" name="unit" class="input-xlarge" data-placeholder="--Pilih--">
										<option value=""></option>
										<?php
											$this->db->order_by("kode_unit_kerja", "ASC");
											$this->db->where("parent_unit", $sekdir);
											$this->db->where("level", '3');
											$query = $this->db->get("m_unit_kerja");
											foreach($query->result() as $row) {   
												if ($unit==$row->id_unit_kerja)
												{
													echo "<option value='".$row->id_unit_kerja."' selected='selected'>".$row->kode_unit_kerja." - ".$row->nama_unit_kerja."</option>";
												} else {
													echo "<option value='".$row->id_unit_kerja."'>".$row->kode_unit_kerja." - ".$row->nama_unit_kerja."</option>";
												}
											}
											$query->free_result();
										?>
										</select>
										<input type="hidden" name="id" id="id" value="<?php echo $id?>" />
										<?php echo form_error('unit'); ?>
	                                </div>
	                            </div>
								
								<div class="control-group <?php $error=form_error('subunit'); if (!empty($error)) { ?> error <?php } ?>">
	                                <label class="control-label">Sub Unit Kerja: <span class="text-error">*</span></label>
	                                <div class="controls">
	                                   <select id="subunit" name="subunit" class="input-xlarge" data-placeholder="--Pilih--">
										<option value=""></option>
										</select>
										<?php echo form_error('subunit'); ?>
	                                </div>
	                            </div>
								
	                            <div class="control-group <?php $error=form_error('DatangTepat'); if (!empty($error)) { ?> error <?php } ?>">
	                                <label class="control-label">Datang Tepat: <span class="text-error">*</span></label>
	                                <div class="controls">
	                                    <input type="text" class="validate[required]" name="DatangTepat" id="DatangTepat" value="<?php echo $DatangTepat?>"/>
										<?php echo form_error('DatangTepat'); ?>
	                                </div>
	                            </div>
	                        
	                            <div class="control-group <?php $error=form_error('DatangTelat'); if (!empty($error)) { ?> error <?php } ?>">
	                                <label class="control-label">Datang Telat: <span class="text-error">*</span></label>
	                                <div class="controls">
	                                    <input type="text" class="validate[required]" name="DatangTelat" id="DatangTelat" value="<?php echo $DatangTelat?>"/>
										<?php echo form_error('DatangTelat'); ?>
	                                </div>
	                            </div>
	                            <div class="control-group <?php $error=form_error('PulangTepat'); if (!empty($error)) { ?> error <?php } ?>">
	                                <label class="control-label">Pulang Tepat: <span class="text-error">*</span></label>
	                                <div class="controls">
	                                    <input type="text" class="validate[required]" name="PulangTepat" id="PulangTepat" value="<?php echo $PulangTepat?>"/>
										<?php echo form_error('PulangTepat'); ?>
	                                </div>
	                            </div>
								<div class="control-group <?php $error=form_error('PulangTelat'); if (!empty($error)) { ?> error <?php } ?>">
	                                <label class="control-label">Pulang Telat: <span class="text-error">*</span></label>
	                                <div class="controls">
	                                    <input type="text" class="validate[required]" name="PulangTelat" id="PulangTelat" value="<?php echo $PulangTelat?>"/>
										<?php echo form_error('PulangTelat'); ?>
									</div>
	                            </div>
								<div class="control-group <?php $error=form_error('PulangTelatDinas'); if (!empty($error)) { ?> error <?php } ?>">
	                                <label class="control-label">Pulang Telat Dinas: <span class="text-error">*</span></label>
	                                <div class="controls">
	                                    <input type="text" class="validate[required]" name="PulangTelatDinas" id="PulangTelatDinas" value="<?php echo $PulangTelatDinas?>"/>
										<?php echo form_error('PulangTelatDinas'); ?>
	                                </div>
	                            </div>
								<div class="control-group <?php $error=form_error('TidakAbsen'); if (!empty($error)) { ?> error <?php } ?>">
	                                <label class="control-label">Tidak Absen: <span class="text-error">*</span></label>
	                                <div class="controls">
	                                    <input type="text" class="validate[required]" name="TidakAbsen" id="TidakAbsen" value="<?php echo $TidakAbsen?>"/>
										<?php echo form_error('TidakAbsen'); ?>
									</div>
	                            </div>
								<div class="form-actions align-right">
	                                <button type="submit" class="btn btn-info">Submit</button>
	                                <button type="reset" class="btn">Reset</button>
	                            </div>

	                        </div>

	                    </div>
	                    <!-- /form validation -->

	                </fieldset>
				</form>
				 

		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		
	</div>
	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>