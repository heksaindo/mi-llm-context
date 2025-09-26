<?php
	if (isset($id)){
		$this->db->where('id', $id);
		$query = $this->db->get('pegawai_riwayatpenghargaan');
		foreach ($query->result() as $row)
		{
			$id=$row->id;
			$nip_baru=$row->nip_baru;
			$nama=$row->nama;
			$tgl_sk=$row->tgl_sk;
			$instansi_pelaksana=$row->instansi_pelaksana;
			$tanda_jasa=$row->tanda_jasa;
			$no_sk=$row->no_sk;
			$unit_kerja=$row->unit_kerja;
			$id_penghargaan=$row->id_penghargaan;
		}
	}
	else 
	{	
		$id='';
		$nip_baru='';
		$nama='';
		$tgl_sk='';
		$instansi_pelaksana='';
		$tanda_jasa='';
		$no_sk='';
		$unit_kerja='';
		$id_penghargaan='';
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
	
	$('#tgl_sk').datepicker({
        inline: true,
		option: "sildeDown",
		changeMonth : true,
		changeYear : true,
    });
	
	$('#jam').datepicker({
        inline: true,
		option: "sildeDown",
		changeMonth : true,
		changeYear : true,
    });
	
	$("#nip_baru").autocomplete("<?php echo base_url(); ?>cuti/check_nip_baru/", {
			width: 250,
			minChars:1,
			max:100,
			selectFirst: false
		});
		
	$("#nip_baru").result(function(event, data, formatted) {
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
	
	$("#unit_kerja").autocomplete("<?php echo base_url(); ?>cuti/CekUnitKerja/", {
			width: 250,
			minChars:1,
			max:100,
			selectFirst: false
		});
	
	$("#unit_kerja").result(function(event, data, formatted) {
			if (data[0] != 'error'){  
				$("#unit_kerja").val(data[0]);										
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
						<li><a href="<?php echo base_url(); ?>administrasipegawai" title="">Administrasi Pegawai</a></li>
						<li><a href="<?php echo base_url(); ?>penghargaan" title="">Penghargaan</a></li>
						<li class="active"><a href="" title="">Add Penghargaan</a></li>
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
							<h6>Penghargaan Pegawai</h6>
						</div>
					</div>
					<form id="form-wizard" class="form-horizontal row-fluid well" method="post" action="<?php echo base_url(); ?>penghargaan/simpan" >
						<div id="form-wizard-1" class="step">
							<div class="control-group">
								<label class="control-label">NIP Baru</label>
								<div class="controls">
									<input id="nip_baru" type="text" name="nip_baru" onkeyup="NumberOnly(this)" class="input-xlarge uppercase" value="<?php echo $nip_baru;?>"/>
							      <input type="hidden" name="id" id="id" value="<?php echo $id?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Nama Pegawai</label>
								<div class="controls">
									<input id="nama" type="text" name="nama" class="input-xlarge" value="<?php echo $nama;?>"/>
								</div>
							</div>
							<div class="control-group <?php $error=form_error('unit_kerja'); if (!empty($error)) { ?> error <?php } ?>">
								<label class="control-label">Unit Kerja</label>
								<div class="controls">
									<input id="unit_kerja" type="text" name="unit_kerja" class="input-xlarge" value="<?php echo $unit_kerja;?>"/>
									<?php echo form_error('unit_kerja'); ?>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Nama Penghargaan</label>
								<div class="controls">
									<select id="id_penghargaan" name="id_penghargaan">
                                    	<option value="">Pilih Penghargaan</option>
										<?php 
											foreach ($penghargaan as $row)
											{
												if ($id_penghargaan==$row->id_penghargaan)
												{
													echo "<option value=".$row->id_penghargaan." selected='selected'>".$row->nama_penghargaan."</option>";	
												} else {
													echo "<option value=".$row->id_penghargaan.">".$row->nama_penghargaan."</option>";	
												}
											}
										?>
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Lembaga Pelaksana</label>
								<div class="controls">
									<input id="instansi_pelaksana" type="text" name="instansi_pelaksana" value="<?php echo $instansi_pelaksana;?>" class="input-xlarge" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Tanda Jasa</label>
								<div class="controls">
									<input id="tanda_jasa" type="text" name="tanda_jasa" value="<?php echo $tanda_jasa;?>" class="input-xlarge" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">No SK</label>
								<div class="controls">
									<input id="no_sk" type="text" name="no_sk" value="<?php echo $no_sk;?>" class="input-xlarge" />
								</div>
							</div>
                            <div class="control-group">
								<label class="control-label">Tanggal SK</label>
								<div class="controls">
									<input id="tgl_sk" type="text" name="tgl_sk" value="<?php echo $tgl_sk;?>" class="input-xlarge" />
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