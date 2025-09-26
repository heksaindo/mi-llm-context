<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<meta http-equiv="content-type" content="text/html"  charset="utf-8" />
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
}
 
var oTable_kp;

$(document).ready(function(){
	$('#dialog-masalah').hide();
	$('#dialog-selesai').hide();
	
	
	oTable_kp = $('table#table-kp').dataTable( {
		"sPaginationType": "full_numbers",
		"sDom": '<"datatable-header"fl>t<"datatable-footer"ip>',
		"oLanguage": {
			"sSearch": "<span>Filter records:</span> _INPUT_",
			"sLengthMenu": "<span>Show entries:</span> _MENU_",
			"oPaginate": { "sFirst": "First", "sLast": "Last", "sNext": ">", "sPrevious": "<" }
		},
		"iDisplayLength": 10,
		"sAjaxSource": "<?php echo base_url(); ?>kenaikanpangkat/ajax_kp",
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
	
	<?php
	$dropdown_pendidikan = '';
	if(!empty($data_pendidikan)){
		foreach($data_pendidikan as $dt){
			$dropdown_pendidikan .= '<option value="'.$dt->id_strata.'">'.$dt->nama_strata.'</option>';
		}
	}
	
	if(!empty($dropdown_pendidikan)){
		$dropdown_pendidikan = '&nbsp;&nbsp;&nbsp;<span>Pendidikan: </span><select id="table-src_pendidikan" style="width:150px; margin-left:5px;"><option value="">Semua</option>'.$dropdown_pendidikan.'</select>';
	}
	?>
	
	$('<div class="dataTables_periode"><span>Periode: </span>'+
		'<select id="table-src_bulan">'+
			'<option value="April">April</option>'+
			'<option value="Oktober">Oktober</option>'+
		'</select>'+
		' <input type="text" name="table-src_tahun" id="table-src_tahun" class="tahun" />'+	
		'&nbsp;<?php echo $dropdown_pendidikan; ?>'+
		'</div>').insertAfter('div.dataTables_filter');

	var thisYear = date('Y');
	var thisMonth = date('m');
	if(thisMonth == '11' || thisMonth == '12' || thisMonth == '01' || thisMonth == '02' || thisMonth == '03' || thisMonth == '04'){
		thisMonth = 'April';
		
		if(thisMonth == '11' || thisMonth == '12'){
			thisYear = thisYear + 1;
		}
		
	}else{
		thisMonth = 'Oktober';
	}
	$( '#table-src_bulan' ).val( thisMonth );
	$( '#table-src_tahun' ).val( thisYear );	
	
	//onchange periode
	$( "#table-src_bulan, #table-src_tahun, #table-src_pendidikan" ).change(function() {
		var bulan = $( "#table-src_bulan" ).val();
		var tahun = $( "#table-src_tahun" ).val();
		var id_strata = $( "#table-src_pendidikan" ).val();
		if(bulan){
			var addParam = "?bulan=" + bulan + 
							"&tahun=" + tahun+
							"&id_strata=" + id_strata;
			oTable_kp.fnReloadAjax("<?php echo base_url(); ?>kenaikanpangkat/ajax_kp" + addParam);	
			/*$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>kenaikanpangkat/ajax_kp",
				data: "bulan="+ bulan + "&tahun="+tahun, 
				success: function(msg){	
					//if(msg){
						oTable_kp.fnReloadAjax("<?php echo base_url(); ?>urutkepangkatan/ajax_duk" + addParam);	
					//}
					return false;
				}
			});*/
		}
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
		                <li><a href="<?php echo base_url(); ?>Home">Dashboard</a></li>
						 <li><a href="<?php echo base_url(); ?>administrasipegawai" title="sss" class="tip" rel="tooltip">Administrasi Pegawai</a></li>
						 <li class="active"><a href="<?php echo base_url(); ?>kenaikanpangkat" title="">Kenaikan Pangkat</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Kenaikan Pangkat</h5>
			    	</div>
			    </div>
			     <!-- /page header -->
				
				<?php $this->load->view('layout/_actionwrapper'); ?>

				<!-- Media datatable -->
                <div class="widget">
					<div style="float: left;">
						<a href="<?php echo base_url(); ?>kenaikanpangkat/add_kp_pilihan" class="btn btn-primary">Add KP Pilihan</a>
					</div>
					<div style="float: right;">
						<a href="<?php echo base_url().'kenaikanpangkat/list_histori_kp'; ?>"  class="btn btn-primary">Histori KP >></a>
					</div>
					<div style="clear: both;"></div>
					
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Kenaikan Pangkat</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="table-kp" width="100%" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th width="20" rowspan="2">No</th>
                                    <th width="200" rowspan="2">Nama / NIP</th>
                                    <th width="160" rowspan="2">Jabatan</th>
                                    <th width="160" rowspan="2">Unit Kerja</th>
									<th width="100" colspan="2"><div style="text-align:center;">Pangkat</div></th>
									<th width="60" rowspan="2">Periode</th>
									<th width="23%" colspan="6"><div style="text-align:center;">Status</div></th>       
                                </tr>
								<tr>
									<td>Gol</td>
									<td>TMT</td>
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
					<form id="form-selesai" method="post" action="" >
						<input type="hidden" id="id" name="id" />
						<input type="hidden" id="nip_baru" name="nip_baru" />
						<div class="step-title">
							<h5>Data Surat Keputusan</h5>
						</div>
						
						<div class="control-group">
							<label class="control-label">Pejabat Penetapan</label>
							<div class="controls">
								<input id="pejabatpenetapan" type="text" name="pejabatpenetapan" class="input-xlarge" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Tanggal SK</label>
							<div class="controls">
								<input id="tanggal_sk" type="text" name="tanggal_sk" class="datepicker input-medium" />
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
								<input id="masa_kerja_gol" type="text" name="masa_kerja_gol" class="input-xlarge" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Tanggal Mulai Berlaku</label>
							<div class="controls">
								<input id="tanggal_berlaku" type="text" name="tanggal_berlaku" class="datepicker input-medium" />
							</div>
						</div>
						<!--<div class="control-group">
							<label class="control-label">Golongan Lama</label>
							<div class="controls">
								<input id="gol_lama" type="text" name="gol_lama" value="" class="input-medium" />
							</div>
						</div>-->
						<div class="control-group">
							<label class="control-label">Golongan Baru</label>
							<div class="controls">
								<select id="gol_baru" name="gol_baru" class="input-medium is_required">
									<option value=""> </option>
									<?php
									$this->db->order_by('id_golongan','ASC');
									$query = $this->db->get('m_golongan');
									
									if ($query->num_rows() > 0) {
										foreach($query->result() as $row){
											
											echo "<option value='".$row->kode_golongan."' ".$selected.">".$row->kode_golongan."</option>";
										}
									}
									
									?>
								</select>
							</div>
						</div>
								
					</form>
				</div>
				
		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		
	</div>
	
	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>

<script type="text/javascript">

function change_status(newstatus, pegawai_id, id, nip_baru, nama, before_status, status_masalah){
	var do_change = 0;
	
	if(status_masalah == '' || status_masalah == 'N'){
		//alert(before_status);
		if(newstatus == 'Masalah'){  
			$( "#masalahnya" ).val('');
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
								url: "<?php echo base_url(); ?>kenaikanpangkat/do_change_masalah",
								data: "nip_baru="+nip_baru+"&pegawai_id="+pegawai_id+"&id="+id+"&status_masalah="+status_masalah+"&masalahnya="+masalahnya, 
								success: function(msg){	
									if(msg == 'success'){					
										//window.location.reload( true );	
										oTable_kp.fnReloadAjax();
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
			
		}else 
		if(newstatus == 'SK Selesai'){ 
			$( "#id" ).val(id);
			$( "#nip_baru" ).val(nip_baru);
			if(before_status == 'Kirim Ke Biro') {
				$( "#dialog-selesai" ).dialog({
					  autoOpen: false,
					  height: 450,
					  width: 500,
					  modal: true,
					  title: 'SK Selesai',
					  buttons: {
						"Simpan": function() {
							var bValid = true;
							var pejabatpenetapan = $( "#pejabatpenetapan" ).val(); 
							var tanggal_sk = $( "#tanggal_sk" ).val(); 
							var no_sk = $( "#no_sk" ).val(); 
							var masa_kerja_gol = $( "#masa_kerja_gol" ).val(); 
							var tanggal_berlaku = $( "#tanggal_berlaku" ).val(); 
							var gol_baru = $( "#gol_baru" ).val(); 
							
							if(pejabatpenetapan == ''){
								$( "#pejabatpenetapan" ).addClass("invalid");
								bValid = false;
							}		
							if(tanggal_sk == ''){
								$( "#tanggal_sk" ).addClass("invalid");
								bValid = false;
							}
							if(no_sk == ''){
								$( "#no_sk" ).addClass("invalid");
								bValid = false;
							}
							if(masa_kerja_gol == ''){
								$( "#masa_kerja_gol" ).addClass("invalid");
								bValid = false;
							}
							if(tanggal_berlaku == ''){
								$( "#tanggal_berlaku" ).addClass("invalid");
								bValid = false;
							}
							if(gol_baru == ''){
								$( "#gol_baru" ).addClass("invalid");
								bValid = false;
							}
							
							//alert(err);
								
							if ( bValid ) {
								$.ajax({
									type: "POST",
									url: "<?php echo base_url(); ?>kenaikanpangkat/do_change_selesai",
									data: $('#form-selesai').serialize(), 
									success: function(msg){	
										if(msg == 'success'){					
											//window.location.reload( true );	
											oTable_kp.fnReloadAjax();
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
						window.location.assign("<?php echo base_url().'kenaikanpangkat/addexisting/'; ?>"+pegawai_id);
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
							url: "<?php echo base_url(); ?>kenaikanpangkat/do_change_status",
							data: "nip_baru="+nip_baru+"&pegawai_id="+pegawai_id+"&id="+id+"&newstatus="+newstatus, 
							success: function(msg){	
								if(msg == 'success'){					
									//window.location.reload( true );										
									//oTable_kp.fnDraw();
									oTable_kp.fnReloadAjax();
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
					url: "<?php echo base_url(); ?>kenaikanpangkat/do_change_masalah",
					data: "nip_baru="+nip_baru+"&pegawai_id="+pegawai_id+"&id="+id+"&status_masalah="+status_masalah, 
					success: function(msg){	
						if(msg == 'success'){					
							//window.location.reload( true );	
							oTable_kp.fnReloadAjax();
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