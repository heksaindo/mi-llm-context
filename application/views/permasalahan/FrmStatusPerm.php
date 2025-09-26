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
						 <li class="active"><a href="<?php echo base_url(); ?>Cuti" title="">Penugasan & Kehadiran</a></li>
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
							<h6>Status Permasalahan</h6>
						</div>
					</div>
					<form id="form-wizard" class="form-horizontal row-fluid well" method="post" action="<?php echo base_url(); ?>permasalahan/SimpanStatus" >
						<div id="form-wizard-1" class="step">
							<div class="control-group">
								<label class="control-label">Status</label>
								<div class="controls">
									<label><input name="status" type="radio" id="RadioGroup1_0" value="1" checked="checked" />Selesai</label>
									<label><input type="radio" name="status" value="2" id="RadioGroup1_0" />Bermasalah</label>
									<input type="hidden" name="id" id="id" value="<?php echo $id?>" />
									<input type="hidden" name="tipe" id="tipe" value="<?php echo $tipe?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Permasalahan</label>
								<div class="controls">
									<textarea name="masalah" id="masalah" cols="45" rows="5"></textarea>
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