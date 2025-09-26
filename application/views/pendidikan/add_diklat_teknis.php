<?php
	if (isset($id)){
		$this->db->where('id', $id);
		$query = $this->db->get('cuti');
		foreach ($query->result() as $row)
		{
			$PegawaiNip=$row->nip;
			$nama=$row->nama;
			$tipe_cuti=$row->tipe_cuti;
			$tanggal_mulai=$row->tanggal_mulai;
			$tanggal_akhir=$row->tanggal_akhir;
			$alasan=$row->alasan;
			$alamat=$row->alamat_sementara;
		}
	}
	else 
	{	
		$PegawaiNip=$this->session->userdata('nip');
		$id='';
		$tipe_cuti='';
		$tanggal_mulai='';
		$tanggal_akhir='';
		$alasan='';
		$alamat='';
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>

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
	
	<?php
		$level=$this->session->userdata('login_state');
		if ($level =='user')
		{?>
			$("#nip").val(<?php echo $PegawaiNip?>);
			$('#nip').attr('disabled', true);
			$( "#nip" ).trigger( "change" );
		<?php }
		
		if (!empty($id) && $level !='user')
		{?>
			$("#nip").val(<?php echo $PegawaiNip?>);
			$( "#nip" ).trigger( "change" );
		<?php }
	?>
	
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
						<li class="active"><a href="<?php echo base_url(); ?>DiklatTeknis" title="">Diklat Non Teknis</a></li>
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
							<h6>Diklat Non Teknis</h6>
						</div>
					</div>
					<form id="form-wizard" class="form-horizontal row-fluid well" method="post" action="<?php echo base_url(); ?>pendidikan/SimpanDiklatTeknis" >
						<div id="form-wizard-1" class="step">
							<div class="control-group">
								<label class="control-label">Nip</label>
								<div class="controls">
									<select id="nip" name="nip">
										<option value="">Pilih NIP</option>
										<?php 
											foreach ($nip as $row)
											{
												echo "<option value=".$row->nip_baru.">".$row->nip_baru."</option>";	
											}
										?>
									</select>
							      <input type="hidden" name="id" id="id" value="<?php echo $id?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Nama Pegawai</label>
								<div class="controls">
									<input id="nama" type="text" name="nama" class="input-xlarge" readonly="readonly" />
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
												echo "<option value=".$row->nama_pelatihan.">".$row->nama_pelatihan."</option>";	
											}
										?>
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Kategori</label>
								<div class="controls">
									<input id="kategori" type="text" name="kategori" value="<?php echo $alamat;?>" class="input-xlarge" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Lembaga Pelaksana</label>
								<div class="controls">
									<input id="lembaga" type="text" name="lembaga" value="<?php echo $tanggal_akhir;?>" class="input-xlarge" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Negara</label>
								<div class="controls">
									<input id="negara" type="text" name="negara" value="<?php echo $alasan;?>" class="input-xlarge" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Jenis Pelatihan</label>
								<div class="controls">
									<input id="JenisPelatihan" type="text" name="JenisPelatihan" value="<?php echo $alamat;?>" class="input-xlarge" />
								</div>
							</div>
                            <div class="control-group">
								<label class="control-label">Tahun</label>
								<div class="controls">
									<input id="tahun" type="text" name="tahun" value="<?php echo $alamat;?>" class="input-xlarge" />
								</div>
							</div>
                            <div class="control-group">
								<label class="control-label">Jumlah Jam</label>
								<div class="controls">
									<input id="jam" type="text" name="jam" value="<?php echo $alamat;?>" class="input-xlarge" />
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