<section class="main"> 
    <div class="container">
        <div class="container-fluid">
        <?php if($halaman):?>
        <?php if(file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR.'content'.DIRECTORY_SEPARATOR.$halaman.'.php')):?>
        <?php if($header):?>
        <div class="main-head">
            <h1><?php echo $header;?></h1>
        </div>
        <?php endif;?>
        <div class="main-body">
            <?php $this->load->view('info/content/'.$halaman);?>
        </div>
        <?php else:?>
            <?php $this->load->view('info/404');?>
        <?php endif;?>
        <?php endif;?>
        </div>
    </div>
</section>