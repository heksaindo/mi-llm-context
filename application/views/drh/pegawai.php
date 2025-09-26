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
}
 
var oTable_pegawai;

 $(function() {
 
	oTable_pegawai = $('table#table-pegawai').dataTable( {
		"sPaginationType": "full_numbers",
		"sDom": '<"datatable-header"fl>t<"datatable-footer"ip>',
		"oLanguage": {
			"sSearch": "<span>Filter records:</span> _INPUT_",
			"sLengthMenu": "<span>Show entries:</span> _MENU_",
			"oPaginate": { "sFirst": "First", "sLast": "Last", "sNext": ">", "sPrevious": "<" }
		},
		"iDisplayLength": 10,
		"sAjaxSource": "<?php echo base_url(); ?>pegawai/ajax_pegawai",
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
						<li><a href="<?php echo base_url(); ?>administrasipegawai" title="">Administrasi Pegawai</a></li>
						<li class="active"><a href="<?php echo base_url(); ?>pegawai" title="">Daftar Riwayat Hidup Pegawai</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Daftar Riwayat Hidup</h5>
			    	</div>
			    </div>
			     <!-- /page header -->
				 <?php $this->load->view('layout/_actionwrapper'); ?>
				 
				<div>
				<?php if($login_state != 'User') {?>
				 <table width="100%">
					<tr>
						<td style="width:150px;"><a href="<?php echo base_url(); ?>pegawai/add" class="btn btn-primary">Add Data Pegawai</a></td>
						<td>&nbsp;</td>
						<td align="right" style="width:150px;"><!--<a href="<?php echo base_url(); ?>pegawai/cetak_usulan" class="btn btn-primary">Cetak Usulan </a>--></td>
					</tr>
				 </table>
				 <?php } ?>
				 </div>
				
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Data Pegawai</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table  id="table-pegawai" width="100%" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr align="center" valign="center">
									<th width="5" rowspan="2">No</th>
                                    <th width="200" rowspan="2">Nama<br>NIP</th>
                                    <th rowspan="2">Eselon</th>
                                    <th align="center" colspan="2"><div style="text-align:center;">Pangkat</div></th>
                                    <th align="center" colspan="2"><div style="text-align:center;">Jabatan</div></th>
                                    <th align="center" colspan="2"><div style="text-align:center;">Masa Kerja Keseluruhan</div></th>
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