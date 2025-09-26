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
};

var oTable_pendidikan;
$(function() {
	$( "#dialog-bataspangkat" ).hide();
	
	oTable_pendidikan = $('table#list-bataspangkat').dataTable( {
		"sPaginationType": "full_numbers",
		"sDom": '<"datatable-header"fl>t<"datatable-footer"ip>',
		"oLanguage": {
			"sSearch": "<span>Filter records:</span> _INPUT_",
			"sLengthMenu": "<span>Show entries:</span> _MENU_",
			"oPaginate": { "sFirst": "First", "sLast": "Last", "sNext": ">", "sPrevious": "<" }
		},
		"iDisplayLength": 10,
		"sAjaxSource": "<?php echo base_url(); ?>master_bataspangkat/ajax_pendidikan",
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
	
});
		
function onEdit_bataspangkat(id) {
	open_dialog(id, 'Edit Batas Pangkat');
}

function onDelete_bataspangkat(id) {
	if(confirm('Delete data ?')){		    
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_bataspangkat/do_delete",
			data: {id:id}, 
			success: function(msg){	
				if(msg == 'success'){		
					oTable_pendidikan.fnReloadAjax();
				}else{
					alert( 'Data tidak dapat dihapus!' );	
				}						
			}
		});
	}
}

function open_dialog(id, titlex) {
	$( "#id" ).val(id);
	if(id > 0){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>master_bataspangkat/cek_bataspangkat",
			data: {id:id}, 
			success: function(data){
				var dt = explode('|', data);
				$( "#nama_strata" ).val( dt[0] );
				//$( "#nama_strata2" ).val( dt[1] );
				$( "#golongan_max" ).val( dt[2] );
			}
		});
	}else{
		$( "#nama_strata" ).val('');
		//$( "#nama_strata2" ).val('');
		$( "#golongan_max" ).val('');
	}
	
	$( "#dialog-bataspangkat" ).dialog({
		  autoOpen: false,
		  height: 200,
		  width: 400,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
			  var bValid = true;
				
			  if ( bValid ) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>master_bataspangkat/do_save",
					data: $('#form-bataspangkat').serialize(), 
					success: function(msg){	
						if(msg == 'success'){		
							oTable_pendidikan.fnReloadAjax();
						}else{
							alert( 'Data tidak dapat disimpan, cek input!' );	
						}						
					}
				});
				
				$( this ).dialog( "close" );	
			  }
			},
			"Batal": function() {
			  $( this ).dialog( "close" );
			}
		 },
		  
	}); 
	
	$( "#dialog-bataspangkat" ).dialog( "open" );
}

</script>
</head>
<body>
	<?php $this->load->view('layout/_top');?>
	
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
						 <li><a href="<?php echo base_url(); ?>master_data" title="">Administrasi Master Data</a></li>
						 <li class="active"><a href="<?php echo base_url(); ?>master_bataspangkat" title="">Master Batas Pangkat</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>

			    <?php $this->load->view('layout/_actionwrapper'); ?>
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>Master Batas Pangkat</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table id="list-bataspangkat" class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Strata Pendidikan</th>
									<th>Singkatan Strata</th>
									<th>Golongan Max</th>
                                    <th>Action</th>
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
	
	
<!-- /content Popup -->
<div id="dialog-bataspangkat" title=""> 
	<form id="form-bataspangkat" method="post" action="" >
		<input type="hidden" id="id" name="id" value="" />
		<table>
			<tr>
				<td>Strata Pendidikan</td>
				<td>:</td>
				<td>
					<input id="nama_strata" type="text" name="nama_strata" class="input-xlarge is_required" readOnly/>
				</td>
			</tr>
			<tr>
				<td>Golongan Max</td>
				<td>:</td>
				<td>
					<select id="golongan_max" name="golongan_max" class="input-xlarge">>
						<option>- </option>
						<?php

						$gol_db = $this->db->get("m_golongan");
						
						if($gol_db->num_rows() > 0){
							foreach($gol_db->result() as $row){
								echo "<option value='".$row->kode_golongan."'> ".$row->nama_golongan." - ".$row->kode_golongan."</option>";
							}
						}
					?>
					</select>
				</td>
			</tr>
		</table>	
	</form>
</div>


	<!-- /content container -->
	<?php $this->load->view('layout/_actionwrapper'); ?>
</body>
</html>