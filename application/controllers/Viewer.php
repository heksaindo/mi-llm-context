<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Viewer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
        $this->data['menumode'] = 'viewer';
        $this->load->model('Dokumen_model', 'mDok');
        $username = $this->session->userdata('username');
		$previlege = $this->session->userdata('login_state');
		$this->data['privilege'] =  $this->session->userdata('login_state');
    }
    
    function _remap($function,$params=array())
    {

        if (preg_match("/^-?[1-9][0-9]*$/D", $function)) {
            $this->index($function);
        }else{
            if (method_exists($this, $function))
            {
                return call_user_func_array(array($this, $function), $params);
            }else{
                show_404();
            }
        }
    }

    public function index($id=''){
        if(empty($id)){
            show_404();
        }
        $this->data['login_state'] = $this->session->userdata('login_state');
		$this->data['title'] = 'Dokumen Detail';
        $this->data['id'] = $id;
        $dok = $this->mDok->getDetail($id);
        $ext = pathinfo($dok->filename, PATHINFO_EXTENSION);
        $dok->ext = $ext;
		
        $img = array('jpg','png','jpeg','gif');        
        $doc = array('pdf','xls','xlsx','doc','docx');
        
        $this->data['file'] = $dok;
        
        if(in_array($ext,$img)){
            $this->load->view('viewer/image',$this->data);
        }elseif(in_array($ext,$doc)){
            $this->load->view('viewer/media',$this->data);
        }
    }
	
	public function doc(){
		$this->data['login_state'] = $this->session->userdata('login_state');
		$this->load->view('viewer/doc',$this->data);
	}
}