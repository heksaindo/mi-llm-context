<?php

class My_Controller extends CI_Controller
{
	var $user = FALSE;
	var $client = FALSE;
	var $core_settings = FALSE;
	
	protected $view_data = array();

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
		$this->load->helper(array('url'));
        $this->lockdown('users/login');
		$this->load->vars('appname', APP_NAME);
    }
    
    public function lockdown($exception) {
    
       
        if($this->session->userdata('loginme') != 'qwerty-0981728392' && $this->session->userdata('nip') == '') {
            redirect('login');
        }
    }
	
}
