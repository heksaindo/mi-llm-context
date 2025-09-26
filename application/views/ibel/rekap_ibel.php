<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head_tiny'); ?>
<script type="text/javascript">

$(document).ready(function(){
     
var oTable_ibel;

oTable_ibel = $('table#table-ibel').dataTable({
        "sPaginationType": "full_numbers",
		"sDom": '<"datatable-header"fl>t<"datatable-footer"ip>',
		"oLanguage": {
			"sSearch": "<span>Filter records:</span> _INPUT_",
			"sLengthMenu": "<span>Show entries:</span> _MENU_",
			"oPaginate": { "sFirst": "First", "sLast": "Last", "sNext": ">", "sPrevious": "<" }
		},
		"iDisplayLength": 10,
		"sAjaxSource": "<?php echo base_url(); ?>laporan/ajax_ibel",
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

	printRekap = function(id){
		if(!id){
			alert("Group Error Print!");
		}else{
			$( "#win-rekap" ).load("<?php echo base_url(); ?>ibel/data_print_rekap/"+id)
					.dialog({
					autoOpen: false,
					height: 500,
					width: 850,
					modal: true,
					closeText: "hide",
					title: 'Print Preview '+id,
					buttons: {				
						"Cetak": function() {
							w=window.open("","", "scrollbars=1,height=600, width=1000");
							w.document.write('<html><head><title>Rekap Ibel Group '+id+'</title>');
							w.document.write('<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css" type="text/css"  media="print" />');
							w.document.write('<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css" type="text/css"  media="print" />');
							w.document.write("<style>#printrekap_{font-size: inherit !important;font-family: 'Arial','sans-serif';}</style>");
							w.document.write('<body id="printrekap_">');
							w.document.write($('#win-rekap').html());
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
				$("#win-rekap").dialog( "open" );
				
				return false;
			}
	};
	
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
						<li class="active"><a href="<?php echo base_url(); ?>laporan/ibel" title="">Rekap Izin Belajar</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Izin Belajar</h5>
			    	</div>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>
				
				
				<!-- Media datatable -->
                <div class="widget">

                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>Rekap Izin Belajar</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="table-ibel" width="100%" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th width="20">No</th>
                                    <th width="210">No. Surat Pengantar</th>
                                    <th width="210">No. SK</th>
									<th width="20">Action</th>
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
	<div id="win-rekap"></div>
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>