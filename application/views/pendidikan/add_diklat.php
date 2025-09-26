<?php
	if (isset($id)){
		$this->db->where('id', $id);
		$query = $this->db->get('pegawai_diklat_jabatan');
		foreach ($query->result() as $row)
		{
			$PegawaiNip=$row->nip_baru;
			$nama=$row->nama;
			$unit_kerja=$row->unit_kerja;
			$jenis_pelatihan=$row->jenis_pelatihan;
			$nama_pelatihan=$row->nama_pelatihan;
			$tahun_sertifikat=$row->tahun_sertifikat;
			$jml_jam_kursus=$row->jml_jam_kursus;
			$lembaga_pelaksana=$row->lembaga_pelaksana;
		}
	}
	else 
	{	
		$PegawaiNip=$this->session->userdata('nip');
		$id='';
		$nama='';
		$unit_kerja='';
		$jenis_pelatihan='';
		$nama_pelatihan='';
		$tahun_sertifikat='';
		$jml_jam_kursus='';
		$lembaga_pelaksana='';
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
						<li class="active"><a href="<?php echo base_url(); ?>DiklatJabatan" title="">Diklat Pegawai Dan Ujian Dinas</a></li>
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
							<h6>Add Diklat / Ujian Dinas</h6>
						</div>
					</div>
					<form id="form-wizard" class="form-horizontal row-fluid well" method="post" action="<?php echo base_url(); ?>pendidikan/SimpanDiklat" >
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
									<input id="nama" type="text" name="nama" class="input-xlarge" value="<?php echo $nama;?>"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Unit Kerja</label>
								<div class="controls">
									<input id="UnitKerja" type="text" name="UnitKerja" class="input-xlarge" value="<?php echo $unit_kerja;?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Nama Pelatihan</label>
								<div class="controls">
									<select id="NamaPelatihan" name="NamaPelatihan">
                                    	<option value="">Pilih Pelatihan</option>
										<?php 
											foreach ($pelatihan as $row)
											{
												if ($nama_pelatihan==$row->nama_pelatihan)
												{
													echo "<option value=".$row->nama_pelatihan." selected='selected'>".$row->nama_pelatihan."</option>";	
												} else {
													echo "<option value=".$row->nama_pelatihan." >".$row->nama_pelatihan."</option>";	
												}
											}
										?>
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Jenis Pelatihan</label>
								<div class="controls">
									<select name="kategori" id="kategori">
                                    	<option value="">--Pilih--</option>
                                        <option value="Struktural" <?php if ($jenis_pelatihan=='Struktural') { ?> selected="selected" <?php } ?> >Struktural</option>
                                        <option value="Fungsional" <?php if ($jenis_pelatihan=='Fungsional') { ?> selected="selected" <?php } ?>>Fungsional</option>
                                    </select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Lembaga Pelaksana</label>
								<div class="controls">
									<input id="lembaga" type="text" name="lembaga" value="<?php echo $lembaga_pelaksana;?>" class="input-xlarge" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Tahun</label>
								<div class="controls">
									<input id="tahun" type="text" name="tahun" value="<?php echo $tahun_sertifikat;?>" class="input-xlarge" />
								</div>
							</div>
                            <div class="control-group">
								<label class="control-label">Jumlah Jam</label>
								<div class="controls">
									<input id="jam" type="text" name="jam" value="<?php echo $jml_jam_kursus;?>" class="input-xlarge" />
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