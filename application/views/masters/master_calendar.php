<!DOCTYPE html>
<html>
<!-- Head -->
<head>
<?php $this->load->view('layout/_head2'); ?>
<link href="<?php echo base_url(); ?>css/cupertino/jquery-ui.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>css/fullcalendar.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>css/fullcalendar.print.css" rel="stylesheet" type="text/css" media="print" />
<script src="<?php echo base_url(); ?>js/jquery-ui.custom.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/fullcalendar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/locale-all.js" type="text/javascript"></script>
<script>
    $("#dialog-libsama").hide();
    function add_dialog_libsama(date,title){
        var tgl = moment(date,"YYYY-MM-DD","id",true).format('DD-MM-YYYY');
        var tglsplit = tgl.split("-");
        var titlex = 'Tambah Libur Bersama '+tgl;
        if(title){
            titlex = title+' '+tgl;
        }
        $("#lb_akhir").val('');
        $("#lb_date").val(tgl);
        $("#lb_thn").val(tglsplit[2]);
        $("#lb_bln").val(tglsplit[1]);
        $("#lb_day").val(tglsplit[0]);
        $( "#dialog-libsama" ).dialog({
		  autoOpen: true,
		  height: 250,
		  width: 450,
		  modal: true,
		  title: titlex,
		  buttons: {
			"Simpan": function() {
                var bValid = true;
                if($("#lb_title").val() === ''){
                    bValid = false;
                    $("#lb_date").addClass("invalid");
                }
                if ( bValid ) {
                    
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>master_calendar/do_save",
                        data: $('#form-libsama').serialize(), 
                        success: function(msg){	
                            datax = explode('#', msg);
                            if(datax[0] == 'success'){		
                              $( "#dialog-libsama" ).dialog( "close" );	
                            }else{
                                alert(datax[1]);	
                            }						
                        }
                    });
                }
            },
            "Batal": function() {
			  $( this ).dialog( "close" );
			}
          }
        });
        
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
						 <li class="active"><a title="">Master Cuti</a></li>
		            </ul>
					<?php $this->load->view('layout/_messages'); ?>
			    </div>

			    <?php $this->load->view('layout/_actionwrapper'); ?>			
				<div style="height: 20px;display: block;"></div>
				<!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>Master Kalender</h6>
                        </div>
                    </div>
                    
                    <div id="tabcal">
                        <ul>
                            <li><a href="#cuti1"><span>Libur Bersama</span></a></li>
                            <li><a href="#libnas"><span>Libur Nasional</span></a></li>
                        </ul>
                        <div id="cuti1">
                            <p>Libur Bersama:</p>
                            <pre><code><div id='libbersama-calendar'></div></code></pre>
                        </div>
                        <div id="libnas">
                            <p>Libnas</p>
                            <pre><code>$( "#tabs" ).tabs(); </code></pre>
                        </div>
                    </div>
                </div>

				
		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		
	</div>
	<!-- /content container -->
    <script>
    $( "#tabcal" ).tabs();
	$(document).ready(function() {
        var DELAY = 700, clicks = 0, timer = null;
		$('#libbersama-calendar').fullCalendar({
            locale: 'id',
			theme:true,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
            views: {
                month: { // name of view
                    // other view-specific options here
                }
            },
            dayClick: function(date, jsEvent, view) {
                clicks++;
                if(clicks === 1) {
                    timer = setTimeout(function() {
                        clicks = 0;
                    }, DELAY);
                }else {
                    clearTimeout(timer);
                    add_dialog_libsama(date.format()); 
                    clicks = 0;
                }
            },
            eventClick: function(calEvent, jsEvent, view) {
                alert('Event: ' + calEvent.title);
                $(this).css('border-color', 'red');
            },
			defaultDate: '<?=$this->utility->dateNow();?>',
			editable: true,
			eventLimit: true,
			events: {
				url: '<?php echo base_url();?>master_calendar/getbersama',				
			},
			loading: function(bool) {
				//$('#loading').toggle(bool);
			}
		});
        
        $("#lb_akhir").datepicker({
            altFormat: 'dd-mm-yy',
            dateFormat: "dd-mm-yy",
            onSelect: function(dateText, inst) {
                var d1 = $(this).val();
                var d2 = $("#lb_date").val();
                var date = moment(d1,"DD-MM-YYYY").format('YYYY-MM-DD');
                var date2 = moment(d2,"DD-MM-YYYY").format('YYYY-MM-DD');
                if(moment(date2).isAfter(date)){
                    alert('Tanggal akhir harus lebih besar atau sama dengan '+d2);
                    $("#lb_akhir").val('');
                }
            }
        });
	});
    </script>
    <!-- /content Popup -->
    <div id="dialog-libsama" title=""> 
        <form id="form-libsama" method="post" action="" >
            <input type="hidden" id="lb_thn" name="tahun" value="" />
            <input type="hidden" id="lb_bln" name="bulan" value="" />
            <input type="hidden" id="lb_day" name="tgl" value="" />
            <table>
                <tr>
                    <td>Nama Libur Bersama</td>
                    <td>:</td>
                    <td>
                        <input id="lb_title" type="text" name="lb_title" class="input-xlarge is_required" />
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Mulai</td>
                    <td>:</td>
                    <td>
                        <input id="lb_date" type="text" name="lb_date" class="input-small is_required" readonly/>
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Akhir</td>
                    <td>:</td>
                    <td>
                        <input id="lb_akhir" type="text" name="lb_akhir" class="input-small"/> * ( Kosongkan jika satu hari)
                    </td>
                </tr>
            </table>	
        </form>
    </div>
	<?php $this->load->view('layout/_actionwrapper'); ?>
</body>
</html>