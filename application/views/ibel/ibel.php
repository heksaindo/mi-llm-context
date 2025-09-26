<!DOCTYPE html>
<html>
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head_tiny'); ?>
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
		
		var oTable_ibel;
		
		$(document).ready(function(){
			$( "#info-sp" ).hide();
			$( "#info-sk" ).hide();
			$( "#win-addsp" ).hide();
			$( "#win-addsk" ).hide();
			$( "#win-sp" ).hide();
			$( "#win-sk" ).hide();
			$( "#win-lisp" ).hide();
			$('#win-add-ibel').hide();
		   var thisYear = date('Y');
		   var thisMonth = date('m');
		   if(thisMonth < '04' || thisMonth > '10'){
			   thisMonth = 'April';
		   }else{
			   thisMonth = 'Oktober';
		   }
			   
		   $( '#hd_bulan' ).val( thisMonth );
		   $( '#table-src_bulan' ).val( thisMonth );
		   $( '#hd_tahun' ).val( thisYear );
		   $( '#table-src_tahun' ).val( thisYear );
		   
		   oTable_ibel = $('table#table-ibel').dataTable({
			   "sPaginationType": "full_numbers",
			   "sDom": '<"datatable-header"fl>t<"datatable-footer"ip>',
			   "oLanguage": {
				   "sSearch": "<span>Filter records:</span> _INPUT_",
				   "sLengthMenu": "<span>Show entries:</span> _MENU_",
				   "oPaginate": { "sFirst": "First", "sLast": "Last", "sNext": ">", "sPrevious": "<" }
			   },
			   "iDisplayLength": 10,
			   "sAjaxSource": "<?php echo base_url(); ?>ibel/ajax_ibel",
			   "fnServerData": function ( sSource, aoData, fnCallback ) { 
					   //alert($('#table-src_tahun').val());
					   //aoData.push({name: "bulan", value: $('#table-src_bulan').val() });
					   //aoData.push({name: "tahun", value: $('#table-src_tahun').val() });
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
		   
		   $("#nama").autocomplete("<?php echo base_url(); ?>ibel/auto_pegawai/", {
					width: 250,
					minChars:1,
					max:100,
					selectFirst: false
			});
				
		   onTambah = function(){
			$('#jabatan').prop('readonly', true);
			$('#win-add-ibel').dialog({
					modal: true,
					title: 'Tambah Izin Belajar',
					zIndex: 10000,
					autoOpen: true,
					width: 600, resizable: false,
					buttons: {
						"Simpan": function () {
							if($("#nama").val() == ''){
								$("#nama").addClass('invalid');
								return false;
							}else{
								$("#nama").removeClass('invalid');
							}
							if($("#asal_surat").val() == ''){
								$("#asal_surat").addClass('invalid');
								return false;
							}else{
								$("#asal_surat").removeClass('invalid');
							}
							if($("#tembusan").val() == ''){
								$("#tembusan").addClass('invalid');
								return false;
							}else{
								$("#tembusan").removeClass('invalid');
							}
							$.ajax({
								type: "POST",
								url: "<?php echo base_url(); ?>ibel/add_ibel",
								data: $("#form-add-ibel").serialize(),
								success: function(msg){	
									if(msg == 'success'){					
									//window.location.reload( true );	
										oTable_ibel.fnReloadAjax();
									}
									return false;
								}
							});
							$(this).dialog("close");
						},
						"Close": function() {
							$("#nama").val("");
							$("#jabatan").val("");
							$("#id_pegawai").val("");
							$("#tembusan").val("");
							$("#asal_surat").val("");
							$( this ).dialog( "close" );
						}
					}
			  });
			
				$("#nama").result(function(event, data, formatted) {
					if (data){  
						$("#nama").val(data[0]);
						$("#jabatan").val(data[2]);
						$("#id_pegawai").val(data[10]);
					}
				});
		   };
		   
		   doDelConfirm = function(id,txt){
			$('<div></div>').appendTo('body')
				.html('<div><h6>'+txt+'</h6></div>')
				.dialog({
					modal: true, title: 'Confirm', zIndex: 10000, autoOpen: true,
					width: 'auto', resizable: false,
					buttons: {
						Yes: function () {
							onDeleteIbel(id,true);
							$(this).dialog("close");
						},
						No: function () {
							$(this).dialog("close");
						}
					},
					close: function (event, ui) {
						$(this).remove();
					}
			  });
		   };
		   
		   onDeleteIbel = function(id,fr){
			var force = '';
			if(fr){
				force = '1';
			}
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>ibel/del_ibel/"+force,
				data: {'group':id},
				success: function(msg){	
					if(msg == 'success'){					
					//window.location.reload( true );	
						oTable_ibel.fnReloadAjax();
					}else{
						var dt = explode('|', msg);
						if(dt[1]=== '0'){
							alert(dt[2]);
						}else{
							doDelConfirm(id,dt[2]);
						}
					}
					return false;
				}
			});
		   };
		   
		   printSk = function(id,tf){
			if(!tf){
				$(".noprint-sk").show();
				$( "#info-sk" ).dialog({
					autoOpen: true,
					modal: true
				});
			}else{
				$(".noprint-sk").hide();
				$( "#win-sk" ).load("<?php echo base_url(); ?>ibel/data_print_sk/"+id)
					.dialog({
					  autoOpen: false,
					  height: 500,
					  width: 850,
					  modal: true,
					  closeText: "hide",
					  title: 'Print Preview',
					  buttons: {				
						"Cetak": function() {
							w=window.open("","", "scrollbars=1,height=600, width=800");
							w.document.write('<html><head><title>Print SK</title>');
							w.document.write('<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css" type="text/css"  media="print" />');
							w.document.write('<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css" type="text/css"  media="print" />');
							w.document.write("<style>#printsk_{font-size: inherit !important;font-family: 'Arial','sans-serif';}</style>");
							w.document.write('<body id="printsk_">');
							w.document.write($('#win-sk').html());
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
					 },
					  
				});
					$("#win-sk").dialog( "open" );
				
				return false;
			}
		   };
		   
		   printUsulan = function(id,tf){
			if(!tf){
				$(".noprint-sp").show();
				$( "#info-sp" ).dialog({
					autoOpen: true,
					modal: true
				});
			}else{
				$(".noprint-sp").hide();
				$( "#win-sp" ).load("<?php echo base_url(); ?>ibel/data_print_sp/"+id)
					.dialog({
					  autoOpen: false,
					  height: 500,
					  width: 850,
					  modal: true,
					  closeText: "hide",
					  title: 'Print Preview',
					  resizable: false,
					  buttons: {				
						"Cetak": function() {
							w=window.open("","", "scrollbars=1,height=600, width=800");
							w.document.write('<html><head><title>Print Usulan</title>');
							w.document.write('<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css" type="text/css"  media="print" />');
							w.document.write('<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css" type="text/css"  media="print" />');
							w.document.write("<style>#usulan_{font-size: inherit !important;font-family: 'Arial','sans-serif';}</style>");
							w.document.write('<body id="usulan_">');
							w.document.write($('#win-sp').html());
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
					 },
					  
				}); 
				$("#win-sp").dialog( "open" );
				
				return false;
			}
		   };
		   
		   onList = function(id){
			window.location = '<?php echo base_url()."ibel/listpegawai/";?>'+id;
		   };
		   
		   addIsp= function(id,sp,spdate){
				$("#ig").val(id);
				var title;
				if(sp){
					title = "Edit No. Surat Usulan";
					$("#no_sp").val(sp);
					$("#tanggal_sp").val(spdate);
				}else{
					title = "Masukkan No. Surat Usulan";
				}
				
				$("#win-addsp").dialog({
					autoOpen: true,
					width: 400,
					title: title,
					buttons: {
						"Simpan": function() {
							var bValid = true;
							var nosp = $("#no_sp").val();
							var tglsp = $("#tanggal_sp").val();
							
							if(nosp === ''){
								$("#no_sp").addClass("invalid");
								bValid = false;
							}
							if(tglsp === ''){
								$("#tanggal_sp").addClass("invalid");
								bValid = false;
							}
							if ( bValid ) {
								$.ajax({
									type: "POST",
									url: "<?php echo base_url(); ?>ibel/do_save_sp",
									data: $('#form-sp').serialize(), 
									success: function(data){
										if(data !== 'success'){		
											alert( 'Data tidak dapat dikirim, cek input!' );	
										}else{
											alert( 'Data sudah dikirim' );
											oTable_ibel.fnReloadAjax();
										}
									}
								});
								
								$( this ).dialog( "close" );	
							}
							
						}
					}
				});
		   };
		   
		   addIsk= function(id,sk,skdate){
				$("#ig-sk").val(id);
				var title;
				if(sk){
					title = "Edit No. SK";
					$("#no_sk").val(sk);
					$("#tanggal_sk").val(skdate);
				}else{
					title = "Masukkan No. SK";
				}
				
				$("#win-addsk").dialog({
					autoOpen: true,
					width: 400,
					title: title,
					buttons: {
						"Simpan": function() {
							var bValid = true;
							var nosk = $("#no_sk").val();
							var tglsk = $("#tanggal_sk").val();
							
							if(nosk === ''){
								$("#no_sk").addClass("invalid");
								bValid = false;
							}
							if(tglsk === ''){
								$("#tanggal_sk").addClass("invalid");
								bValid = false;
							}
							if ( bValid ) {
								$.ajax({
									type: "POST",
									url: "<?php echo base_url(); ?>ibel/do_save_sk",
									data: $('#form-sk').serialize(), 
									success: function(data){
										var dt = explode('|', data);
										if(dt[0] !== 'success'){		
											alert(dt[1]);	
										}else{
											alert( 'Data sudah dikirim' );
											oTable_ibel.fnReloadAjax();
										}
									}
								});
								
								$( this ).dialog( "close" );	
							}
							
						}
					}
				});
		   };
		});
		
        function printpage(url)
		{
		child = window.open(url, "", "scrollbars=1,height=800, width=600"); //Open the child in a tiny window.
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
						<li><a href="<?php echo base_url(); ?>pendidikan" title="">Pendidikan</a></li>
						 <li class="active"><a href="<?php echo base_url(); ?>ibel" title="">Izin Belajar</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Data ibel</h5>
			    	</div>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Usulan Izin Belajar</h6>
							<div style="float: right;">
								<span onclick="javascript:onTambah()" style="cursor: pointer;"  class="btn btn-primary">Tambah</span>
							</div>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="table-ibel" width="100%" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th width="20">No</th>
                                    <th width="200">No. Surat Pengantar</th>
                                    <th width="200">No. SK</th>
                                    <th width="50">List pegawai</th> 
									<th width="50">Action</th>
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

		</div>
		<!-- /content -->
		
	</div>
	<!-- /content container -->
	<div id="info-sp"><p class="noprint-sp">Belum ada Surat Usulan</p></div>
	<div id="win-sp"></div>
	<div id="win-addsp">
		<form id="form-sp" method="post" action="" >
			<input id="ig" type="hidden" name="ig"/>
			<table>
				<tr>
					<td width="150"><label class="control-label">No. Surat Usulan</label></td>
					<td>:</td>
					<td><input id="no_sp" name="isp" type="text" /></td>
				</tr>
				<tr>
					<td><label class="control-label">Tanggal</label></td>
					<td>:</td>
					<td><input id="tanggal_sp" type="text" name="tanggal_sp" class="input-medium datepicker"/></td>
				</tr>
			</table>
		</form>
	</div>
	
	<div id="info-sk"><p class="noprint-sk">Belum ada SK</p></div>
	<div id="win-sk"></div>
	<div id="win-addsk">
		<form id="form-sk" class="form-horizontal row-fluid well" method="post" action="" >
			<input id="ig-sk" type="hidden" name="ig"/>
			<table>
				<tr>
					<td width="150"><label class="control-label">No. SK</label></td>
					<td>:</td>
					<td><input id="no_sk" name="isk" type="text" /></td>
				</tr>
				<tr>
					<td><label class="control-label">Tanggal</label></td>
					<td>:</td>
					<td><input id="tanggal_sk" type="text" name="tanggal_sk" class="input-medium datepicker"/></td>
				</tr>
			</table>
		</form>
	</div>
	
	<div id="win-lisp"></div>
	<div id="win-add-ibel">
		<form id="form-add-ibel" class="form-horizontal row-fluid well" method="post" >
			<input id="id_pegawai" type="hidden" name="id_pegawai" value="" />
			<table>
				<tr>
					<td width="150"><label>Nama Penandatangan</label></td>
					<td>:</td>
					<td><input id="nama" type="text" name="nama" class="input-xlarge" value="" />  (Auto Complete)</td>
				</tr>
				<tr>
					<td><label class="control-label">Jabatan/Gol</label></td>
					<td>:</td>
					<td><input id="jabatan" type="text" name="jabatan" class="input-xlarge" value="" /></td>
				</tr>
				<tr>
					<td><label>Asal Surat</label></td>
					<td>:</td>
					<td><input id="asal_surat" type="text" name="asal_surat" class="input-xlarge" value="" /></td>
				</tr>
				<tr>
					<td><label>Tembusan</label></td>
					<td>:</td>
					<td><input id="tembusan" type="text" name="tembusan" class="input-xlarge" value="" /></td>
				</tr>
			</table>
		</form>
	</div>
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>