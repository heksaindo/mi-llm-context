<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
	<link rel="stylesheet" href="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.css" />

	<script type="text/javascript" src="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/tiny_mce/jquery.tinymce.js"></script>
	<script type="text/javascript">		
	$(function() {
		$('textarea.tinymce').tinymce({
		//$('textarea').not('.no-editor').tinymce({
			// Location of TinyMCE script
			script_url : '<?php echo base_url(); ?>js/tiny_mce/tiny_mce.js',

			// General options
			theme : "simple",
			//plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

			// Theme options
			theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
			//theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
			//theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
			content_css : "<?php echo base_url(); ?>css/bootstrap.css",


		});
	});
	</script>
	<script type="text/javascript"> 	

	$(document).ready(function(){
		
		var jabatan_ttd = $('#jabatan_ttd option:selected').val();
		$('#ttd').val(jabatan_ttd);
		//$("#nip_ttd").val('');		
		//$("#nama_ttd").val('');		
			
		$('#jabatan_ttd').change(function(){
			//$('#nama_ttd').val('');
			jabatan_ttd = $('#jabatan_ttd option:selected').val();
			$('#ttd').val(jabatan_ttd);
			
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>kenaikangajipegawai/get_tandatangan",
				data: 'jabatan_ttd='+jabatan_ttd, 
				success: function(msg){	
					if(msg){			
						var data = explode('|', msg);
						$("#nip_ttd").val(data[0]);		
						$("#nama_ttd").val(data[1]);		
					}else{
						$("#nip_ttd").val('');		
						$("#nama_ttd").val('');	
					}
					return false;
				}
			});
			
		});
		
	});
	</script>	

</head>
	
<body>
<div class="printablez">
	<?php 
	if (!empty($query)) {

		if ($query->num_rows() > 0) {
			$data_pegawai = $query->row_array();
		?>
				<form id="form-wizard-draft" class="form-horizontal row-fluid well" method="post" >
					<div id="form-wizard-2" class="step">
						
						<div class="control-group">
							<label class="control-label" style="width:200px">Nomor Surat</label>
							<div class="controls">
								<input id="no_surat" type="text" name="no_surat" class="input-xlarge" value="<?php echo $data_pegawai['no_surat'];?>" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label"  style="width:200px">Ditujukan Kepada</label>
							<div class="controls">
								<textarea id="kepada" name="kepada" class="input-xlarge" rows="2"><?php echo $data_pegawai['kepada'];?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" style="width:200px">Jabatan Penandatangan</label>
							<div class="controls">
								<input id="ttd" type="hidden" name="ttd" />
								<select id="jabatan_ttd" name="jabatan_ttd" class="input-xlarge">
									<option value=""></option>
									<?php
										foreach($data_jabatan_ttd as $row){
											$selected = '';	
											if($data_pegawai['jabatan_ttd'] == $row->id_jabatan){
												$selected =  'selected = "selected"'; 
											}
											echo "<option value='".$row->id_jabatan."' ".$selected.">".$row->nama_jabatan."</option>";
										}
									?>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" style="width:200px">Nama Penandatangan</label>
							<div class="controls">
								<input id="nama_ttd" type="text" name="nama_ttd" class="input-xlarge" value="<?php echo $data_pegawai['nama_ttd'];?>" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" style="width:200px">NIP Penandatangan</label>
							<div class="controls">
								<input id="nip_ttd" type="text" name="nip_ttd" class="input-xlarge" value="<?php echo $data_pegawai['nip_ttd'];?>" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" style="width:200px">Tembusan</label>
							<div class="controls">
								<textarea id="tembusan" name="tembusan" class="input-xlarge tinymce" rows="4"><?php echo $data_pegawai['tembusan'];?></textarea>
							</div>
						</div>
					</div>
				</form>
			
<?php
		}
	}else{
		echo 'Pilih Pegawai!';
	}
?>
</div>
</body>
</html>