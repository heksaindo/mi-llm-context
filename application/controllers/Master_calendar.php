<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master_calendar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->data['menumode'] = 'masterdata';
		$this->load->model('calendar_model','mc');
		//Notifikasi
		$this->load->model('notifikasi_model');
		$this->sessionuser = $this->session->userdata('user_id');
		$this->previlege = $this->session->userdata('login_state');
		$this->data['privilege'] =  $this->previlege;
        $this->data['login_state'] = $this->previlege;
		$this->data['notifikasi'] = $this->notifikasi_model->get_notifikasi($this->sessionuser, $this->previlege);
	}
	
	public function index()
	{	
		$this->data['title'] = 'Master Kalender';
		$this->load->view('masters/master_calendar', $this->data);
	}
    
    public function do_save(){
        extract($_POST);
        $uniqe = date("mdH");
        $data = array();
        if($lb_akhir){
            $akh = explode("-",$lb_akhir);
            $tgl_akhir = $akh[0];
            $bln_akhir = $akh[1];
        }else{
            $tgl_akhir = $tgl;
            $bln_akhir = $bulan;
        }
        $lb_akhir = date('Y-m-d',strtotime($lb_akhir . "+1 days"));
        $begin = new DateTime(date("Y-m-d",strtotime($lb_date)));
        $end = new DateTime(date("Y-m-d",strtotime($lb_akhir)));
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);
        foreach ( $period as $dt )
        {
            $bln = $this->local_time_format->shortMonth($dt->format('m'));
            $dat['hlb'][$dt->format('d')] = $uniqe.'#'.$lb_title;
            $con['hlb'] = $dat['hlb'];
            $con['hln'] = []; 
            $data[$bln] = $con;
        }
        $where = array(
            'tahun'=>$tahun
        );
        $getdata = $this->mc->getData($where);
        if(!empty($getdata)){
            $q = false;
        }else{
            $datas['tahun'] = $tahun;
            foreach($data as $dk=>$dv){
                $datas[$dk] = serialize($dv);
            }
            $q = $this->db->insert('m_calendar',$datas);
        }
        if($q){
            $result = 'success';
            $msg = 'Input data sukses';
        }else{
            $result = 'error';
            $msg = 'Input data gagal';
        }
        echo $result.'#'.$msg;
    }
    
    public function getbersama(){
        extract($_GET);
        $date = explode('-',$start);
        $where=array(
            'tahun'=>$date[0]
        );
        $getdata = $this->mc->getData($where);
        $mon = $this->local_time_format->shortMonth($date[1]);
        foreach($getdata as $row){
            $data = unserialize ($row->$mon);
        }
        
        /*
        $data=array();
        for($i=1;$i<10;$i++)
        {
            $data[]=array(
                        'title'=>'Judul '.$i,
                        'start'=>'2016-10-0'.$i
                        );
        }
        echo json_encode($data);*/
    }
}