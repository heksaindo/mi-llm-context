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
 
var oTable_kgp;

 $(function() {
 
	oTable_kgp = $('table#table-kgp').dataTable( {
		"sPaginationType": "full_numbers",
		"sDom": '<"datatable-header"fl>t<"datatable-footer"ip>',
		"oLanguage": {
			"sSearch": "<span>Filter records:</span> _INPUT_",
			"sLengthMenu": "<span>Show entries:</span> _MENU_",
			"oPaginate": { "sFirst": "First", "sLast": "Last", "sNext": ">", "sPrevious": "<" }
		},
		"iDisplayLength": 10,
		"sAjaxSource": "<?php echo base_url(); ?>kenaikangajipegawai/ajax_kgp",
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
						 <li class="active"><a href="<?php echo base_url(); ?>kenaikangajipegawai" title="">Kenaikan Gaji Berkala</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Kenaikan Gaji Berkala</h5>
			    	</div>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
				
				
				<!-- Media datatable -->
                <div class="widget">
					<?php if($menumode=='administrasipegawai') :?>
					<div style="float: left;">
						<a href="<?php echo base_url(); ?>kenaikangajipegawai/add_kgp_pilihan" class="btn btn-primary">Add KGP Pilihan</a>
					</div>
					<?php endif;?>
					<!--<div style="float: right;">
						<a href="<?php echo base_url().'kenaikangajipegawai/list_histori_kgp'; ?>"  class="btn btn-primary">List Histori KGP >></a>
					</div>-->
					<div style="clear: both;"></div>
					
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Kenaikan Gaji Pegawai</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="table-kgp" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Nama /NIP</th>
                                    <th>Jabatan</th>
                                    <th>Pangkat</th>
                                    <th>Golongan</th>
                                    <th>Masa Kerja Golongan</th>
                                    <th>Gaji Terakhir</th>
                                    <th>No SK Terakhir</th>
                                    <th>Tgl SK Terakhir</th>
                                    <th>Penandatangan SK Terakhir</th>
                                    <th width="60">Action</th>
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