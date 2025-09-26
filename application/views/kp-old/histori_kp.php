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
 
var oTable_kp;

 $(function() {
	var thisYear = date('Y');
	var thisMonth = date('m');
	if(thisMonth < '04' || thisMonth > '10'){
		thisMonth = 'April';
	}else{
		thisMonth = 'Oktober';
	}
		
	$( '#hd_bulan' ).val( thisMonth );
	$( '#table-src_bulan' ).val( thisMonth );
	$( '#hd_tahun' ).val( thisYear );
	$( '#table-src_tahun' ).val( thisYear );
	
	oTable_kp = $('table#table-kp').dataTable( {
		"sPaginationType": "full_numbers",
		"sDom": '<"datatable-header"fl>t<"datatable-footer"ip>',
		"oLanguage": {
			"sSearch": "<span>Filter records:</span> _INPUT_",
			"sLengthMenu": "<span>Show entries:</span> _MENU_",
			"oPaginate": { "sFirst": "First", "sLast": "Last", "sNext": ">", "sPrevious": "<" }
		},
		"iDisplayLength": 10,
		"sAjaxSource": "<?php echo base_url(); ?>kenaikanpangkat/ajax_histori_kp",
		"fnServerData": function ( sSource, aoData, fnCallback ) { 
				//alert($('#table-src_tahun').val());
				//aoData.push({name: "bulan", value: $('#table-src_bulan').val() });
				//aoData.push({name: "tahun", value: $('#table-src_tahun').val() });
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
			oTable_kp.fnReloadAjax("<?php echo base_url(); ?>kenaikanpangkat/ajax_histori_kp" + addParam);	
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
		                <li><a href="<?php echo base_url(); ?>Home">Dashboard</a></li>
						 <li><a href="<?php echo base_url(); ?>administrasipegawai" title="sss" class="tip" rel="tooltip">Administrasi Pegawai</a></li>
						 <li><a href="<?php echo base_url(); ?>kenaikanpangkat" title="">Kenaikan Pangkat</a></li>
						 <li class="active"><a href="" title="">Histori Kenaikan Pangkat</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Histori Kenaikan Pangkat</h5>
			    	</div>
			    </div>
			     <!-- /page header -->

			    <?php $this->load->view('layout/_actionwrapper'); ?>

				<!-- Media datatable -->
                <div class="widget">
					
					<div style="float: right;">
						<a href="<?php echo base_url().'kenaikanpangkat'; ?>"  class="btn btn-primary"><< List Kenaikan Pangkat</a>
					</div>
					<div style="clear: both;"></div>
					
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>List Histori Kenaikan Pangkat</h6>
                        </div>
                    </div>
                    <div class="table-overflow">
						<input type="hidden" id="hd_bulan" name="hd_bulan" />
						<input type="hidden" id="hd_tahun" name="hd_tahun" />
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
									<th width="50" rowspan="2">Action</th>
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

		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->

	</div>
	
	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>
	
</body>
</html>