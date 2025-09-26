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
 
var oTable_pegawai;

 $(function() {
	$('table#table-rekap').hide();
	
	oTable_pegawai = $('table#table-rekap').dataTable( {
		"sPaginationType": "full_numbers",
		"sDom": '<"datatable-header"fl>t<"datatable-footer"ip>',
		"oLanguage": {
			"sSearch": "<span>Filter records:</span> _INPUT_",
			"sLengthMenu": "<span>Show entries:</span> _MENU_",
			"oPaginate": { "sFirst": "First", "sLast": "Last", "sNext": ">", "sPrevious": "<" }
		},
		"iDisplayLength": 10,
		"sAjaxSource": "<?php echo base_url(); ?>pegawai/do_rekap_report",
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
	
});

</script>
<script type="text/javascript"> 	

	$(document).ready(function(){
		//full view
		$("body").toggleClass("clean");
		$('#sidebar').toggleClass("hide-sidebar mobile-sidebar");
		$('#content').toggleClass("full-content");
		
		$('#kriteria2').hide();
		//onChange Kriteria
		$( "#src_kriteria" ).change(function() {
			var src_kriteria = $( "#src_kriteria" ).val();
			if(src_kriteria){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>pegawai/change_src_kriteria",
					data: "src_kriteria="+ src_kriteria, 
					success: function(msg){	
						if(msg){
							$( "#onKriteria" ).html(msg);
						}
						return false;
					}
				});
			}
		});	
		
		//Wizard 1  src_kriteria, src_pendidikan, src_data_riwayat, src_data_tampil
		$( "#save_rekap" ).click(function(){
			var err = 0;
			var src_kriteria = $( "#src_kriteria" ).val(); 
			
			if(src_kriteria == ''){
				$( "#src_kriteria" ).addClass("invalid");
				err = 1;
			}		
			
			//alert(err);
			if(err == 0){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>pegawai/do_rekap_report",
					data: $('#form-wizard1').serialize(), 
					success: function(msg){	
						var xdata = explode('#', msg);
						//alert(msg);
						if(xdata[0] == 'success'){					
							
						}else{
							
						}
						return false;
					}
				});
			}
		});
		
		
	});
				
</script>

</head>
<body>
	<?php $this->load->view('layout/_top'); ?>
	
	<!-- Content container -->
	<div id="container">
		
		<?php //$this->load->view('layout/_sidebar'); ?>
		
		<!-- Content -->
		<div id="content">

		    <!-- Content wrapper -->
		    <div class="wrapper">

			    <!-- Breadcrumbs line -->
			    <div class="crumbs">
		            <ul id="breadcrumbs" class="breadcrumb"> 
		                <li><a href="<?php echo base_url(); ?>Home">Dashboard</a></li>
						 <li><a href="<?php echo base_url(); ?>administrasipegawai" title="">Administrasi Pegawai</a></li>
						 <li class="active"><a href="<?php echo base_url(); ?>pegawai/rekap" title="">Rekap Pegawai</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<br>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
                            
				
				 <div class="widget">
					 <div class="navbar">
						<div class="navbar-inner">
							<h6>Rekap Data Pegawai</h6>
						</div>
					</div>
					<form id="form-wizard" class="form-horizontal row-fluid well" method="post" >
						<div id="form-wizard1" class="step">
							<div class="control-group">
								<label class="control-label">Kriteria Data</label>
								<div class="controls ">
									<select id="src_kriteria" name="src_kriteria">
										<option value="">-Pilih-</option>
										<option value="nama">Nama Pegawai</option>
										<option value="status">Status Pegawai</option>
										<option value="jabatan">Jabatan</option>
										<option value="umur">Group Umur</option>
										<option value="unit_kerja">Unit Kerja</option>
										<option value="jenis_kelamin">Jenis Kelamin</option>
										<option value="pendidikan">Tingkat Pendidikan</option>
										<option value="pangkat">Kepangkatan</option>
									</select>
								</div>
								
							</div>
							<div class="control-group">
								<label class="control-label">Sub Kriteria Data</label>
								<div id="onKriteria" class="controls ">
									
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Data Yang Akan Ditampilkan</label>
								<div class="controls ">
									<select id="src_data_riwayat" name="src_data_riwayat">
										<option>Data Pribadi</option>
										<option>Data Keluarga</option>
										<option>Data Pendidikan</option>
										<option>Tempat Kerja Sekarang</option>
										<option>Riwayat Kepangkatan</option>
										<option>Riwayat Jabatan</option>
										<option>Riwayat Kinerja</option>
										<option>Riwayat Kompetensi</option>
									</select>
								</div>
							</div>                                    
							<div class="control-group">
								<label class="control-label">Sub Data Yang Akan Ditampilkan</label>
								<div class="controls">
									<select multiple id="src_data_tampil" name="src_data_tampil">
										<option>Tingkat Pendidikan</option>
										<option selected>Tahun</option>
										<option>Nama Sekolah</option>
									</select>
								</div>
							</div>
						</div>
						
					</form>
					<div class="form-actions">
						<button id="save_rekap" class="btn btn-primary" text="Add" type="show">Save</button>
					</div>
					
					
                    <div class="table-overflow">
						
						<div class="widget-content">									
							<table  id="table-rekap" width="100%" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr align="center" valign="center">
									<th width="5" rowspan="2">No</th>
                                    <th width="200" rowspan="2">Nama<br>NIP</th>
                                    <th rowspan="2">Eselon</th>
                                    <th align="center" colspan="2"><div style="text-align:center;">Pangkat</div></th>
                                    <th align="center" colspan="2"><div style="text-align:center;">Jabatan</div></th>
                                    <th align="center" colspan="2"><div style="text-align:center;">Masa Kerja</div></th>
                                    <th colspan="3"><div style="text-align:center;">Pendidikan</div></th>
                                    <!--<th rowspan="2">Action</th>-->
                                </tr>
								<tr>
									<th>Gol.</th>
									<th>TMT</th>
									<th>Nama</th>
									<th>TMT</th>
									<th>Thn</th>
									<th>Bln</th>
									<th>Nama</th>
									<th>Lulus</th>
									<th width="5" >Ijazah</th>
								</tr>
                            </thead>
							
                        </table>
						</div>
				
                    </div>
                
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