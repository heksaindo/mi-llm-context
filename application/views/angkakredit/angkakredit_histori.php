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
 
var oTable_ak_history;

 $(function() {
 
	oTable_ak_history = $('table#table-ak-history').dataTable( {
		"sPaginationType": "full_numbers",
		"sDom": '<"datatable-header"fl>t<"datatable-footer"ip>',
		"oLanguage": {
			"sSearch": "<span>Filter records:</span> _INPUT_",
			"sLengthMenu": "<span>Show entries:</span> _MENU_",
			"oPaginate": { "sFirst": "First", "sLast": "Last", "sNext": ">", "sPrevious": "<" }
		},
		"iDisplayLength": 10,
		"sAjaxSource": "<?php echo base_url(); ?>angkakredit/ajax_ak_histori",
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
	
	
function onDelete_AK(id, title) {
	if(confirm('Delete data '+title+'?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>angkakredit/do_delete_angkakredit",
			data: "id="+id, 
			success: function(msg){	
				if(msg == 'success'){		
					oTable_ak_history.fnReloadAjax();
				}else{
					alert( 'Data tidak dapat dihapus!' );	
				}						
			}
		});
	}
}
</script>
<style>
.content-add {
	margin: 5px; 0px 5px 0px;
}
</style>

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
						<li class="active"><a href="#" title="">Histori Angka Kredit</a></li>					 
					</ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Histori Angka Kredit</h5>
			    	</div>
			    </div>
			     <!-- /page header -->
				<br />
			    <?php $this->load->view('layout/_actionwrapper'); ?>

				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List <?php echo $title; ?></h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="table-ak-history" class="table table-striped table-bordered table-checks media-table">
                            <thead>
								<tr>
									<th width="5">No</th>
                                    <th width="200">Nama / NIP</th>
                                    <th><div style="text-align:center;">Status</div></th>
                                    <th><div style="text-align:center;">Pangkat<br/>Gol.Ruang (TMT)</div></th>                                    
                                    <th><div style="text-align:center;">Jabatan (TMT)</div></th>
									<th><div style="text-align:center;">Rencana<br/>Pangkat</div></th>
                                    <th><div style="text-align:center;">Rencana<br/>Jabatan</div></th>
                                    <th><div style="text-align:center;">No.PAK <br/>Tanggal PAK</div></th>
                                    <th><div style="text-align:center;">Action</div></th>
                                </tr>
                            </thead>
                            
                        </table>
                    </div>
                </div>
                <!-- /media datatable -->
				
				<br />	 
		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		
	</div>
	<!-- /content container -->
	
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>