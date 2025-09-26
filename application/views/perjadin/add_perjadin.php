<?php
	if (isset($id)){
		$this->db->where('id', $id);
		$query = $this->db->get('perjadin');
		foreach ($query->result() as $row)
		{
			$nip=$row->nip;
			$nama=$row->nama;
			$tipe_perjadin=$row->tipe_perjadin;
			$tanggal_mulai=$row->tanggal_mulai;
			$tanggal_akhir=$row->tanggal_akhir;
			$tempat_tujuan=$row->tempat_tujuan;
			$tujuan_perjadin=$row->tujuan_perjadin;
			$UnitKerja=$row->unit_kerja;
		}
	}
	else 
	{	
		$PegawaiNip=$this->session->userdata('nip');
		$id='';
		$nip='';
		$nama='';
		$tipe_perjadin='';
		$tanggal_mulai='';
		$tanggal_akhir='';
		$tempat_tujuan='';
		$tujuan_perjadin='';
		$UnitKerja=set_value('UnitKerja');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>
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
});
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
		                <li><a href="<?php echo base_url(); ?>Home">Dashboard</a></li>
						<li ><a href="<?php echo base_url(); ?>penugasandankehadiran" title="">Penugasan & Kehadiran</a></li>
						<li class="active"><a href="<?php echo base_url(); ?>Perjadin" title="">Perjalanan Dinas</a></li>
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
                            
				
				 <div class="widget">
					 <div class="navbar">
						<div class="navbar-inner">
							<h6>Pengajuan Perjalanan Dinas</h6>
						</div>
					</div>
					<form id="form-wizard" class="form-horizontal row-fluid well" method="post" action="<?php echo base_url(); ?>perjadin/addperjadin" >
						<div id="form-wizard-1" class="step">
							<div class="control-group">
								<label class="control-label">Nip</label>
								<div class="controls">
									<input id="nip" type="text" name="nip" onkeyup="NumberOnly(this)" class="input-xlarge uppercase" value="<?php echo $nip;?>"/>
							      <input type="hidden" name="id" id="id" value="<?php echo $id?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Nama Pegawai</label>
								<div class="controls">
									<input id="nama" type="text" name="nama" class="input-xlarge" value="<?php echo $nama;?>"/>
								</div>
							</div>
							<div class="control-group <?php $error=form_error('UnitKerja'); if (!empty($error)) { ?> error <?php } ?>">
								<label class="control-label">Unit Kerja</label>
								<div class="controls">
									<input id="UnitKerja" type="text" name="UnitKerja" class="input-xlarge" value="<?php echo $UnitKerja;?>"/>
									<?php echo form_error('UnitKerja'); ?>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Jenis Perjalanan</label>
								<div class="controls">
									<select id="tipe_perjadin" name="tipe_perjadin">
										<option value="Dalam Negeri" <?php if ($tipe_perjadin=='Dalam Negeri') {?> selected="selected" <?php } ?>>Dalam Negeri</option>
										<option value="Luar Negeri" <?php if ($tipe_perjadin=='Luar Negeri') {?> selected="selected" <?php } ?>>Luar Negeri</option>
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Tanggal Berangkat</label>
								<div class="controls">
									<input id="tanggal_mulai" type="text" name="tanggal_mulai" value="<?php echo $tanggal_mulai;?>" class="input-xlarge" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Tanggal Pulang</label>
								<div class="controls">
									<input id="tanggal_akhir" type="text" name="tanggal_akhir" value="<?php echo $tanggal_akhir;?>" class="input-xlarge" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Tujuan</label>
								<div class="controls">
									<input id="tujuan" type="text" name="tujuan" value="<?php echo $tujuan_perjadin;?>" class="input-xlarge" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Alamat Tujuan</label>
								<div class="controls">
									<input id="alamat_tujuan" type="text" name="alamat_tujuan" value="<?php echo $tempat_tujuan;?>" class="input-xlarge" />
								</div>
							</div>
						</div>
						<div class="form-actions">
						<input id="next" class="btn btn-primary" type="submit" value="Submit" />
						<div id="status"></div>
						</div>
						<div id="submitted"></div>
					</form>
			</div>
				 

		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		
	</div>
	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>