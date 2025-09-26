<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>
	
<script type="text/javascript"> 
 $(function() {
		
	//===== Datatables =====//
	oTable_perbapeljakat = $('table#list-perbapeljakat').dataTable({
		//"iDisplayLength": 25,
		"aaSorting": [[ 0, 'desc']],
		"oLanguage": {
		  "sEmptyTable": "No data yet!"
		},
		
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": false,
		"bSort": false,
		"bInfo": false,
		"bAutoWidth": true,
		"bServerSide": true,
		"bProcessing": true,
		"sAjaxSource": "<?php echo base_url(); ?>bapeljakat/ajax_bapeljakat",
		"fnServerData": function(sSource,aoData,fnCallback)
		{
			$.ajax({
				"dataType": 'json', 
				"type": "POST", 
				"url": sSource, 
				"data": aoData, 
				"success": fnCallback
			});
		}
			
	});
	
});
	
	
function onDeleteBapeljakat(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>bapeljakat/do_delete_bapeljakat",
			data: "id="+id, 
			success: function(msg){	
				if(msg == 'success'){		
					oTable_perbapeljakat.fnDraw();
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
						<li class="active"><a href="#" title="">Baperjakat</a></li>					 
					</ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header 
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Baperjakat</h5>
			    	</div>
			    </div>
			     <!-- /page header -->
				<br />
			    <?php $this->load->view('layout/_actionwrapper'); ?>

				<!-- Media datatable -->
				
				<a href="<?php echo base_url(); ?>bapeljakat/bapeljakat_periode_add" class="btn btn-primary">Add Periode</a>
                <div class="widget">
					<div class="navbar">
						<div class="navbar-inner" style="width:70%">
							<h6>PERIODE BAHAN PERSIDANGAN USUL PENGISIAN JABATAN</h6>
						</div>
					</div>	
                    
                    <div class="table-overflow">
						
						<div class="widget-content">									
						<table id="list-perbapeljakat" width="71%" class="table table-bordered table-striped with-check">
							<thead>
								<tr>
									<th width="50">No</th>
									<th width="150">Periode Awal</th>
									<th width="150">Periode Akhir</th>
									<th width="50">Action</th>
								</tr>
							</thead>									  
						</table>
						</div>
				
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