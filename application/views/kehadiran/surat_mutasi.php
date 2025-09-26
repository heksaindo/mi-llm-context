<?php
	if (isset($id)){
		$this->db->where('id', $id);
		$query = $this->db->get('surat_mutasi');
		foreach ($query->result() as $row)
		{
			$no_surat=$row->no_surat;
			$tanggal=$row->tanggal;
			$tembusan=$row->tembusan;
			$NipSekretaris=$row->sekretaris;
		}
		$query->free_result();
		
		$sql="SELECT A.id, A.nip, B.nama FROM pegawai_mutasi A LEFT JOIN pegawai B ON A.nip=B.nip_baru WHERE A.no_surat='$no_surat'";
		$query=$this->db->query($sql);
		$mutasi=$query->result();
		$query->free_result();
	}
	else 
	{	
		$mutasi='';
		$id='';
		$no_surat='';
		$tanggal='';
		$tembusan='';
		$NipSekretaris='';
	}
	//print_r ($mutasi);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>

</head>

<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.easytabs.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.autosize.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.inputmask.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.listbox.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.validation.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ckeditor/ckeditor.js"></script>


<script type="text/javascript">
$(document).ready(function(){
	$.configureBoxes();
	
	$('#tanggal').datepicker({
        inline: true,
		//option: "sildeDown",
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
	
	
	$("#sekretaris").select2({ maximumSelectionSize: 1 });
	//$("#validate").validationEngine({promptPosition : "topRight:-122,-5"});
});

$(function()
	CKEDITOR.replace( 'tembusan', {
	toolbar: [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Scayt' ] },
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
	{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
	{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
	{ name: 'styles', items: [ 'Styles', 'Format' ] },
	{ name: 'tools', items: [ 'Maximize' ] },
	{ name: 'others', items: [ '-' ] },
	{ name: 'about', items: [ 'About' ] }
	]
}));


function validasi()
{
	var NoSurat = $("#NoSurat").val();
	var tanggal = $("#tanggal").val();
	var tembusan = $("#tembusan").val();
	var sekretaris = $("#sekretaris").val();
	if (NoSurat=="" || NoSurat==null) { 
		alert("No Surat tidak boleh kosong");
		$("#NoSurat").focus();
		return false;
	}
	
	else if (tanggal=="" || tanggal==null) { 
		alert("Tanggal tidak boleh kosong");
		$("#tanggal").focus();
		return false;
	}
	else if (sekretaris=="" || sekretaris==null) { 
		alert("Sekretaris tidak boleh kosong");
		$("#sekretaris").focus();
		return false;
	}
	/*
	else if (tembusan=="" || tembusan==null) { 
		alert("Tembusan tidak boleh kosong");
		$("#tembusan").focus();
		return false;
	}*/
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
                            
				
				<form id="Frm" class="form-horizontal" method="post" action="<?php echo base_url(); ?>mutasi/SimpanSurat" onsubmit="return validasi();">
	                <fieldset>

						<div class="widget">
	                        <div class="navbar"><div class="navbar-inner"><h6><?php echo $title?></h6></div></div>
	                    	<div class="well row-fluid">
								<div class="control-group">
	                                <label class="control-label">No Surat: <span class="text-error">*</span></label>
	                                <div class="controls">
	                                    <input type="text" class="[required] span12" name="NoSurat" id="NoSurat" value="<?php echo $no_surat?>"/>
	                                </div>
	                            </div>
								
	                            <div class="control-group">
	                                <label class="control-label">Tanggal: <span class="text-error">*</span></label>
	                                <div class="controls">
	                                    <input type="text" class="inlinepicker datepicker-liquid" name="tanggal" id="tanggal" value="<?php echo $tanggal?>" />
										<input type="hidden" name="id" id="id" value="<?php echo $id?>" />
	                                </div>
	                            </div>
								
								<div class="control-group">
	                                <label class="control-label">Sekretaris: <span class="text-error">*</span></label>
	                                <div class="controls">
	                                    <select id="sekretaris" name="sekretaris" class="input-xlarge" data-placeholder="Pilih Sekretaris">
										<option value=""></option>
										<?php 
											foreach ($sekretaris as $row)
											{
												if ($NipSekretaris==$row->nip_baru)
												{
													echo "<option value=".$row->nip_baru." selected='selected'>".$row->nip_baru." - ".$row->nama."</option>";	
												} else {
													echo "<option value=".$row->nip_baru.">".$row->nip_baru." - ".$row->nama."</option>";	
												}
											}
										?>
									</select>
	                                </div>
	                            </div>
								
	                            <div class="control-group">
	                                <label class="control-label">Tembusan: <span class="text-error">*</span></label>
	                                <div class="controls">
	                                    <textarea rows="5" cols="5" name="tembusan" class="span12"><?php echo $tembusan?></textarea>
	                                </div>
	                            </div>
	                        </div>

	                    
							<div class="navbar"><div class="navbar-inner"><h6>Daftar Pegawai Mutasi</h6></div></div>
							
							<div class="well body clearfix">
							
								<!-- Left box -->
								<div class="left-box">
									<input type="text" id="box1Filter" class="box-filter" placeholder="Filter entries..." /><button type="button" id="box1Clear" class="filter">x</button>
									<select id="box1View" multiple="multiple" class="multiple">
										<?php 
											foreach ($daftar as $row)
											{
												echo "<option value=".$row->id." selected='selected'>".$row->nip." - ".$row->nama."</option>";	
											}
										?>
									</select>
									<span id="box1Counter" class="count-label"></span>
									<select id="box1Storage"></select>
								</div>
								<!-- /left-box -->
								
								<!-- Control buttons -->
								<div class="dual-control">
									<button id="to2" type="button" class="btn">&nbsp;&gt;&nbsp;</button>
									<button id="allTo2" type="button" class="btn">&nbsp;&gt;&gt;&nbsp;</button><br />
									<button id="to1" type="button" class="btn">&nbsp;&lt;&nbsp;</button>
									<button id="allTo1" type="button" class="btn">&nbsp;&lt;&lt;&nbsp;</button>
								</div>
								<!-- /control buttons -->
								
								<!-- Right box -->
								<div class="right-box">
									<input type="text" id="box2Filter" class="box-filter" placeholder="Filter entries..." /><button type="button" id="box2Clear" class="filter">x</button>
									<select id="box2View" name="daftar[]" multiple="multiple" class="multiple">
									<?php 
										foreach ($mutasi as $row)
										{
											echo "<option value=".$row->id.">".$row->nip." - ".$row->nama."</option>";	
										}
									?>
									</select>
									<span id="box2Counter" class="count-label"></span>
									<select id="box2Storage"></select>
								</div>
								<!-- /right box -->
								
							</div>
							
							<div class="form-actions align-right">
	                                <button type="submit" class="btn btn-info">Submit</button>
	                                <button type="reset" class="btn">Reset</button>
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
