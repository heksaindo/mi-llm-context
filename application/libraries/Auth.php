<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth {

    function check_user_privilege($privilege = '')
    {
		$CI =& get_instance();
		$CI->load->library('session');
		if(!$CI->session->userdata('SESS_USER_ID_SPM'))
		{
			$data = array(
				'SESS_LOGIN_STATEMENT' => 'Akses Ditolak ;)',
				'ERRMSG_ARR' => 'Anda harus login terlebih dahulu !'
			);
			$CI->session->set_userdata($data);
			redirect('backend/login');
 		}
 		return true;
    }
}

?>
