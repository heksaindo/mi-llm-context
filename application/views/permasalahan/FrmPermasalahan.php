<?php
	if (isset($id)){
		$this->db->where('id', $id);
		$query = $this->db->get('permasalahan');
		foreach ($query->result() as $row)
		{
			$nip=$row->nip;
			$nama=$row->nama;
			$unit_kerja=$row->unit_kerja;
			$kategori_id=$row->kategori_id;
			$sub_kategori_id=$row->sub_kategori_id;
			$keterangan=$row->keterangan;
			$tanggal=$row->tanggal;
		}
	}
	else 
	{	
		$PegawaiNip=$this->session->userdata('nip');
		$id='';
		$tanggal='';
		$nip='';
		$nama='';
		$unit_kerja='';
		$kategori_id='';
		$sub_kategori_id=0;;
		$keterangan='';
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
	$('#kategori').change(function(){
		//var sub =<?=$sub_kategori_id;?>;
		$.post("<?php echo base_url();?>permasalahan/GetSubKategori/"+$('#kategori').val()+"/"+ <?=$sub_kategori_id?>,function(obj){
			$('#sub_kategori').html(obj);
		});
	});
	
	$('#tanggal').datepicker({
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
						<li><a href="<?php echo base_url(); ?>administrasipegawai" title="">Administrasi Pegawai</a></li>
						<li class="active"><a href="<?php echo base_url(); ?>permasalahan" title="">Permasalahan Pegawai</a></li>
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
							<h6>Input Permasalahan</h6>
						</div>
					</div>
					<form id="form-wizard" class="form-horizontal row-fluid well" method="post" action="<?php echo site_url(); ?>permasalahan/simpan" >
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
									<input id="nama" type="text" name="nama" class="input-xlarge" value="<?php echo $nama?>"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Unit Kerja</label>
								<div class="controls">
									<input id="UnitKerja" type="text" name="UnitKerja" class="input-xlarge" value="<?php echo $unit_kerja?>"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Kategori</label>
								<div class="controls">
									<select name="kategori" id="kategori">
									  <option value="">--Pilih--</option>
									  <?php 
											foreach ($kategori as $row)
											{
												if ($kategori_id==$row->id)
												{
													echo "<option value=".$row->id." selected='selected'>".$row->kategori."</option>";	
												} else {
													echo "<option value=".$row->id.">".$row->kategori."</option>";	
												}
												
											}
										?>
									  </select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Sub Kategori</label>
								<div class="controls">
									<select name="sub_kategori" id="sub_kategori">
									  <option value="">--Pilih--</option>
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Tanggal</label>
								<div class="controls">
									<input id="tanggal" type="text" name="tanggal" value="<?php echo $tanggal;?>" class="input-xlarge" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Keterangan</label>
								<div class="controls">
									<textarea name="keterangan" cols="50" id="keterangan"><?=$keterangan?></textarea>
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