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
		"sAjaxSource": "<?php echo base_url(); ?>pensiun/ajax_histori_pensiun",
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

	$('#btn_cetak_pensiun').click( function() {
		var sData = $('input', oTable_pensiun.fnGetNodes()).serialize();
		//alert(sData);
		var checked =  '#';
		var rowcollection =  oTable_pensiun.$(".call-checkbox:checked", {"page": "all"});
		rowcollection.each(function(index,elem){
			var checkbox_value = $(elem).val();
			//Do something with 'checkbox_value'
			checked = checked+'_'+checkbox_value;
		});
		
		checked = str_replace('#_', '', checked);
		
		var url = '<?php echo base_url()?>pensiun/cetak_multi/'+checked; 
		child = window.open(url, "", "scrollbars=1,height=800, width=600");
		return false;
	} );
	
	$('#btn_cetak_lampiran').click( function() {
		var sData = $('input', oTable_pensiun.fnGetNodes()).serialize();
		//alert(sData);
		var checked =  '#';
		var rowcollection =  oTable_pensiun.$(".call-checkbox:checked", {"page": "all"});
		rowcollection.each(function(index,elem){
			var checkbox_value = $(elem).val();
			//Do something with 'checkbox_value'
			checked = checked+'_'+checkbox_value;
		});
		
		checked = str_replace('#_', '', checked);
		
		var url = '<?php echo base_url()?>pensiun/cetak_lampiran/'+checked; 
		child = window.open(url, "", "scrollbars=1,height=600, width=850");
		return false;
	} );
	
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
						 <li><a href="<?php echo base_url(); ?>laporan/pensiun" title="">Rekap Pensiun</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Rekap Pensiun</h5>
			    	</div>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>

				<!-- Media datatable -->
                <div class="widget">
					<div style="clear: both;"></div>
					
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Histori Pensiun</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
						
							<div style="text-align:right;">
								<button id="btn_cetak_pensiun" class="btn"><i class="fam-printer "></i> Print Kumulatif</button>
								<button id="btn_cetak_lampiran" class="btn"><i class="fam-printer "></i> Print Lampiran</button>
							</div>
							
							<table id="table-pensiun" width="100%" class="table table-striped table-bordered table-checks media-table">
								<thead>
									<tr>
										<th width="20" rowspan="2">No</th>
										<th width="200" rowspan="2">Nama / NIP</th>
										<th width="160" rowspan="2">Jabatan</th>
										<th width="80" rowspan="2">Usia</th>
										<th width="80" rowspan="2">TMT Pensiun</th>
										<th width="23%" colspan="6"><div style="text-align:center;">Status</div></th>
										<th width="50" rowspan="2">Action</th>
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

				
		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		
	</div>
	
	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>
	
</body>
</html>