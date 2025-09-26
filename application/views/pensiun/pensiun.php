<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>
	
	<link rel="stylesheet" href="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.js"></script>
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
}
 
var oTable_pensiun;

 $(function() {
 
	oTable_pensiun = $('table#table-pensiun').dataTable( {
		"sPaginationType": "full_numbers",
		"sDom": '<"datatable-header"fl>t<"datatable-footer"ip>',
		"oLanguage": {
			"sSearch": "<span>Filter records:</span> _INPUT_",
			"sLengthMenu": "<span>Show entries:</span> _MENU_",
			"oPaginate": { "sFirst": "First", "sLast": "Last", "sNext": ">", "sPrevious": "<" }
		},
		"iDisplayLength": 10,
		"sAjaxSource": "<?php echo base_url(); ?>pensiun/ajax_pensiun",
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
	} );
	
	$('#dialog-masalah').hide();
	$('#dialog-selesai').hide();
	
	$('#ttd').val('');
	$('#nama_ttd').val('');
	$('#jabatan_ttd').val('');
	$('#nip_ttd').val('');
	$('#mkg_tahun').val('');
	$('#mkg_bulan').val('');
	$('#jabatan_ttd').change(function(){
		//$('#nama_ttd').val('');
		var jabatan_ttd = $('#jabatan_ttd option:selected').val();
		$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>kenaikangajipegawai/get_tandatangan",
				data: 'jabatan_ttd='+jabatan_ttd, 
				success: function(msg){	
					if(msg){			
						var data = explode('|', msg);
						$("#nip_ttd").val(data[0]);		
						$("#nama_ttd").val(data[1]);
						$('#ttd').val(data[2]);
					}else{
						$("#nip_ttd").val('');		
						$("#nama_ttd").val('');
						$("#ttd").val('');	
					}
					return false;
				}
			});
		
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
		                <li><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
						 <li><a href="<?php echo base_url(); ?>administrasipegawai" title="Administrasi Pegawai" class="tip" rel="tooltip">Administrasi Pegawai</a></li>
						 <li class="active"><a href="<?php echo base_url(); ?>pensiun" title="">Pensiun</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Pensiun</h5>
			    	</div>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>

				<!-- Media datatable -->
                <div class="widget">
					<div style="float: left;">
						<a href="<?php echo base_url(); ?>pensiun/add_pensiun_pilihan" class="btn btn-primary">Add Pensiun Pilihan</a>
					</div>
					<!--<div style="float: right;">
						<a href="<?php echo base_url().'pensiun/list_histori_pensiun'; ?>"  class="btn btn-primary">Histori Pensiun >></a>
					</div>-->
					<div style="clear: both;"></div>
					
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Pensiun</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="table-pensiun" width="100%" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th width="20" rowspan="2">No</th>
                                    <th width="200" rowspan="2">Nama / NIP</th>
                                    <th width="160" rowspan="2">Jabatan</th>
                                    <th width="50" rowspan="2">BUP</th>
									<th width="80" rowspan="2">Tanggal Lahir</th>
                                    <th width="80" rowspan="2">TMT Pensiun</th>
									<th width="23%" colspan="6"><div style="text-align:center;">Status</div></th>
                                </tr>
								<tr>
									<td>1</td>
									<td>2</td>
									<td>3</td>
									<td>4</td>
									<td>5</td>
									<td>6</td>
								</tr>
                            </thead>
                            <tbody>
							
                            </tbody>
                        </table>
                    </div>                             	
                </div>
                <!-- /media datatable -->

				<div id="dialog-masalah"> 
					<form id="form-masalah" method="post" action="" >
						Masalah : <br>
						<textarea id="masalahnya" name="masalahnya" class="input-xlarge tinymce" rows="4"></textarea>
								
					</form>
				</div>

				<div id="dialog-selesai">
					<div class="row">
					<form id="form-selesai" class="form-horizontal row-fluid well" method="post" action="" >
						<input type="hidden" id="id" name="id" />
						<input type="hidden" id="nip_baru" name="nip_baru" />
						<input type="hidden" id="pegawai_id" name="pegawai_id" />
						<div class="step-title">
							<h5>Data Surat Keputusan</h5>
						</div>
					
					   <div class="control-group">
							<label class="control-label">Perihal</label>
							<div class="controls">
								<input id="perihal" type="text" name="perihal" class="input-xlarge" value="Permohonan pensiun" />
							</div>
						</div>
					   <div class="control-group">
								<label class="control-label">Kepada</label>
								<div class="controls">
									<input id="kepada" type="text" name="kepada" class="input-xlarge" />
								</div>
						</div>
						<div class="control-group">
								<label class="control-label">Jabatan Penandatangan</label>
								<div class="controls">
									<input id="ttd" type="hidden" name="ttd" />
									<select id="jabatan_ttd" name="jabatan_ttd" class="input-xlarge">
										<option value=""></option>
										<?php
											foreach($data_jabatan_ttd as $row){
												$selected = '';	
												if(strtoupper($data_kp->jabatan_ttd) == strtoupper($row->id_jabatan)){
													$selected =  'selected = "selected"'; 
												}
												echo "<option value='".$row->id_jabatan."' ".$selected.">".$row->nama_jabatan."</option>";
											}
										?>
									</select>
								</div>
						</div>
						<div class="control-group">
								<label class="control-label">Nama Penandatangan</label>
								<div class="controls">
									<input id="nama_ttd" type="text" name="nama_ttd" class="input-xlarge" value="" />
								</div>
						</div>
						<div class="control-group">
								<label class="control-label">NIP Penandatangan</label>
								<div class="controls">
									<input id="nip_ttd" type="text" name="nip_ttd" class="input-xlarge" value="" />
								</div>
						</div>
						<div class="control-group">
								<label class="control-label">Tembusan</label>
								<div class="controls">
									<textarea id="tembusan" name="tembusan" class="input-xxlarge" rows="4">
										<p class=MsoNormal><span lang=SV style='font-family:"Arial Narrow","sans-serif"'>1.
										</span><span
										lang=SV style='font-family:"Arial Narrow","sans-serif"'>Direktur Jenderal Bina
										Upaya Kesehatan di Jakarta ;</span></p>

										<p class=MsoNormal><span lang=SV style='font-family:"Arial Narrow","sans-serif"'>2.
										</span><span
										lang=SV style='font-family:"Arial Narrow","sans-serif"'>Kepala Badan
										Kepegawaian Negara di Jakarta ;</span></p>

										<p class=MsoNormal style='text-align:justify'><span lang=SV style='font-family:
										"Arial Narrow","sans-serif"'>3. </span><span
										lang=SV style='font-family:"Arial Narrow","sans-serif"'>Kabag. Hukum,
										Organisasi dan Humas</span><span lang=SV style='font-family:"Arial Narrow","sans-serif"'>
										di </span><span
										lang=SV style='font-family:"Arial Narrow","sans-serif"'>Jakarta</span><span
										lang=SV style='font-family:"Arial Narrow","sans-serif"'> ;</span></p>

										<p class=MsoNormal><span lang=SV style='font-family:"Arial Narrow","sans-serif"'>4.
										</span><span
										lang=SV style='font-family:"Arial Narrow","sans-serif"'>Yang bersangkutan.</span></p>
									</textarea>
								</div>
						</div>
						<div class="control-group">
							<label class="control-label">Tanggal SK</label>
							<div class="controls">
								<input id="tanggal_sk" type="text" name="tanggal_sk" class="input-medium datepicker" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">No SK</label>
							<div class="controls">
								<input id="no_sk" type="text" name="no_sk" class="input-xlarge" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Masa Kerja Golongan</label>
							<div class="controls">
								<input id="mkg_tahun" type="text" name="mkg_tahun" class="input-small" /> Tahun
								<input id="mkg_bulan" type="text" name="mkg_bulan" class="input-small" /> Bulan
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">TMT Pensiun</label>
							<div class="controls">
								<input id="tmt_pensiun" type="text" name="tmt_pensiun" class="input-medium datepicker" />
							</div>
						</div>
						
					</form>
					<style>
						#form-selesai.form-horizontal .control-label{
							width: 30%;
						}
					</style>
					</div>
				</div>

		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		
	</div>
	
	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>
	
<script type="text/javascript">

function change_status(newstatus, pegawai_id, id, nip_baru, nama, before_status, status_masalah,tmt,mk){
	var do_change = 0;
	
	if(status_masalah == '' || status_masalah == 'N'){
		//alert(before_status);
		if(newstatus == 'Masalah'){
			window.open('http://ropeg.kemkes.go.id/inpro/','_blank');
			/*$( "#masalahnya" ).val('');
			$( "#dialog-masalah" ).dialog({
				  autoOpen: false,
				  height: 300,
				  width: 500,
				  modal: true,
				  title: 'Status Masalah',
				  buttons: {
					"Simpan": function() {
						var bValid = true;
						var masalahnya = $( "#masalahnya" ).val(); 
						
						if(masalahnya == ''){
							$( "#masalahnya" ).addClass("invalid");
							bValid = false;
						}		
							
						if ( bValid ) {
							$.ajax({
								type: "POST",
								url: "<?php echo base_url(); ?>pensiun/do_change_masalah",
								data: "nip_baru="+nip_baru+"&pegawai_id="+pegawai_id+"&id="+id+"&status_masalah="+status_masalah+"&masalahnya="+masalahnya, 
								success: function(msg){	
									if(msg == 'success'){					
										//window.location.reload( true );	
										oTable_pensiun.fnReloadAjax();
									}
									return false;
								}
							});
							
							$( this ).dialog( "close" );	
						}
					},
					"Batal": function() {
					  $( this ).dialog( "close" );
					}
				}
				  
			}); 
			
			$( "#dialog-masalah" ).dialog( "open" );
			*/
		}else 
		if(newstatus == 'SK Selesai'){ 
			$( "#id" ).val(id);
			$( "#nip_baru" ).val(nip_baru);
			$( "#pegawai_id" ).val(pegawai_id);
			$("#tmt_pensiun").val(tmt);
			var mkg = mk.split("#");
			$("#mkg_tahun").val(mkg[0]);
			$("#mkg_bulan").val(mkg[1]);
			if(before_status == 'Kirim Ke Biro') {
				$( "#dialog-selesai" ).dialog({
					  autoOpen: false,
					  height: 450,
					  width: 700,
					  modal: true,
					  title: 'SK Selesai',
					  buttons: {
						"Simpan": function() {
							var bValid = true;
							var nama_ttd = $( "#nama_ttd" ).val();
							var nip_ttd = $( "#nip_ttd" ).val();
							var jabatan_ttd = $("#jabatan_ttd").val();
							var tanggal_sk = $( "#tanggal_sk" ).val(); 
							var no_sk = $( "#no_sk" ).val(); 
							var masa_kerja = $( "#masa_kerja" ).val(); 
							var tmt_pensiun = $( "#tmt_pensiun" ).val(); 
							
							if(nama_ttd === ''){
								$( "#nama_ttd" ).addClass("invalid");
								bValid = false;
							}
							if(nip_ttd === ''){
								$( "#nip_ttd" ).addClass("invalid");
								bValid = false;
							}
							if(jabatan_ttd === ''){
								$( "#jabatan_ttd" ).addClass("invalid");
								bValid = false;
							}
							if(tanggal_sk === ''){
								$( "#tanggal_sk" ).addClass("invalid");
								bValid = false;
							}
							if(no_sk === ''){
								$( "#no_sk" ).addClass("invalid");
								bValid = false;
							}
							if(masa_kerja === ''){
								$( "#masa_kerja" ).addClass("invalid");
								bValid = false;
							}
							if(tmt_pensiun === ''){
								$( "#tmt_pensiun" ).addClass("invalid");
								bValid = false;
							}
							
							//alert(err);
								
							if ( bValid ) {
								$.ajax({
									type: "POST",
									url: "<?php echo base_url(); ?>pensiun/do_change_selesai",
									data: $('#form-selesai').serialize(), 
									success: function(msg){	
										if(msg == 'success'){					
											//window.location.reload( true );	
											oTable_pensiun.fnReloadAjax();
										}
										return false;
									}
								});
								
								$( this ).dialog( "close" );	
							}
						},
						"Batal": function() {
						  $( this ).dialog( "close" );
						}
					}
					  
				}); 
				
				$( "#dialog-selesai" ).dialog( "open" );
				
			}else{
				alert('Silahkan cek status sebelumnya');
			}
		}else{
			
			if(before_status == 'Dokumen Usulan Masuk' || before_status == ''){
				if(newstatus == 'Tanda Tangan Usulan' || newstatus == 'Kirim Ke Biro' || newstatus == 'SK Selesai' ){
					do_change = 0;
					alert('Silahkan Add Entry data terlebih dahulu ');
				}else{
					if(newstatus == 'Proses Entry Data'){
						window.location.assign("<?php echo base_url().'pensiun/addexisting/'; ?>"+pegawai_id);
					}
				}
			}
			if(before_status == 'Proses Entry Data'){
				if(newstatus == 'Kirim Ke Biro' || newstatus == 'SK Selesai' ){
					do_change = 0;
					alert('Silahkan Pilih Tanda Tangan Usulan terlebih dahulu ');
				}else{
					if(newstatus == 'Tanda Tangan Usulan' || newstatus == 'Proses Entry Data'){
						do_change = 1;
					}else{
						do_change = 0;
						alert('Tidak boleh pilih status sebelumnya, silahkan pilih status berikutnya.');
					}
				}
			}
			if(before_status == 'Tanda Tangan Usulan'){
				if(newstatus == 'SK Selesai' ){
					do_change = 0;
					alert('Silahkan Pilih Kirim Ke Biro terlebih dahulu ');
				}else{
					if(newstatus == 'Kirim Ke Biro' || newstatus == 'Tanda Tangan Usulan'){
						do_change = 1;
					}else{
						do_change = 0;
						alert('Tidak boleh pilih status sebelumnya, silahkan pilih status berikutnya.');
					}
				}
			}
			if(before_status == 'Kirim Ke Biro'){
				if(newstatus == 'Kirim Ke Biro'){
					do_change = 1;
				}else{
					do_change = 0;
					alert('Tidak boleh pilih status sebelumnya, silahkan pilih status berikutnya.');
				}
			}
			
			
			if(do_change == 1){
				if(newstatus == before_status ){
					do_change = 0;
					alert('Status sudah '+newstatus);
				}else{
					if(confirm('Apakah '+nama+' akan diubah status menjadi "'+newstatus+'" ?')){
						$.ajax({
							type: "POST",
							url: "<?php echo base_url(); ?>pensiun/do_change_status",
							data: "nip_baru="+nip_baru+"&pegawai_id="+pegawai_id+"&id="+id+"&newstatus="+newstatus, 
							success: function(msg){	
								if(msg == 'success'){					
									//window.location.reload( true );										
									//oTable_pensiun.fnDraw();
									oTable_pensiun.fnReloadAjax();
								}
								return false;
							}
						});
					}
				
				}
			}
			
		}
	}
	
	if(status_masalah == 'Y'){
		//before Masalah Y -> change to N		
			var masalahnya = $( "#masalahnya" ).val(); 
			if(confirm('Masalah: \n'+masalahnya+' \n\n Apakah masalah '+nama+' sudah selesai ?')){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>pensiun/do_change_masalah",
					data: "nip_baru="+nip_baru+"&pegawai_id="+pegawai_id+"&id="+id+"&status_masalah="+status_masalah, 
					success: function(msg){	
						if(msg == 'success'){					
							//window.location.reload( true );	
							oTable_pensiun.fnReloadAjax();
						}
						return false;
					}
				});
			}
		
	}
}
</script>
</body>
</html>