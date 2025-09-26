<?php
	if (isset($id)){
		$this->db->where('id', $id);
		$query = $this->db->get('pegawai_mutasi');
		foreach ($query->result() as $row)
		{
			$nama=$row->nama;
			$nip=$row->nip;
			$unit_kerja=$row->unit_kerja;
			$tujuan_pindah=$row->tujuan_pindah;
			$unit_asal=$row->unit_asal;
			$unit_tujuan=$row->unit_tujuan;
			$keterangan=$row->keterangan;
			$no_surat=$row->no_surat;
		}
	}
	else 
	{	
		$PegawaiNip='';
		$id='';
		$unit_kerja='';
		$tujuan_pindah='';
		$unit_asal='';
		$unit_tujuan='';
		$keterangan='';
		$no_surat='';
		$nip='';
		$nama='';
	}
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
<link rel="stylesheet" href="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#tanggal_mulai').datepicker({
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
	
	$("#nip").autocomplete("<?php echo base_url(); ?>cuti/check_nip_baru/", {
			width: 250,
			minChars:1,
			max:100,
			selectFirst: false
		});
	
	$("#nip").result(function(event, data, formatted) {
			if (data[0] != 'error'){  
				$("#nip_baru").val(data[1]);					
				$("#nama").val(data[2]);					
				$("#gelar_depan").val(data[3]);					
				$("#gelar_belakang").val(data[4]);					
				$("#no_kartu").val(data[5]);					
				$("#jenis_kelamin").val(data[6]);				
				$("#tempat_lahir").val(data[7]);					
				$("#tanggal_lahir").val(data[8]);					
				$("#hd_id").val(data[9]);					
				//alert(data[6]);
			}
		});
	
	$("#UnitKerja").autocomplete("<?php echo base_url(); ?>cuti/CekUnitKerja/", {
			width: 250,
			minChars:1,
			max:100,
			selectFirst: false
		});
	
	$("#UnitKerja").result(function(event, data, formatted) {
			if (data[0] != 'error'){  
				$("#UnitKerja").val(data[0]);										
				//alert(data[6]);
			}
		});
		
	/*
	$("#nip").change(function(){
		var nip = $("#nip").val();
		$.ajax({
		   type : "POST",
		   url  : "<?php echo base_url(); ?>permasalahan/GetNama",
		   data : "nip=" + nip,
		   success: function(data){
		   		//var explode = data.split('#');
				//var AtasNama = explode[0];
				//var NoRek = explode[1];
				var nama=data;
		   		$("#nama").val(nama);
			    //$("#NoRek").val(NoRek);
		   }
		});
	});
	*/
	//$("#validate").validationEngine({promptPosition : "topRight:-122,-5"});
});

function validasi()
{
	// Validate URL
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
						 <li><a href="<?php echo base_url(); ?>administrasipegawai" title="">Administrasi Pegawai</a></li>
						<li class="active"><a href="<?php echo base_url(); ?>mutasi" title="">Mutasi Pegawai</a></li>
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
                            
				
				<form id="Frm" class="form-horizontal" method="post" action="<?php echo base_url(); ?>mutasi/simpan" onsubmit="return validasi();">
	                <fieldset>

	                    <!-- Form validation -->
	                    <div class="widget">
	                        <div class="navbar"><div class="navbar-inner"><h6><?php echo $title?></h6></div></div>
	                    	<div class="well row-fluid">

	                            <div class="control-group">
	                                <label class="control-label">NIP: <span class="text-error">*</span></label>
	                                <div class="controls">
	                                   <input type="text" class="validate[required] span12" name="nip" id="nip" value="<?php echo $nip?>" />
									</select>
	                                </div>
	                            </div>
								
								<div class="control-group" style="display=none">
	                                <label class="control-label">Nama: <span class="text-error">*</span></label>
	                                <div class="controls">
	                                    <input type="text" class="validate[required] span12" name="nama" id="nama" value="<?php echo $nama?>"/>
	                                </div>
	                            </div>
								
	                            <div class="control-group">
	                                <label class="control-label">Unit Kerja: <span class="text-error">*</span></label>
	                                <div class="controls">
	                                    <input type="text" class="validate[required] span12" name="UnitKerja" id="UnitKerja" value="<?php echo $unit_kerja?>" />
										<input type="hidden" name="id" id="id" value="<?php echo $id?>" />
	                                </div>
	                            </div>
	                        
	                            <div class="control-group">
	                                <label class="control-label">Tujuan Pindah: <span class="text-error">*</span></label>
	                                <div class="controls">
	                                    <input type="text" class="validate[required] span12" name="TujuanPindah" id="TujuanPindah" value="<?php echo $tujuan_pindah?>"/>
	                                </div>
	                            </div>
	                        
	                            <div class="control-group">
	                                <label class="control-label">Perst Unit Kerja Asal: <span class="text-error">*</span></label>
	                                <div class="controls">
	                                    
										<input type="text" class="validate[required] span12" name="UnitAsal" id="UnitAsal" value="<?php echo $unit_asal?>"/>
	                                </div>
	                            </div>
	                            <div class="control-group">
	                                <label class="control-label">Perst Unit Kerja Penerima: <span class="text-error">*</span></label>
	                                <div class="controls">
									<input type="text" class="validate[required] span12" name="UnitTujuan" id="UnitTujuan" value="<?php echo $unit_tujuan?>"/>
	                                   
									</div>
	                            </div>
								<div class="control-group">
	                                <label class="control-label">Keterangan: <span class="text-error">*</span></label>
	                                <div class="controls">
	                                    <textarea rows="5" cols="5" name="keterangan" class="span12"><?php echo $keterangan?></textarea>
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
