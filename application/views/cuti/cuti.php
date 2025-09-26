<!DOCTYPE html>
<html>
<!-- Head -->
<head>
<?php $this->load->view('layout/_head2'); ?>

<script type="text/javascript">
$.fn.dataTableExt.oApi.fnReloadAjax = function ( oSettings, sNewSource, fnCallback ){
	
    if ( typeof sNewSource != 'undefined' ){
        oSettings.sAjaxSource = sNewSource;
    }
    this.oApi._fnProcessingDisplay( oSettings, true );
    var that = this;
     
    oSettings.fnServerData( oSettings.sAjaxSource, null, function(json) {
        /* Clear the old information from the table */
        that.oApi._fnClearTable( oSettings );
         
        /* Got the data - add it to the table */
        for ( var i=0 ; i<json.aaData.length ; i++ ){
            that.oApi._fnAddData( oSettings, json.aaData[i] );
        }
         
        oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
        that.fnDraw( that );
        that.oApi._fnProcessingDisplay( oSettings, false );
         
        /* Callback user function - for event handlers etc */
        if ( typeof fnCallback == 'function' ){
            fnCallback( oSettings );
        }
    });
};

var oTable_cuti;
$(document).ready(function(){
	$( "#dialog-cuti" ).hide();
	$( "#dialog-selesai").hide();
	oTable_cuti = $('table#table-cuti').dataTable( {
		"sPaginationType": "full_numbers",
		"sDom": '<"datatable-header"fl>t<"datatable-footer"ip>',
		"oLanguage": {
			"sSearch": "<span>Filter records:</span> _INPUT_",
			"sLengthMenu": "<span>Show entries:</span> _MENU_",
			"oPaginate": { "sFirst": "First", "sLast": "Last", "sNext": ">", "sPrevious": "<" }
		},
		/*"aoColumnDefs":[
			{
			"aTargets": [13],
			"bVisible": false
			}
		],*/
		"iDisplayLength": 10,
		"sAjaxSource": "<?php echo base_url(); ?>cuti/ajax_cuti",
		"fnServerData": function ( sSource, aoData, fnCallback ) {
			$.ajax( {
				"dataType": 'json', 
				"type": "POST", 
				"url": sSource, 
				"data": aoData, 
				"success": fnCallback
			} );
		},
		"fnDrawCallback": function () {
		  $( '.tip' ).tooltip( {
			"delay": 0,
			"track": true,
			"fade": 250
		  } );
		}
	});
	
	$('#jabatan_ttd').change(function(){
			jabatan_ttd = $('#jabatan_ttd option:selected').val();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>kenaikangajipegawai/get_tandatangan",
				data: 'jabatan_ttd='+jabatan_ttd, 
				success: function(msg){	
					if(msg){			
						var data = explode('|', msg);
						$("#nip_ttd").val(data[0]).change();		
						$("#nama_ttd").val(data[1]).change();
						$("#ttd").val(data[2]).change();
					}else{
						$("#nip_ttd").val('').change();
						$("#nama_ttd").val('').change();
						$("#ttd").val('').change();
					}
					return false;
				}
			});
			
	});

	$( "[name='nama_ttd']" ).bind('change paste keyup focusout',function(){
		if($(this).val() ===''){
			$("[name='nama_ttd']" ).addClass("invalid");
		}else{
			$( "[name='nama_ttd']" ).removeClass("invalid");
		}
	});
	$( "[name='nip_ttd']" ).bind('change paste keyup focusout',function(){
		if($(this).val() ===''){
			$("[name='nip_ttd']" ).addClass("invalid");
		}else{
			$( "[name='nip_ttd']" ).removeClass("invalid");
		}
	});
	$( "[name='no_surat']" ).bind('change paste keyup focusout',function(){
		if($(this).val() ===''){
			$("[name='no_surat']" ).addClass("invalid");
		}else{
			$( "[name='no_surat']" ).removeClass("invalid");
		}
	});
	$( "[name='tgl_surat']" ).bind('change paste keyup focusout',function(){
		if($(this).val() ===''){
			$("[name='tgl_surat']" ).addClass("invalid");
		}else{
			$( "[name='tgl_surat']" ).removeClass("invalid");
		}
	});
	$( "[name='tempat_surat']" ).bind('change paste keyup focusout',function(){
		if($(this).val() ===''){
			$("[name='tempat_surat']" ).addClass("invalid");
		}else{
			$( "[name='tempat_surat']" ).removeClass("invalid");
		}
	});
	$( "[name='kepada']" ).bind('change paste keyup focusout',function(){
		if($(this).val() ===''){
			$("[name='kepada']" ).addClass("invalid");
		}else{
			$( "[name='kepada']" ).removeClass("invalid");
		}
	});
	$( "[name='kepada_di']" ).on('change paste keyup focusout',function(){
		if($(this).val() ===''){
			$("[name='kepada_di']" ).addClass("invalid");
		}else{
			$( "[name='kepada_di']" ).removeClass("invalid");
		}
	});
	window.removeTinyMCE = function() {
		tinyMCE.execCommand('mceFocus', false, 'tembusan');
		tinyMCE.execCommand('mceRemoveControl', false, 'tembusan');
	};
	
	window.addTinyMCE = function(){
		$('#tembusan').tinymce({
			script_url : '<?php echo base_url(); ?>js/tiny_mce/tiny_mce.js',
			theme : "simple",
			// Theme options
			theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,
			content_css : "<?php echo base_url(); ?>css/bootstrap.css"
		});
	};
	window.close_sk_selesai = function(){
		removeTinyMCE();
		$( "#dialog-selesai" ).dialog('destroy');
	};
	window.dialog_sk_selesai = function(newstatus,peg_id,id,pegawai,tipe,jcuti){
		$("#id").val(id);
		var title ='';
		if(tipe=='1'){
			title = 'SK Selesai:'+pegawai;
		}else{
			title = 'Kirim Pengantar Ke Ropeg: '+pegawai;
		}
		
		$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>cuti/get_skselesai",
				data: {id:id}, 
				success: function(msg){	
					if(msg){			
						var data = explode('|', msg);
						$("#no_surat").val(data[0]).change();
						$("#tempat_surat").val(data[1]).change();
						$("#tgl_surat").val(data[2]).change();
						$("#kepada").val(data[3]).change();
						$("#kepada_di").val(data[4]).change();
						$("#ttd").val(data[8]).change();
						$("#jabatan_ttd").val(data[7]).change();
						$("#nip_ttd").val(data[5]).change();		
						$("#nama_ttd").val(data[6]).change();
						$("#tembusan").val(data[9]).change();
					}else{
						$("#no_surat").val('');
						$("#tempat_surat").val('');
						$("#tgl_surat").val('');
						$("#kepada").val('');
						$("#kepada_di").val('');
						$("#ttd").val('');
						$("#jabatan_ttd").val('');
						$("#nip_ttd").val('');		
						$("#nama_ttd").val('');
						$("#tembusan").val('');
					}
					return false;
				}
		});
		
		$( "#dialog-selesai" ).dialog({
			autoOpen: true,
			height: 450,
			width: 650,
			modal: true,
			resizable: false,
			open: addTinyMCE,
			close: function() {
				removeTinyMCE();
				$(this).dialog('destroy');
			},
			title: title,
			buttons: {
				"Simpan": function() {
					isValid = true;
					var nosurat = $( "[name='no_surat']" ).val();
					var tempatsurat = $( "[name='tempat_surat']" ).val();
					var tglsurat = $( "[name='tgl_surat']" ).val();
					var kepada = $( "[name='kepada']" ).val();
					var kepadadi = $( "[name='kepada_di']" ).val();
					var jbt_ttd = $( "[name='jabatan_ttd']" ).val();
					var nama_ttd = $( "[name='nama_ttd']" ).val();
					var nip_ttd = $( "[name='nip_ttd']" ).val();
					if(jbt_ttd ===''){
						isValid = false;
						$( "[name='jabatan_ttd']" ).addClass("invalid");
					}else{
						$( "[name='jabatan_ttd']" ).removeClass("invalid");
					}
					if(nama_ttd ===''){
						isValid = false;
						$( "[name='nama_ttd']" ).addClass("invalid");
					}else{
						$( "[name='nama_ttd']" ).removeClass("invalid");
					}
					if(nip_ttd ===''){
						isValid = false;
						$( "[name='nip_ttd']" ).addClass("invalid");
					}else{
						$( "[name='nip_ttd']" ).removeClass("invalid");
					}
					if(nosurat ===''){
						isValid = false;
						$( "[name='no_surat']" ).addClass("invalid");
					}else{
						$( "[name='no_surat']" ).removeClass("invalid");
					}
					if(tempatsurat ===''){
						isValid = false;
						$( "[name='tempat_surat']" ).addClass("invalid");
					}else{
						$( "[name='tempat_surat']" ).removeClass("invalid");
					}
					if(tglsurat ===''){
						isValid = false;
						$( "[name='tgl_surat']" ).addClass("invalid");
					}else{
						$( "[name='tgl_surat']" ).removeClass("invalid");
					}
					if(kepada ===''){
						isValid = false;
						$( "[name='kepada']" ).addClass("invalid");
					}else{
						$( "[name='kepada']" ).removeClass("invalid");
					}
					if(kepadadi ===''){
						isValid = false;
						$( "[name='kepada_di']" ).addClass("invalid");
					}else{
						$( "[name='kepada_di']" ).removeClass("invalid");
					}
					if(isValid){
						$.ajax({
							type: "POST",
							url: "<?php echo base_url(); ?>cuti/update/",
							data: $('#form-selesai').serialize(), 
							success: function(msg){	
								if(msg == 'success'){
									close_sk_selesai();
									oTable_cuti.fnReloadAjax();
								}
							}
						});
					}
				},
				"Batal": function() {
					removeTinyMCE();
					$(this).dialog('destroy');
				}
			}
		});
		
	};
	
	window.ajax_status = function(id,peg_id,newstatus){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>cuti/do_change_status",
			data: "pegawai_id="+peg_id+"&id="+id+"&newstatus="+newstatus, 
			success: function(msg){	
				if(msg == 'success'){					
					oTable_cuti.fnReloadAjax();
				}
				return false;
			}
		});
	};
	
	window.change_status = function(newstatus,peg_id,id,pegawai,oldstatus,tipe,jcuti){

		var alerts ='';
		if(newstatus=="4"){
		    alerts = "Silahkan Cetak Verbal Dahulu!";
		}
		if(newstatus=="5"){
		    alerts = "Silahkan Acc Verbal Dahulu!";
		}
		if(newstatus=="6"){
		    alerts = "Silahkan Tanda Tangan Dahulu!";
		}
		if(newstatus=="7" || newstatus=="8"){
		    alerts = "Silahkan Penomoran SK Dahulu!";
		}
		switch(newstatus){
			case "3":
				if(oldstatus > newstatus){
					alert('Tidak boleh pilih status sebelumnya, silahkan pilih status berikutnya.');
				}else{
					if(confirm('Apakah '+pegawai+' akan diubah status menjadi Cetak Verbal?')){
						ajax_status(id,peg_id,newstatus);
					}
				}
				break;
			case "4":
				if(oldstatus < newstatus && oldstatus != (newstatus - 1)){
					alert(alerts);
				}else if(oldstatus > newstatus){
					alert('Tidak boleh pilih status sebelumnya, silahkan pilih status berikutnya.');
				}else if(oldstatus == (newstatus - 1)){
					if(confirm('Apakah '+pegawai+' akan diubah status menjadi Acc Verbal?')){
						ajax_status(id,peg_id,newstatus);
					}
				}
				break;
			case "5":
				if(oldstatus < newstatus && oldstatus != (newstatus - 1)){
					alert(alerts);
				}else if(oldstatus > newstatus){
					alert('Tidak boleh pilih status sebelumnya, silahkan pilih status berikutnya.');
				}else if(oldstatus == (newstatus - 1)){
					if(confirm('Apakah '+pegawai+' akan diubah status menjadi Tanda Tangan Usulan?')){
						ajax_status(id,peg_id,newstatus);
					}
				}
				break;
			case "6":
				if(oldstatus < newstatus && oldstatus != (newstatus - 1)){
					alert(alerts);
				}else if(oldstatus > newstatus){
					alert('Tidak boleh pilih status sebelumnya, silahkan pilih status berikutnya.');
				}else if(oldstatus == (newstatus - 1)){
					if(confirm('Apakah '+pegawai+' akan diubah status menjadi Penomoran SK?')){
						ajax_status(id,peg_id,newstatus);
					}
				}
				break;
			case "7":
				if(oldstatus < newstatus && oldstatus != (newstatus - 1)){
					alert(alerts);
				}else if(oldstatus > newstatus){
					alert('Tidak boleh pilih status sebelumnya, silahkan pilih status berikutnya.');
				}else if(oldstatus == (newstatus - 1)){
					dialog_sk_selesai(newstatus,peg_id,id,pegawai,tipe,jcuti);
				}
				break;
		}
	};
});
		
function printpage(url,jenis,name)
	{
		//child = window.open(url, "", "scrollbars=1,height=800, width=700"); //Open the child in a tiny window.
		$('#Cutipopup').dialog({
				autoOpen: false,
				modal: false,
				height: 500,
				width: 720,
				title: 'Print '+jenis+' '+name,
				buttons: {				
				"Cetak": function() {
					
					w=window.open("","", "scrollbars=1,height=600, width=800");
					w.document.write('<html><head><title>'+jenis+'_'+name+'</title>');
					w.document.write('<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css" type="text/css"  media="print" />');
					w.document.write('<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css" type="text/css"  media="print" />');
					w.document.write("<style>#cuti_{font-size: inherit !important;font-family: 'Arial','sans-serif';}</style>");
					w.document.write('<body id="cuti_">');
					w.document.write($('#Cutipopup').html());
					w.document.write('</body>');
					w.document.close();
					w.focus();
					w.print();
					w.close();					
					$( this ).dialog( "close" );
				},
				"Close": function() {
					$( this ).dialog( "close" );
				}
			 }
			});
		
		$('#Cutipopup').load(url, function(){
				$('#Cutipopup').dialog('open');
		});
	}
	
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
		                <li><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
				<li><a href="<?php echo base_url(); ?>penugasandankehadiran" title="">Penugasan & Kehadiran</a></li>
				<li class="active"><a href="<?php echo base_url(); ?>cuti" title="">Cuti</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Daftar Pengajuan Cuti</h5>
			    	</div>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                            
				<div>
				 <table>
					<tr>
						<?php if ($this->session->userdata('login_state') != 'User') : ?>
						<td style="width:100px;"><a href="<?php echo base_url(); ?>cuti/add2" class="btn btn-block btn-info">Pengajuan Cuti</a></td>
						<td class="hide" style="width:100px;"><a href="<?php echo base_url(); ?>cuti/approve" class="btn btn-block btn-info">Verifikasi</a></td>
						<?php else:?>
						<td style="width:100px;"><a href="<?php echo base_url(); ?>cuti/add2" class="btn btn-block btn-info">Ajukan Cuti</a></td>
						<?php endif;?>
					</tr>
				 </table>
				 </div>
				
				<!-- Media datatable -->
                <div class="widget">
                    <div class="table-overflow">
                        <table id="table-cuti" width="100%" class="table table-striped table-bordered table-checks media-table">
				<thead>
                                <tr>
				    <th width="5%" rowspan="2">No</th>
				    <th width="30%" rowspan="2">Yang Mengajukan</th>
				    <th width="20%" rowspan="2">Jenis Cuti</th>
				    <th width="22%" colspan="3"><div style="text-align:center;">Tanggal</div></th>
				    <th width="23%" colspan="7"><div style="text-align:center;">Status</div></th>
                                </tr>
				<tr>
				    <th>Tanggal Pengajuan</th>
				    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
				    <td>1</td>
				    <td>2</td>
				    <td>3</td>
				    <td>4</td>
				    <td>5</td>
				    <td>6</td>
				    <td>7</td>
				</tr>
                            </thead>
			    <tbody>
                            </tbody>
			</table>
                    </div>
                </div>
                <!-- /media datatable -->

		    </div>
		    <!-- /content wrapper -->
		    <div id="dialog-selesai">
			<form id="form-selesai" class="form-horizontal row-fluid well" method="post" action="" >
				<input type="hidden" id="status_cuti" name="status_cuti" value="7"/>
				<input type="hidden" id="id" name="id" />
				<div class="control-group">
					<label class="control-label" style="width:30%;">Nomor Surat</label>
					<div class="controls">
						<input id="no_surat" type="text" name="no_surat" class="input-medium" value="" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" style="width:30%;">Tempat / Tanggal Surat</label>
					<div class="controls">
						<input id="tempat_surat" type="text" name="tempat_surat" class="input-medium" style="width:46%;" value="" /> /
						<input id="tgl_surat" type="text" name="tgl_surat" class="datepicker input-small" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" style="width:30%;">Ditujukan Kepada</label>
					<div class="controls">
						<input id="kepada" type="text" name="kepada" class="input-large" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" style="width:30%;">Ditujukan Di</label>
					<div class="controls">
						<input id="kepada_di" type="text" name="kepada_di" class="input-xlarge" style="width:80%;"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" style="width:30%;">Jabatan Penandatangan</label>
					<div class="controls">
						<input id="ttd" type="hidden" name="ttd" />
						<select id="jabatan_ttd" name="jabatan_ttd" class="input-xlarge">
							<option value=""></option>
							<?php
								foreach($data_jabatan_ttd as $row){
									$selected = '';	
									
									echo "<option value='".$row->id_jabatan."' ".$selected.">".$row->nama_jabatan."</option>";
								}
							?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" style="width:30%;">Nama Penandatangan</label>
					<div class="controls">
						<input id="nama_ttd" type="text" name="nama_ttd" class="input-xlarge" value="" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" style="width:30%;">NIP Penandatangan</label>
					<div class="controls">
						<input id="nip_ttd" type="text" name="nip_ttd" class="input-xlarge" value="" />
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" style="width:30%;">Tembusan</label>
					<div class="controls">
						<textarea id="tembusan" name="tembusan" class="input-xxlarge" rows="4"></textarea>
					</div>
				</div>
			</form>
		   </div>
		</div>
		<!-- /content -->
		
	</div>
	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>
	<div id="Cutipopup"></div>
	<div id="dialog-cuti">
		<form id="edit-cuti" method="post" action="">
			<table>
				<tr>
					<td>Tanggal Mulai</td>
					<td>:</td>
					<td>
						<input type="text" name="tgl_mulai" class="datepicker" value="">
					</td>
				</tr>
				<tr>
					<td>Tanggal Selesai</td>
					<td>:</td>
					<td>
						<input type="text" name="tgl_akhir" class="datepicker" value="">
					</td>
				</tr>
				<input type="hidden" name="jumlah" value="">
			</table>
		</form>
	</div>
</body>
</html>