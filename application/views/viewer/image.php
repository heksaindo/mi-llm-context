<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head -->
<head>
	<?php $this->load->view('layout/_head2'); ?>
    <link rel="stylesheet" media="screen, projection" href="<?php echo base_url().'css/drift-basic.min.css';?>">
    <style type="text/css">
        .gambar{
            position: relative;
            display: block;
            margin-top:20px;
        }
        .widget{
            width: 50%;
            float: left;
        }
        
        .detail {
            position: relative;
            display: block;
            width: 45%;
            float: left;
        }
    </style>
    <script type="text/javascript" src="<?php echo base_url().'js/Drift.min.js';?>"></script>
    <script>
        $(document).ready(function(){
            var height = $( document ).height();//$('#content').height();
            var dh = (height / 1.5);
            $('.gambar').height(height/2);
            $('.drift-demo-trigger').height(height/2);
            $('.detail').height(dh);
			$("body").toggleClass("clean");
			$('#sidebar').toggleClass("hide-sidebar mobile-sidebar");
			$('#content').toggleClass("full-content");
        });
    </script>
</head>
<body>
	<!-- Content container -->
	<div id="container">
			
		<!-- Content -->
		<div id="content">

		    <!-- Content wrapper -->
		    <div class="wrapper">

			    <!-- Breadcrumbs line -->
			    <div class="crumbs">
		            <ul id="breadcrumbs" class="breadcrumb"> 
						<li class="active"><a href="<?php echo base_url().'viewer/'.$id;?>" title="">Dokumen Viewer</a></li>
		            </ul>
					
			    </div>
			    <!-- /breadcrumbs line -->

			     <!-- /page header -->
				 
				
				<!-- Media datatable -->
                <div class="gambar">
                <div class="widget">
                    <img class="drift-demo-trigger" data-zoom="<?php echo base_url().'/Uploads/dokumen/'.$file->filename;?>?w=100&amp;ch=DPR&amp;dpr=2" src="<?php echo base_url().'/Uploads/dokumen/'.$file->filename;?>?w=800&amp;ch=DPR&amp;dpr=2">
                </div>
                <!-- /media datatable -->
                <div class="detail"></div>
                </div>
		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->
		
	</div>
    <script>
      new Drift(document.querySelector('.drift-demo-trigger'), {
        paneContainer: document.querySelector('.detail'),
        inlinePane: 900,
        inlineOffsetY: -85,
        containInline: true
      });
    </script>
	<!-- /content container -->
	<?php $this->load->view('layout/_footer'); ?>
</body>
</html>