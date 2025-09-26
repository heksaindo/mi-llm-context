<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * local_time_formating library
 * @email : heri.purnomo@novadra.com
 * Written due to localize date time!
 */

class Local_time_format
{
    public $locale= 'id_ID';
    public $pattern = 'dd-mm-yyyy';
    public $timezone='Asia/Jakarta';
    public $year;
    public $month;
    public $day;
    
    public function setLocale($locale) {
        $this->locale = $locale;
    }

    public function setPattern($pattern) {
        $this->pattern = $pattern;
    }

    public function localeFormat($date) {
        $this->format = $this->fullDate($date);
        return $this->format;
    }

        
    private function getDate($date){
        
    }
    
    public function getDay($datetime){
        //setlocale(LC_ALL,"id_ID.UTF8");
        $day = date("d",strtotime($datetime));
        $month = date("m",strtotime($datetime));
        $year = date("y",strtotime($datetime));
        $hr = date("H",strtotime($datetime));
        $mn = date("i",strtotime($datetime));
        $sc = date("s",strtotime($datetime));
        
        $tday = strftime("%a",mktime($hr,$mn,$sc,$month,$day,$year));
        $day = array(
            "Sun"=>"Minggu", "Mon"=>"Senin", "Tue"=>"Selasa", "Wed"=>"Rabu", "Thu"=>"Kamis", "Fri"=>"Jum'at", "Sat"=>"Sabtu"
        );
        return $day[$tday];
    }
    
    public function strTo($str,$to){
        $daymont = array(
            "Sun"=>"Minggu", "Mon"=>"Senin", "Tue"=>"Selasa", "Wed"=>"Rabu", "Thu"=>"Kamis", "Fri"=>"Jum'at", "Sat"=>"Sabtu",
            "January" => "Januari","February" => "Februari","March"=> "Maret","April" => "April","May" => "May",
            "June" => "Juni","July" => "Juli", "August" => "Agustus", "September" => "September", "October" => "Oktober",
            "November" => "November", "December" => "Desember"
        );

        while ($fruit_name = current($daymont)) {
            if ($fruit_name == $to) {
                $string = key($daymont);
            }
            next($daymont);
        }
        return str_replace($string,$to,$str);
    }
    
    public function fullDate($datetime,$format =null){
        //setlocale(LC_ALL,"id_ID.UTF8");
        if(!$format){
            $format = $this->pattern;
        }
        $days = date("d",strtotime($datetime));
        $months = date("m",strtotime($datetime));
        $years = date("y",strtotime($datetime));
        $hr = date("H",strtotime($datetime));
        $mn = date("i",strtotime($datetime));
        $sc = date("s",strtotime($datetime));
        $this->month = $this->getMonth($datetime);
        $this->day = $this->getDay($datetime);
        $this->year=$years;
        switch(strtolower($format)){
            case "d-mm-yyyy":
                return strftime("%d-%B-%Y",mktime($hr,$mn,$sc,$months,$days,$years));
                break;
            case "d/mm/yyyy":
                return strftime("%d/%B/%Y",mktime($hr,$mn,$sc,$months,$days,$years));
                break;
            case "d mm yyyy":
                return strftime("%d %m %Y",mktime($hr,$mn,$sc,$months,$days,$years));
                break;
            case "d mmmm yyyy":
                $strf = strftime("%d %B %Y",mktime($hr,$mn,$sc,$months,$days,$years));
                return $this->strTo($strf,$this->month);
                break;
            case "dd mmmm yyyy":
                $strf = strftime("%a %B %Y",mktime($hr,$mn,$sc,$months,$days,$years));
                $st = $this->strTo($strf,$this->month);
                return $this->strTo($st,$this->day);
                break;
            case "ddd mmmm yyyy":
                $strf = strftime("%a, %d %B %Y",mktime($hr,$mn,$sc,$months,$days,$years));
                $st = $this->strTo($strf,$this->month);
                return $this->strTo($st,$this->day);
                break;
            case "dd":
                $strf=  strftime("%a",mktime($hr,$mn,$sc,$months,$days,$years));
                return $this->strTo($strf,$this->day);
                break;
            case "d":
                $strf= strftime("%d",mktime($hr,$mn,$sc,$months,$days,$years));
                break;
            case "mm":
                return strftime("%m",mktime($hr,$mn,$sc,$months,$days,$years));
                break;
            case "mmmm":
                return strftime("%B",mktime($hr,$mn,$sc,$months,$days,$years));
                break;
            case "yyyy":
                return strftime("%Y",mktime($hr,$mn,$sc,$months,$days,$years));
                break;
            case "mm yyyy":
                return strftime("%B %Y",mktime($hr,$mn,$sc,$months,$days,$years));
                break;
        }
        
    }
    
    public function getMonth($datetime){
        //setlocale(LC_ALL,"id_ID.UTF8");
        $day = date("d",strtotime($datetime));
        $month = date("m",strtotime($datetime));
        $year = date("y",strtotime($datetime));
        $hr = date("H",strtotime($datetime));
        $mn = date("i",strtotime($datetime));
        $sc = date("s",strtotime($datetime));
        $tmonth = strftime("%B",mktime($hr,$mn,$sc,$month,$day,$year));
        $month = array(
            "January" => "Januari","February" => "Februari","March"=> "Maret","April" => "April","May" => "May",
            "June" => "Juni","July" => "Juli", "August" => "Agustus", "September" => "September", "October" => "Oktober",
            "November" => "November", "December" => "Desember"
        );
        return $month[$tmonth];
    }
    
    public function shortMonth($mon){
        $month = array(
            "01" => "jan","02" => "feb","03"=> "mar","04" => "apr","05" => "mei","06" => "jun",
            "07" => "jul", "08" => "agu", "09" => "sep", "10" => "okt","11" => "nov", "12" => "des"
        );
        return $month[$mon];
    }
    
}
