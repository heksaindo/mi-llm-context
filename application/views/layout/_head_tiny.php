<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title><?php echo APP_NAME;?> | <?php echo $title; ?></title>
	<link type="image/x-icon" href="<?php echo base_url();?>img/fav/favicon.ico" rel="shortcut icon">
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url();?>img/fav/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url();?>img/fav/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url();?>img/fav/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url();?>img/fav/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url();?>img/fav/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url();?>img/fav/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url();?>img/fav/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url();?>img/fav/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url();?>img/fav/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url();?>img/fav/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url();?>img/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url();?>img/fav/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>img/fav/favicon-16x16.png">
	<link rel="manifest" href="<?php echo base_url();?>img/fav/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php echo base_url();?>img/fav/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
<link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet" type="text/css" />
<!--[if IE 8]><link href="css/ie8.css" rel="stylesheet" type="text/css" /><![endif]-->
<link href='<?php echo base_url(); ?>css/font.css' rel='stylesheet' type='text/css'/>
<link href='<?php echo base_url(); ?>js/formvalidator/form.css' rel='stylesheet' type='text/css'/>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.selectBoxIt.css" />

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/php.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ajaxfileupload.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/formvalidator/form.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.easytabs.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/prettify.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/files/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.selectBoxIt.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/autocomplete/jquery.autocomplete.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/tiny_mce/jquery.tinymce.js"></script>
	
<script type="text/javascript">
	$(document).ready(function(){
		//===== Hide/show sidebar =====//

		$('.fullview').click(function(){
			$("body").toggleClass("clean");
			$('#sidebar').toggleClass("hide-sidebar mobile-sidebar");
			$('#content').toggleClass("full-content");
		});

		//===== Hide/show action tabs =====//
		$('.actions-wrapper').hide()
		$('.showmenu').click(function () {
			$('.actions-wrapper').slideToggle(100);
		});
	
		//===== Collapsible plugin for main nav =====//
	
		$('.expand').collapsible({
			defaultOpen: 'current,third',
			cookieName: 'navAct',
			cssOpen: 'subOpened',
			cssClose: 'subClosed',
			speed: 200
		});

		$( ".datepicker" ).datepicker({ 
			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			changeYear: true,
			yearRange: "-90:+0"
		});
		
		//===== Easy tabs =====//
	
		$('.sidebar-tabs').easytabs({
			animationSpeed: 150,
			collapsible: false,
			tabActiveClass: "active"
		});

		$('.actions').easytabs({
			animationSpeed: 300,
			collapsible: false,
			tabActiveClass: "current"
		});
		
		//===== Form elements styling =====//
		
		$(".ui-datepicker-month, .styled, .dataTables_length select").uniform({ radioClass: 'choice' });
		
		$('textarea.tinymce').tinymce({
		//$('textarea').not('.no-editor').tinymce({
			// Location of TinyMCE script
			script_url : '<?php echo base_url(); ?>js/tiny_mce/tiny_mce.js',

			// General options
			//theme : "advanced",
			theme : "simple",
			//plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

			// Theme options
			theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
			//theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
			//theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
			content_css : "<?php echo base_url(); ?>css/bootstrap.css",

			// Drop lists for link/image/media/template dialogs
			//template_external_list_url : "lists/template_list.js",
			//external_link_list_url : "lists/link_list.js",
			//external_image_list_url : "lists/image_list.js",
			//media_external_list_url : "lists/media_list.js",

		});
		
	});
</script>