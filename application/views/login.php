<?php $this->load->view('template/modal.php'); ?>

<section id="headerSection">
<div id="topmostSection">
	<div class="logo">
		<img style="height: 62px;width: auto;" src="<?php echo base_url(); ?>img/logodinkes.gif" />
		<img style="margin-top: -14px;" src="<?php echo base_url(); ?>img/logo.png" />
	</div>
	<div id="myCarouselTop" class="carousel slide">
	  <div class="carousel-inner">
		<div class="item active"><i class="icon-quote-left"></i> Most people work just hard enough not to get fired and get paid just enough money not to quit.<i class="icon-quote-right"></i>  - George Carlin <a class="close" data-dismiss="alert" href="#"> &times;</a> </div>
	  </div>
	</div>
</div>

<div id="menuSection" style="display: none;">
	<div class="container">
		<div class="navbar">
			<div class="container">
				<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"><img class="pull-left" src="<?php echo base_url();?>css/login/images/logo.png"></span>
				</button>
				<!--<a class="brand" title="Human Resource Information System" href="#home"> &nbsp;<img class="pull-left" src="<?php echo base_url();?>css/login/images/logo.png"></a>-->
				<div class="nav-collapse">
					<ul class="nav pull-right">
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>  
</section>  

<section id="bodySection">
	<div id="carouselSection" >
	<div class="container-fluid">
		<div class="row-fluid">
			<?php if($this->utility->is_login()===false):?>
			<div class="span4">
				<section id="content">
				<form action="signin" method="post" accept-charset="UTF-8">
					<h1 class='h-login'>
						<span class='in-login'>
							<img src="<?php echo base_url().'img/login/login.png';?>" />
							<span class="txt-login">Login</span>
						</span>
					</h1>
					<div>
						<input id="username" type="text" placeholder="Username" name="email_user" required=""/>
					</div>
					<div>
						<input id="password" type="password" placeholder="Password" name="passwordmd5_user" required=""/>
					</div>
					<div>
						<input id="user_remember_me" style="margin-left:10px;float: left; margin-right: 10px;" type="checkbox" name="user[remember_me]" value="1" />
						<label style="width: 140px;" class="string optional" for="user_remember_me"> Remember me</label>
						<input type="submit" name="commit" value="Login" />
					</div>
				</form><!-- form -->
				</section><!-- content -->
			</div>
			<?php else:?>
			<!--<div class="span4">
				<section id="content">
					<h4><?php echo APP_NAME;?></h4>
				</section>
			</div>-->
			<?php endif;?>
			<div class="span8 iconpanel">
				<h1>INFORMASI</h1>
                        <div class="bs-glyphicons">
                            <ul class="bs-glyphicons-list">
								<?php if($this->utility->is_login()):?>
								<li>
									<a href="<?php echo base_url();?>home">
										<span aria-hidden="true" class="glyphicon fa fa-adn"></span>
										<span class="glyphicon-class">Aplikasi</span>
									</a>
								</li>
								<?php endif;?>
								<li><a href="<?php echo base_url();?>info/kgb">
										<span aria-hidden="true" class="glyphicon fa fa-dot-circle-o"></span>
										<span class="glyphicon-class">Kenaikan Gaji Berkala</span>
									</a>
								</li>
								<li><a href="<?php echo base_url();?>info/kp">
									<span aria-hidden="true" class="glyphicon fa fa-angle-double-up"></span>
									<span class="glyphicon-class">Kenaikan Pangkat Pegawai</span>
									</a>
								</li>
								<li><a href="<?php echo base_url();?>info/pensiun">
									<span aria-hidden="true" class="glyphicon fa fa-tag"></span>
									<span class="glyphicon-class">Pensiun Pegawai</span>
									</a>
								</li>
								<li><a href="<?php echo base_url();?>info/cuti">
									<span aria-hidden="true" class="glyphicon fa fa-clock-o"></span>
									<span class="glyphicon-class">Cuti Pegawai</span>
									</a>
								</li>
								<!--<li><a href="<?php echo base_url();?>info/ibel">
									<span aria-hidden="true" class="glyphicon fa fa-ticket"></span>
									<span class="glyphicon-class">Ijin Belajar</span>
									</a>
								</li>-->
							</ul>
						</div>
			</div>
		</div>
	
	<style>
		#bodySection{
			background-image: url(img/login/129.png);
		}
		#topmostSection{
			height: 48px;
		}
		#topmostSection #myCarouselTop{
			float: right;
		}
		form:after {
			content: ".";
			display: block;
			height: 0;
			clear: both;
			visibility: hidden;
		}
		#content{
			width: 90%;
			padding: 2px 0 0;
		}
		.iconpanel{
			padding: 10px;
		}
		<?php if($this->utility->is_login()):?>
		.iconpanel{
			margin: 0px auto !important;
			float: none !important;
			display: inline-block !important;
		}
		<?php endif;?>
		#content,
		.iconpanel{
			background-color: #fff;
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f8f8f8', endColorstr='#f9f9f9',GradientType=0 );
			-webkit-box-shadow: 0 1px 0 #fff inset;
			-moz-box-shadow: 0 1px 0 #fff inset;
			-ms-box-shadow: 0 1px 0 #fff inset;
			-o-box-shadow: 0 1px 0 #fff inset;
			box-shadow: 0 1px 0 #fff inset;
			border: 1px solid #c4c6ca;
			margin: 0 auto;
			position: relative;
			text-align: center;
			text-shadow: 0 1px 0 #fff;
			margin-top:0px;
		}
		.iconpanel h1,
		#content h1 {
			color: #7E7E7E;
			font: bold 25px caption;
			letter-spacing: -0.05em;
			line-height: 20px;
			margin: 10px 0 30px;
		}
		.iconpanel h1:before,
		.iconpanel h1:after,
		#content h1:before,
		#content h1:after,
		#content h2:before,
		#content h2:after,
		#content h3:before,
		#content h3:after,
		#content h4:before,
		#content h4:after{
			content: "";
			height: 1px;
			position: absolute;
			top: 10px;
			width: 27%;
		}
		.iconpanel h1:before,
		.iconpanel h1:after{
			top:26px;
		}
		.iconpanel h1:after,
		#content h1:after,
		#content h2:after,
		#content h3:after,
		#content h4:after{
			background: rgb(126,126,126);
			background: -moz-linear-gradient(left,  rgba(126,126,126,1) 0%, rgba(255,255,255,1) 100%);
			background: -webkit-linear-gradient(left,  rgba(126,126,126,1) 0%,rgba(255,255,255,1) 100%);
			background: -o-linear-gradient(left,  rgba(126,126,126,1) 0%,rgba(255,255,255,1) 100%);
			background: -ms-linear-gradient(left,  rgba(126,126,126,1) 0%,rgba(255,255,255,1) 100%);
			background: linear-gradient(left,  rgba(126,126,126,1) 0%,rgba(255,255,255,1) 100%);
			right: 0;
			top:32px;
		}
		.iconpanel h1:before,
		#content h1:before,
		#content h2:before,
		#content h3:before,
		#content h4:before{
			background: rgb(126,126,126);
			background: -moz-linear-gradient(right,  rgba(126,126,126,1) 0%, rgba(255,255,255,1) 100%);
			background: -webkit-linear-gradient(right,  rgba(126,126,126,1) 0%,rgba(255,255,255,1) 100%);
			background: -o-linear-gradient(right,  rgba(126,126,126,1) 0%,rgba(255,255,255,1) 100%);
			background: -ms-linear-gradient(right,  rgba(126,126,126,1) 0%,rgba(255,255,255,1) 100%);
			background: linear-gradient(right,  rgba(126,126,126,1) 0%,rgba(255,255,255,1) 100%);
			left: 0;
			top:32px;
		}
		#content:after,
		#content:before {
			background: #f9f9f9;
			background: -moz-linear-gradient(top,  rgba(248,248,248,1) 0%, rgba(249,249,249,1) 100%);
			background: -webkit-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
			background: -o-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
			background: -ms-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
			background: linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f8f8f8', endColorstr='#f9f9f9',GradientType=0 );
			border: 1px solid #c4c6ca;
			content: "";
			display: block;
			height: 100%;
			left: -1px;
			/*position: absolute;*/
			width: 100%;
		}
		#content:after {
			-webkit-transform: rotate(2deg);
			-moz-transform: rotate(2deg);
			-ms-transform: rotate(2deg);
			-o-transform: rotate(2deg);
			transform: rotate(2deg);
			top: 0;
			z-index: -1;
		}
		#content:before {
			-webkit-transform: rotate(-3deg);
			-moz-transform: rotate(-3deg);
			-ms-transform: rotate(-3deg);
			-o-transform: rotate(-3deg);
			transform: rotate(-3deg);
			top: 0;
			z-index: -2;
		}
		#content form { margin: 0 20px; position: relative }
		#content form input[type="text"],
		#content form input[type="password"] {
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			-ms-border-radius: 3px;
			-o-border-radius: 3px;
			border-radius: 3px;
			-webkit-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset;
			-moz-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset;
			-ms-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset;
			-o-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset;
			box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset;
			-webkit-transition: all 0.5s ease;
			-moz-transition: all 0.5s ease;
			-ms-transition: all 0.5s ease;
			-o-transition: all 0.5s ease;
			transition: all 0.5s ease;
			background: #eae7e7 url(<?php echo base_url().'images/8bcLQqF.png';?>) no-repeat;
			border: 1px solid #c8c8c8;
			color: #777;
			font: 13px Helvetica, Arial, sans-serif;
			margin: 0 0 10px;
			padding: 15px 10px 15px 40px;
			width: 80%;
		}
		#content form input[type="text"]:focus,
		#content form input[type="password"]:focus {
			-webkit-box-shadow: 0 0 2px #ed1c24 inset;
			-moz-box-shadow: 0 0 2px #ed1c24 inset;
			-ms-box-shadow: 0 0 2px #ed1c24 inset;
			-o-box-shadow: 0 0 2px #ed1c24 inset;
			box-shadow: 0 0 2px #ed1c24 inset;
			background-color: #fff;
			border: 1px solid #ed1c24;
			outline: none;
		}
		#username { background-position: 10px 10px !important }
		#password { background-position: 10px -53px !important }
		#content form input[type="submit"] {
			background: rgb(254,231,154);
			background: -moz-linear-gradient(top,  rgba(254,231,154,1) 0%, rgba(254,193,81,1) 100%);
			background: -webkit-linear-gradient(top,  rgba(254,231,154,1) 0%,rgba(254,193,81,1) 100%);
			background: -o-linear-gradient(top,  rgba(254,231,154,1) 0%,rgba(254,193,81,1) 100%);
			background: -ms-linear-gradient(top,  rgba(254,231,154,1) 0%,rgba(254,193,81,1) 100%);
			background: linear-gradient(top,  rgba(254,231,154,1) 0%,rgba(254,193,81,1) 100%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fee79a', endColorstr='#fec151',GradientType=0 );
			-webkit-border-radius: 30px;
			-moz-border-radius: 30px;
			-ms-border-radius: 30px;
			-o-border-radius: 30px;
			border-radius: 30px;
			-webkit-box-shadow: 0 1px 0 rgba(255,255,255,0.8) inset;
			-moz-box-shadow: 0 1px 0 rgba(255,255,255,0.8) inset;
			-ms-box-shadow: 0 1px 0 rgba(255,255,255,0.8) inset;
			-o-box-shadow: 0 1px 0 rgba(255,255,255,0.8) inset;
			box-shadow: 0 1px 0 rgba(255,255,255,0.8) inset;
			border: 1px solid #D69E31;
			color: #85592e;
			cursor: pointer;
			float: right;
			font: bold 15px Helvetica, Arial, sans-serif;
			height: 35px;
			margin: 10px 12px 25px 0px;
			position: relative;
			text-shadow: 0 1px 0 rgba(255,255,255,0.5);
			width: 120px;
		}
		#content form input[type="submit"]:hover {
			background: rgb(254,193,81);
			background: -moz-linear-gradient(top,  rgba(254,193,81,1) 0%, rgba(254,231,154,1) 100%);
			background: -webkit-linear-gradient(top,  rgba(254,193,81,1) 0%,rgba(254,231,154,1) 100%);
			background: -o-linear-gradient(top,  rgba(254,193,81,1) 0%,rgba(254,231,154,1) 100%);
			background: -ms-linear-gradient(top,  rgba(254,193,81,1) 0%,rgba(254,231,154,1) 100%);
			background: linear-gradient(top,  rgba(254,193,81,1) 0%,rgba(254,231,154,1) 100%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fec151', endColorstr='#fee79a',GradientType=0 );
		}
		#content form div a {
			color: #004a80;
			float: right;
			font-size: 12px;
			margin: 30px 15px 0 0;
			text-decoration: underline;
		}
		ul{
			margin: 0px 0px;
		}
		.bs-glyphicons-list{
			list-style:none;
			margin: 0px auto !important;
			display: table;
		}
		.bs-glyphicons li{
			font-size: 12px;
			width: 105px;
			background-color: #f9f9f9;
			border: 1px solid #EAE7E7;
			border-radius: 2px;
			font-size: 10px;
			height: 115px;
			line-height: 1.4;
			padding: 10px;
			text-align: center;
			float: left;
			margin: 0px 5px 5px 5px;
			display: inline;
		}
		.bs-glyphicons li a{
			position: relative;
			display: block;
			height: 100%;
			width: 100%;
		}
		
		.bs-glyphicons li:hover{
			background-color: #EAE7E7;
			border-color: #f9f9f9;
		}
		.bs-glyphicons .glyphicon{
			font-size: 40px;
			margin-bottom: 10px;
			margin-top: 15px;
			color: #53BFE2;
		}
		.bs-glyphicons .glyphicon-class{
			display: block;
			text-align: center;
			word-wrap: break-word;
			color: #333;
			font-size: 15px;
		}
		.bs-glyphicons li a:hover,
		.bs-glyphicons .glyphicon:hover,
		.bs-glyphicons .glyphicon-class:hover{
			text-decoration:none;
		}
		.h-login > span{
			margin: 0px auto;
			display: inline-block;
		}
		.h-login > span > img{
			vertical-align: baseline;
		}
		.in-login{
			height: 48px;
			font-size: 25px;
			font-family: caption;
			text-align: center;
		}
		.txt-login{
			margin-top: -5px;
			position: relative;
			top:-10px;
		}
	</style>
	</div>
	</div>
</section>
<a href="#" class="go-top" style="display: none;"><i class="icon-double-angle-up"></i></a>
<link href="<?php base_url();?>portal/css/font-awesome.min.css" rel="stylesheet">