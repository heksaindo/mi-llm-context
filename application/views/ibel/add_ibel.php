<?php
	if (isset($id)){
		$this->db->where('id', $id);
		$query = $this->db->get('ibel');
		foreach ($query->result() as $row)
		{
			$PegawaiNip=$row->nip;
			$nama=$row->nama;
			$jenis_ibel=$row->jenis_ibel;
			$tanggal_mulai=$row->tanggal_mulai;
			$tanggal_akhir=$row->tanggal_akhir;
			$keterangan=$row->keterangan;
			$alamat=$row->alamat;
			$jenis_ibel=$row->jenis_ibel;
		}
	}
	else 
	{	
		$PegawaiNip=$this->session->userdata('nip');
		$id='';
		$jenis_ibel='';
		$tanggal_mulai='';
		$tanggal_akhir='';
		$keterangan='';
		$alamat='';
		$jenis_ibel='';
		$nama='';
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.js"></script>
</head>

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
						<li><a href="<?php echo base_url(); ?>pendidikan" title="">Pendidikan</a></li>
						 <li class="active"><a href="<?php echo base_url(); ?>ibel" title="">Izin Belajar</a></li>
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
							<h6>Input Izin Belajar</h6>
						</div>
					</div>
					<form id="form-wizard" class="form-horizontal row-fluid well" method="post" action="<?php echo base_url(); ?>ibel/simpan" >
						<div id="form-wizard-1" class="step">
							<div class="control-group">
								<label class="control-label">Nip</label>
								<div class="controls">
									<input id="nip" type="text" name="nip" onkeyup="NumberOnly(this)" class="input-xlarge uppercase" value="<?php echo $PegawaiNip;?>"/>
							      <input type="hidden" name="id" id="id" value="<?php echo $id?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Nama Pegawai</label>
								<div class="controls">
									<input id="nama" type="text" name="nama" class="input-xlarge" value="<?php echo $nama?>"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">tanggal mulai</label>
								<div class="controls">
									<input id="tanggal_mulai" type="text" name="tanggal_mulai" value="<?php echo $tanggal_mulai;?>" class="input-xlarge" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">tanggal akhir</label>
								<div class="controls">
									<input id="tanggal_akhir" type="text" name="tanggal_akhir" value="<?php echo $tanggal_akhir;?>" class="input-xlarge" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Jenis ibel</label>
								<div class="controls">
									<input id="jenis_ibel" type="text" name="jenis_ibel" value="<?php echo $jenis_ibel;?>" class="input-xlarge" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">alamat Belajar</label>
								<div class="controls">
									<input id="alamat_cuti" type="text" name="alamat_cuti" value="<?php echo $alamat;?>" class="input-xlarge" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Keterangan</label>
								<div class="controls">
									<input id="keterangan" type="text" name="keterangan" value="<?php echo $keterangan;?>" class="input-xlarge" />
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