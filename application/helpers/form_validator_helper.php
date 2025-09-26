<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

//require js form validator
//$this->js->base('form_validator');
if (! function_exists('form_validator'))
{
	function form_validator($data = ''){
        
		$data_form['validate_name'] = $data['validate_name'];
		$data_form['the_form'] = $data['the_form'];
		$data_form['save_button']= $data['save_button'];
		$data_form['csserror'] = $data['csserror'];
		$data_form['cssconfirm'] = $data['cssconfirm'];
		
		if(empty($data_form['validate_name'])){
           $data_form['validate_name'] = 'FormValidate';
        }
        if(empty($data_form['the_form'])){
           $data_form['the_form'] = '#form';
        }
        if(empty($data_form['save_button'])){
           $data_form['save_button'] = 'save';
        }
        if(empty($data_form['csserror'])){
           $data_form['csserror'] = '.errortxt';
        }
        if(empty($data_form['cssconfirm'])){
           $data_form['cssconfirm'] = '.confirmtxt';
        }
		
		//optional
		$data_form['page_url'] = '';
		$data_form['after_url'] = '';
		$data_form['txtTOS'] = '';
		$data_form['txtInvalid'] = '';
		$data_form['txtAjax'] = '';
		$data_form['txtSaving'] = '';
		$data_form['agreement'] = '';
		
		if(!isset($data['ajax'])){
           $data['ajax'] = 'false';
        }		
		$data_form['ajax'] = $data['ajax'];
		
		if(!isset($data['validCheck'])){
           $data['validCheck'] = 'false';
        }		
		$data_form['validCheck'] = $data['validCheck'];		
		
		if(!isset($data['agreementId'])){
           $data['agreementId'] = '#userAgree';
        }		
		$data_form['agreementId'] = $data['agreementId'];
		
		if(!isset($data['echo'])){
           $data['echo'] = true;
        }		
		$data_form['echo'] =  $data['echo'];

        //optional
		if(!empty($data['echo'])){
           $data_form['echo'] = $data['echo'];
        }
        if(!empty($data['ajax'])){
           $data_form['ajax'] = 'ajax: '.$data['ajax'].',';
        }
        if(!empty($data['validCheck'])){
           $data_form['validCheck'] = 'validCheck: '.$data['validCheck'].',';
        }
        if(!empty($data['page_url'])){
           $data_form['page_url'] = 'phpFile: "'.$data['page_url'].'",';
        }
        if(!empty($data['after_url'])){
           $data_form['after_url'] = 'afterURL: "'.$data['after_url'].'",';
        }

        if(!empty($data['agreement'])){
           $data_form['agreement'] = 'agreement: "'.$data['agreement'].'",';
        }
        if(!empty($data['txtTOS'])){
           $data_form['txtTOS'] = 'txtTOS: "'.$data['txtTOS'].'",';
        }
        if(!empty($data['txtInvalid'])){
           $data_form['txtInvalid'] = 'txtInvalid: "'.$data['txtInvalid'].'",';
        }
        if(!empty($data['txtAjax'])){
           $data_form['txtAjax'] = 'txtAjax: "'.$data['txtAjax'].'",';
        }

        $data_form['txtSaving_progress'] = 'process..';
        if(!empty($data['txtSaving'])){
           $data_form['txtSaving_progress'] = $data['txtSaving'];
           $data_form['txtSaving'] = 'txtSaving: "'.$data['txtSaving'].'",';
        }

        $add_js='
            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    //build validation
                    jQuery.fn.'.$data_form['validate_name'].' = jQuery.iFormValidate.build;
                    $("'.$data_form['the_form'].'").'.$data_form['validate_name'].'({
                        '.$data_form['page_url'].'
                        '.$data_form['after_url'].'
                        '.$data_form['ajax'].'
                        '.$data_form['validCheck'].'
                        '.$data_form['agreement'].'
                        '.$data_form['txtTOS'].'
                        '.$data_form['txtInvalid'].'
                        '.$data_form['txtAjax'].'
                        '.$data_form['txtSaving'].'
                        cssError: "'.$data_form['csserror'].'",
                        cssConfirm: "'.$data_form['cssconfirm'].'",
                        agreementId: "'.$data_form['agreementId'].'"
                    });
                    $("'.$data_form['save_button'].'").live(\'click\',function(){
						$("'.$data_form['cssconfirm'].'").html("'.$data_form['txtSaving_progress'].'");
						$("'.$data_form['cssconfirm'].'").show();
						$("'.$data_form['the_form'].'").submit();
                    });

                    $("'.$data_form['cssconfirm'].'").hide();
                    $("'.$data_form['csserror'].'").hide();
                });


            </script>
         ';
		
		if($data_form['echo']){
          echo $add_js;
        }else{
			return $add_js;
		}
    }
}
?>