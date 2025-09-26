<nav id="colorNav" class="navbar navbar-default navbar-fixed-top">
              <div class="container-fluid">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <div class="navbar-brand">
                       <a href="<?php echo base_url(); ?>">
		<img style="height: 62px;width: auto;" src="<?php echo base_url(); ?>img/logodinkes.gif" />
                       </a>
                       <a class="brand" href="#">
                            <small class="brand-name"><?php echo $brand;?> - <?php echo HEADER_CV;?></small>
                       </a>
                  </div>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                  <ul class="nav navbar-nav navbar-right">
                    <li class="orange"><a href="<?php echo base_url();?>">&nbsp;&nbsp;<i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;</a></li>
                    <li class="red dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user-md"></i> Kepegawaian <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo base_url();?>info/kgb"><i class="fa fa-info-circle"></i> KGB</a></li>
                            <li><a href="<?php echo base_url();?>info/kp"><i class="fa fa-info-circle"></i> KP</a></li>
                            <li><a href="<?php echo base_url();?>info/pensiun"><i class="fa fa-info-circle"></i> Pensiun</a></li>
                            </ul>
                    </li>
                    <li class="purple dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-clock-o"></i> Kehadiran <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo base_url();?>info/cuti"><i class="fa fa-info-circle"></i> Cuti</a></li>
                            </ul>
                    </li>
                    <li class="green dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-leanpub"></i> Pendidikan <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo base_url();?>info/ibel"><i class="fa fa-info-circle"></i> Ibel</a></li>
                            </ul>
                    </li>
                  </ul>
                </div>
                <!--/.nav-collapse -->
              </div>
              <!--/.container-fluid -->
        </nav>