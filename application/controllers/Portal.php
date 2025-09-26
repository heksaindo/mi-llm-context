<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Portal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
    }
    
    public function index()
	{	
		$this->data['title'] = '';
        $this->load->view('portal/index', $this->data);
    }
    
    
}