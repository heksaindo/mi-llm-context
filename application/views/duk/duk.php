<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
}
 
var oTable_duk;

 $(function() {

	oTable_duk = $('table#table-duk').dataTable( {
		"sPaginationType": "full_numbers",
		"sDom": '<"datatable-header"fl>t<"datatable-footer"ip>',
		"oLanguage": {
			"sSearch": "<span>Filter records:</span> _INPUT_",
			"sLengthMenu": "<span>Show entries:</span> _MENU_",
			"oPaginate": { "sFirst": "First", "sLast": "Last", "sNext": ">", "sPrevious": "<" }
		},
		"iDisplayLength": 10,
		"sAjaxSource": "<?php echo base_url(); ?>laporan/ajax_duk",
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

	
		$('#pencarian_duk').hide(); 
		$('#hide_pencarian_duk').hide(); 
		$('#search_duk').hide(); 
		$('#reset_duk').hide(); 
		$('#onSatuankerja').hide(); 
		$('#onSatuanorganisasi').hide(); 
		$('#onUnitorganisasi').hide(); 
		$('#src_organisasi_kerja').val( '' ); 
		
		$('#show_pencarian_duk').click( function() {
			$('#pencarian_duk').show(); 
			$('#show_pencarian_duk').hide();	
			$('#hide_pencarian_duk').show(); 
			$('#search_duk').show(); 
			$('#reset_duk').show(); 
		} );
		
		$('#hide_pencarian_duk').click( function() {
			$('#pencarian_duk').hide(); 
			$('#hide_pencarian_duk').hide();	
			$('#show_pencarian_duk').show(); 
			$('#search_duk').hide(); 
			$('#reset_duk').hide(); 
		} );
		
		//Filter 2
		$('#src_jabatan').val('');
		$('#src_struktural').val('');
		$('#src_fungsional').val('');
		$('#src_fungsional_tertentu').val('');
		$('#src_fungsional_umum').val('');
		$('#src_struktural').hide();
		$('#src_fungsional').hide();
		$('#src_fungsional_tertentu').hide();

		$('#src_jabatan').change( function() {
			var src_jabatan = $( "#src_jabatan" ).val();
			if(src_jabatan == 'Struktural'){
				$('#src_struktural').show();
				$('#src_fungsional').hide();
				$('#src_fungsional_tertentu').hide();
				$('#src_fungsional_tertentu').val('');
				$('#src_fungsional_umum').val('');
				$('#src_fungsional').val('');
			}
			if(src_jabatan == 'Fungsional'){
				$('#src_struktural').hide();
				$('#src_fungsional').show();
				$('#src_fungsional_tertentu').hide();
				$('#src_struktural').val('');								
				$('#src_fungsional_umum').val('');								
				$('#src_fungsional').val('');								
			}	
			if(src_jabatan == ''){
				$('#src_struktural').hide();
				$('#src_fungsional').hide();
				$('#src_fungsional_tertentu').hide();
				$('#src_fungsional_tertentu').val('');
				$('#src_fungsional_umum').val('');
				$('#src_fungsional').val('');
			}
			
		} );
		$('#src_fungsional').change( function() {
			if($('#src_fungsional').val() == 'Umum'){
				$('#src_fungsional_umum').val('JFU');
				$('#src_fungsional_tertentu').hide();
				$('#src_fungsional_tertentu').val('');
			}
			if($('#src_fungsional').val() == 'Tertentu'){				
				$('#src_fungsional_tertentu').show();		
				$('#src_fungsional_umum').val('');
			}	
			if($('#src_fungsional').val() == ''){				
				$('#src_fungsional_tertentu').hide();		
				$('#src_fungsional_tertentu').val('');
				$('#src_fungsional_umum').val('');
			}	
		});
			
		
		$('#search_duk').click( function() {
			
			var addParam = "?src_organisasi_kerja=" + $( "#src_organisasi_kerja" ).val() + 
							"&src_satuan_kerja=" + $( "#src_satuan_kerja" ).val() + 
							"&src_satuan_organisasi=" + $( "#src_satuan_organisasi" ).val() + 
							"&src_unit_organisasi=" + $( "#src_unit_organisasi" ).val() +
							"&src_jabatan=" + $( "#src_jabatan" ).val() +
							"&src_struktural=" + $( "#src_struktural" ).val() +
							"&src_fungsional=" + $( "#src_fungsional" ).val() +
							"&src_fungsional_tertentu=" + $( "#src_fungsional_tertentu" ).val() +
							"&src_fungsional_umum=" + $( "#src_fungsional_umum" ).val();
			oTable_duk.fnReloadAjax("<?php echo base_url(); ?>laporan/ajax_duk" + addParam);		
			
		} );
		
		$('#reset_duk').click( function() {
			
			$('#src_organisasi_kerja').val('');
			$('#src_satuan_kerja').val('');
			$('#src_satuan_organisasi').val('');
			$('#src_unit_organisasi').val('');
			$('#src_jabatan').val('');
			$('#src_struktural').val('');
			$('#src_fungsional').val('');
			$('#src_fungsional_tertentu').val('');
			$('#src_fungsional_umum').val('');
			$('#pencarian_duk').show(); 	

			oTable_duk.fnReloadAjax("<?php echo base_url(); ?>laporan/ajax_duk");	
			
		} );
		
		$('#print_duk').click( function() {
		
			var addParam = "?src_organisasi_kerja=" + $( "#src_organisasi_kerja" ).val() + 
							"&src_satuan_kerja=" + $( "#src_satuan_kerja" ).val() + 
							"&src_satuan_organisasi=" + $( "#src_satuan_organisasi" ).val() + 
							"&src_unit_organisasi=" + $( "#src_unit_organisasi" ).val() +
							"&src_jabatan=" + $( "#src_jabatan" ).val() +
							"&src_struktural=" + $( "#src_struktural" ).val() +
							"&src_fungsional=" + $( "#src_fungsional" ).val() +
							"&src_fungsional_tertentu=" + $( "#src_fungsional_tertentu" ).val() +
							"&src_fungsional_umum=" + $( "#src_fungsional_umum" ).val();
			window.open("<?php echo base_url(); ?>laporan/cetakDuk/"+addParam, "", "scrollbars=1,height=700, width=1000"); 
							
		} );
			
		//onChange Searching
		$( "#src_organisasi_kerja" ).change(function() {
			var src_organisasi_kerja = $( "#src_organisasi_kerja" ).val();
			$( "#onSatuankerja" ).hide();
			$( "#onSatuanorganisasi" ).hide();
			$( "#onUnitorganisasi" ).hide();	
			
			if(src_organisasi_kerja){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>laporan/get_satuankerjaduk/",
					data: "src_organisasi_kerja="+ src_organisasi_kerja, 
					success: function(msg){	
						if(msg){
							$( "#onSatuankerja" ).show(); 
							$( "#onSatuankerja" ).html(msg);	
												
						}
						return false;
					}
				});
			}
		});
		
	} );
	
	function satuankerja_onChange(){
		var src_satuan_kerja = $( "#src_satuan_kerja" ).val();
		$( "#onSatuanorganisasi" ).hide();
		$( "#onUnitorganisasi" ).hide();
		if(src_satuan_kerja){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>laporan/get_satuanorganisasiduk/",
				data: "src_satuan_kerja="+ src_satuan_kerja, 
				success: function(msg){	
					if(msg){
						$( "#onSatuanorganisasi" ).show(); 
						$( "#onSatuanorganisasi" ).html(msg);	
					}
					return false;
				}
			});
		}
	}
	function satuanorganisasi_onChange(){
		var src_satuan_organisasi = $( "#src_satuan_organisasi" ).val();
		$( "#onUnitorganisasi" ).hide();
		
		if(src_satuan_organisasi){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>laporan/get_unitorganisasiduk/",
				data: "src_satuan_organisasi="+ src_satuan_organisasi, 
				success: function(msg){	
					if(msg){
						$( "#onUnitorganisasi" ).show(); 
						$( "#onUnitorganisasi" ).html(msg);
						
					}
					return false;
				}
			});
		}
	}

	function printpage(url)
	{
		child = window.open(url, "", "scrollbars=1,height=700, width=1000"); //Open the child in a tiny window.
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
						<li class="active"><a href="<?php echo base_url(); ?>laporan/duk" title="">Daftar Urut Kepangkatan</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Daftar Urut Kepegawaian</h5>
			    	</div>
			    </div>
			     <!-- /page header -->
				 <?php $this->load->view('layout/_actionwrapper'); ?>
				 
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Data Pegawai</h6>
                        </div>
                    </div>
                    <div class="navbar">
                    	<div class="navbar-inner" id="pencarian_duk">							
							<form id="form_search_duk" action="" method = "post">							
								<div class="search2">								
									<table width="100%"><tr valign="top">
									<td width="50%">
										<fieldset class="border">
										<legend class="border">Filter Berdasarkan Organisasi</legend>
										<table width="100%">
											<tr valign="top">
												<td>Organisasi</td>
												<td>:</td>
												<td>
													<select id="src_organisasi_kerja" name="src_organisasi_kerja" class="input-xlarge" />
														<option value=""> </option>
														<?php
															foreach($data_organisasi_kerja as $row){
																echo "<option value='".$row->id_unit_kerja."'>".$row->nama_unit_kerja."</option>";
															}
														?>
													</select>												
												</td>
											</tr>
											<tr valign="top">
												<td>Satuan Kerja</td>
												<td>:</td>
												<td>
													<span id="onSatuankerja">
														<select id="src_satuan_kerja" name="src_satuan_kerja" class="input-xlarge">
															<option value=""  selected="selected" ></option>
														</select>
													</span>
												</td>
											</tr>
											<tr valign="top">
												<td>Satuan Organisasi</td>
												<td>:</td>
												<td>
													<span id="onSatuanorganisasi">
														<select id="src_satuan_organisasi" name="src_satuan_organisasi" class="input-xlarge">
															<option value="" selected="selected" ></option>
														</select>
													</span>
												</td>
											</tr>
											<tr valign="top">
												<td>Unit Organisasi</td>
												<td>:</td>
												<td>
													<span id="onUnitorganisasi">
														<select id="src_unit_organisasi" name="src_unit_organisasi" class="input-xlarge">
															<option value=""  selected="selected" ></option>
														</select>
													</span>
												</td>
											</tr>
										</table>
										</fieldset>
									</td>
									<td width="1%"></td>
									<td width="45%">
										<fieldset class="border">
										<legend class="border">Filter Berdasarkan Jabatan</legend>
											<div class="controls">
												Jabatan 	:																				
													
													<select id="src_jabatan" name="src_jabatan" class="input-small">
														<option value="" > </option>
														<option value="Struktural" >Struktural  </option>
														<option value="Fungsional">Fungsional</option>
													</select>
													&nbsp; &nbsp; &nbsp; 
													<input id="src_struktural" type="text" name="src_struktural" class="input-medium" />
													<select id="src_fungsional" name="src_fungsional" class="input-small">
														<option value="" > </option>
														<option value="Umum" >Umum</option>
														<option value="Tertentu">Tertentu</option>
													</select>
													<br /><br />&nbsp; &nbsp; &nbsp; 
													<input id="src_fungsional_umum" type="hidden" name="src_fungsional_umum" />
													<input id="src_fungsional_tertentu" type="text" name="src_fungsional_tertentu" class="input-large" />
													
											</div>
										</fieldset>
									</td>
									<td width="1%"></td>
									</tr>
								</table>										
								</div>
							</form>
							<button id="search_duk" class="btn btn-primary">Search</button> 
							<button id="reset_duk" class="btn btn-primary">Clear</button> 	
									
                        </div>	
						<div style="float:left;">
							<button id="show_pencarian_duk" class="btn btn-primary">Show Pencarian</button> 
							<button id="hide_pencarian_duk" class="btn btn-primary">Hide Pencarian</button> 
						</div>
						<div style="float:right;">
							<button id="print_duk" class="btn btn-primary">Cetak</button> 	
						</div>
						<div style="clear:both;"></div>
                    </div>	
					
                    <div class="table-overflow">
                        <table id="table-duk" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th rowspan="2">No</th>
                                    <th rowspan="2">Nama / NIP</th>
                                    <th colspan="2"><div style="text-align:center;">Pangkat</div></th>
                                    <th colspan="2"><div style="text-align:center;">Jabatan</div></th>
                                    <th colspan="2"><div style="text-align:center;">Masa Kerja Jabatan</div></th>
									<th rowspan="2">Eselon</th>
									<th rowspan="2">Tmt Cpns</th>
									<th colspan="2">Masa Kerja</th>
                                </tr>
                                <tr>
                                	<th>Gol</th>
									<th>Tmt</th>
									<th>Nama</th>
									<th>Tmt</th>
									<th>Thn</th>
									<th>Bln</th>
									<th>Thn</th>
									<th>Bln</th>
					            </tr>                                
                            </thead>
                            
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
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>