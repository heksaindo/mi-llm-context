<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @file Utility.php
 * @class Utility
 * @author Heri Purnomo
 * @email okejsb84@gmail.com
 * @date Sen Agu 01 18:51:59 2016
 *
 * Description
 * Utility class for ci
 *
 **/
class Utility{
    
    function __construct(){
        $this->ci =& get_instance();
    }
    
    function kekata($x) {
        $x = abs($x);
        $angka = array("", "satu", "dua", "tiga", "empat", "lima",
        "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($x <12) {
            $temp = " ". $angka[$x];
        } else if ($x <20) {
            $temp = $this->kekata($x - 10). " belas";
        } else if ($x <100) {
            $temp = $this->kekata($x/10)." puluh". $this->kekata($x % 10);
        } else if ($x <200) {
            $temp = " seratus" . $this->kekata($x - 100);
        } else if ($x <1000) {
            $temp = $this->kekata($x/100) . " ratus" . $this->kekata($x % 100);
        } else if ($x <2000) {
            $temp = " seribu" . $this->kekata($x - 1000);
        } else if ($x <1000000) {
            $temp = $this->kekata($x/1000) . " ribu" . $this->kekata($x % 1000);
        } else if ($x <1000000000) {
            $temp = $this->kekata($x/1000000) . " juta" . $this->kekata($x % 1000000);
        } else if ($x <1000000000000) {
            $temp = $this->kekata($x/1000000000) . " milyar" . $this->kekata(fmod($x,1000000000));
        } else if ($x <1000000000000000) {
            $temp = $this->kekata($x/1000000000000) . " trilyun" . $this->kekata(fmod($x,1000000000000));
        }     
            return $temp;
    }
     
     
    function angka_to_huruf($x, $style=4) {
        if($x<0) {
            $hasil = "minus ". trim($this->kekata($x));
        } else {
            $hasil = trim($this->kekata($x));
        }     
        switch ($style) {
            case 1:
                $hasil = strtoupper($hasil);
                break;
            case 2:
                $hasil = strtolower($hasil);
                break;
            case 3:
                $hasil = ucwords($hasil);
                break;
            default:
                $hasil = ucfirst($hasil);
                break;
        }     
        return $hasil;
    }
    
    function is_login(){
        if($this->ci->session->userdata('user_id')==''){
            return false;
        }else{
            return true;
        }
    }
    
    function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);
       
        $interval = date_diff($datetime1, $datetime2);
       
        return $interval->format($differenceFormat);
       
    }
    
    function getParameter($id,$field){
        if($id){
        $query = $this->ci->db->query("SELECT $field FROM parameter WHERE id='".$id."'");
        $row = $query->row();
        return $row->$field;
        }
    }
    
    function getTextField($table,$field,$key,$id){
        if($id){
        $query = $this->ci->db->query("SELECT $field FROM $table WHERE $key='".$id."'");
        $row = $query->row();
        return $row->$field;
        }
    }
    
    function dateNow($time=false){
        date_default_timezone_set('Asia/Jakarta');
        $str_format='';
        if($time==FALSE)
        {
            $str_format= date("Y-m-d");
        }else{
            $str_format= date("Y-m-d H:i:s");
        }
        return $str_format;
    }
}