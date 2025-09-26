<?php  if (!defined('BASEPATH')) exit('No direct script access allowed'); 

function getgolongan($roman){
	$romans = array(
		'M' => 1000,
		'CM' => 900,
		'D' => 500,
		'CD' => 400,
		'C' => 100,
		'XC' => 90,
		'L' => 50,
		'XL' => 40,
		'X' => 10,
		'IX' => 9,
		'V' => 5,
		'IV' => 4,
		'I' => 1,
	);

	$result = 0;
	
	foreach ($romans as $key => $value) {
		while (strpos($roman, $key) === 0) {
			$result += $value;
			$roman = substr($roman, strlen($key));
		}
	}
	return $result;
		
}

if (! function_exists('getMasaKerjaKeseluruhan'))
{
	function getMasaKerjaKeseluruhan($tmt_cpns)
	{
		$endDate = date('Y-m-d');
		$startDate = strtotime($tmt_cpns); 
		$endDate = strtotime($endDate); 
		if ($startDate === false || $startDate < 0 || $endDate === false || $endDate < 0 || $startDate > $endDate) 
			return false; 
			
		$years = date('Y', $endDate) - date('Y', $startDate); 
		
		$endMonth = date('m', $endDate); 
		$startMonth = date('m', $startDate); 
		
		// Calculate months 
		$months = $endMonth - $startMonth; 
		if ($months <= 0)  { 
			$months += 12; 
			$years--; 
		} 
		if ($years < 0) 
			return false; 
					
		return array($years, $months); 
	}
}	


if (! function_exists('getGapokNew'))
{
	function getGapokNew($gol, $masa_kerja_tahun, $masa_kerja_bulan)
	{
		$objCI =& get_instance();
		
		$objCI->db->select("b.kdgapok,`b`.`gapok`, b.kdkelgapok, a.kode_golongan, a.nama_golongan")
				->from("m_gapok b")
				->join('m_golongan a','a.kdkelgapok=b.kdkelgapok','LEFT');
				//->where('a.kode_golongan', $gol)
				//->where('b.kdgapok', $masa_kerja_tahun);
				
		$query = $objCI->db->get();
		if ($query->num_rows() > 0) {
			//$row_gaji = $query->row_array();
			$old_gol = $gol;
			$old_mkt = $masa_kerja_tahun;
			$gapok_lama = 0;	
			$gapok_baru = 0;	
			
			foreach($query->result_array() as $row){
				
				if($old_gol == $row['kode_golongan'] and $old_mkt == $row['kdgapok'] ){
					$gapok_lama = $row['gapok'];
				}
				
				$new_mkt_tahun = $old_mkt + 2; //get masa kerja itung dr tmt?
				$new_mkt_bulan = $masa_kerja_bulan;
				$cek = cek_new_gapok($new_mkt_tahun, $old_gol);
				
				if(!$cek){
					$new_gol = nextGolongan($old_gol);
				}else{
					$new_gol = $old_gol;
				}
				$_gol = nextGol($new_gol);
				if($new_gol == $row['kode_golongan'] and $new_mkt_tahun == $row['kdgapok'] ){
					$gapok_baru = $row['gapok'];
				}
				
			}
			 //echo $new_gol.'-'.$new_mkt.'-'.$gapok_baru;die();
			//return $gapok_lama.'#'.$gapok_baru;
			return $gapok_baru.'#'.$new_gol.'#'.$new_mkt_tahun.'#'.$new_mkt_bulan.'#'.$_gol;
		}
	}
}

function cek_new_gapok($new_mkt, $old_gol) {
		$objCI =& get_instance();
		
		$objCI->db->select("b.kdgapok,`b`.`gapok`")
				->from("m_gapok b")
				->join('m_golongan a','a.kdkelgapok=b.kdkelgapok','LEFT')
				->where('a.kode_golongan', $old_gol)
				->where('b.kdgapok', $new_mkt);
				
		$query = $objCI->db->get();
		if ($query->num_rows() > 0) {
			return true;
		}else{
			return false;
		}
		
}

if (! function_exists('getGapok'))
{
	function getGapok($gol, $masa_kerja_tahun)
	{
		$objCI =& get_instance();
		
		if(strlen(trim($masa_kerja_tahun)) == 1){
			$masa_kerja = '0'.$masa_kerja_tahun;
		}else{
			$masa_kerja = $masa_kerja_tahun;
		}
		
		$objCI->db->select("b.gapok")
				->from("m_golongan a")
				->join('m_gapok b','a.kdkelgapok=b.kdkelgapok','LEFT')
				->where('a.kode_golongan', $gol)
				->where('b.kdgapok', $masa_kerja);
		$query = $objCI->db->get();
		if ($query->num_rows() > 0) {
			$row_gaji = $query->row_array();
			 
			return $row_gaji['gapok'];
		}
	}
}	
if (! function_exists('nextGolongan'))
{
	function nextGolongan($gol_lama)
	{
		$objCI =& get_instance();
		
		$query = $objCI->db->query("SELECT a.kode_golongan, BB.kode_golongan as gol_baru, BB.nama_golongan
							FROM m_golongan a
							LEFT JOIN 
								(SELECT b.* FROM m_golongan b) AS BB ON BB.id_golongan = a.id_golongan + 1
							WHERE a.kode_golongan = '".$gol_lama."'");
				
		//$query = $objCI->db->get();
		if ($query->num_rows() > 0) {
			$row_gol = $query->row_array();
			 
			return $row_gol['gol_baru'];
		}
	}
}	
if (! function_exists('nextGol'))
{
	function nextGol($gol_lama)
	{
		$objCI =& get_instance();
		
		$query = $objCI->db->query("SELECT a.kdkelgapok
							FROM m_golongan a
							WHERE a.kode_golongan = '".$gol_lama."'");
				
		//$query = $objCI->db->get();
		if ($query->num_rows() > 0) {
			$row_gol = $query->row_array();
			 
			return $row_gol['kdkelgapok'];
		}
	}
}
if (! function_exists('toInaDate'))
{
	function toInaDate($date, $format='Y-m-d')
	{
		if(!empty($date) && $date != '0000-00-00'){
			if($format == 'd/m/Y'){
				$exp_date1 = explode("/",$date);
				$date = mktime(0,0,0,$exp_date1[1],$exp_date1[0],$exp_date1[2]);
			}
			$tgl = date('d', strtotime($date));
			$bulan = date('m', strtotime($date));
			$tahun = date('Y', strtotime($date));
			
			Switch ($bulan){
				case 1 : $bulan="Januari";
					Break;
				case 2 : $bulan="Februari";
					Break;
				case 3 : $bulan="Maret";
					Break;
				case 4 : $bulan="April";
					Break;
				case 5 : $bulan="Mei";
					Break;
				case 6 : $bulan="Juni";
					Break;
				case 7 : $bulan="Juli";
					Break;
				case 8 : $bulan="Agustus";
					Break;
				case 9 : $bulan="September";
					Break;
				case 10 : $bulan="Oktober";
					Break;
				case 11 : $bulan="November";
					Break;
				case 12 : $bulan="Desember";
					Break;
				}
			$new_date = $tgl.' '.$bulan.' '.$tahun;
		}else{
			$new_date = '';
		}
		
		return $new_date;
	}
}
if (! function_exists('toInaPeriode'))
{
	function toInaPeriode($date, $format='Y-m-d')
	{
		if(!empty($date) && $date != '0000-00-00'){
			if($format == 'd/m/Y'){
				$exp_date1 = explode("/",$date);
				$date = mktime(0,0,0,$exp_date1[1],$exp_date1[0],$exp_date1[2]);
			}
			$tgl = date('d', strtotime($date));
			$bulan = date('m', strtotime($date));
			$tahun = date('Y', strtotime($date));
			
			Switch ($bulan){
				case 1 : $bulan="Januari";
					Break;
				case 2 : $bulan="Februari";
					Break;
				case 3 : $bulan="Maret";
					Break;
				case 4 : $bulan="April";
					Break;
				case 5 : $bulan="Mei";
					Break;
				case 6 : $bulan="Juni";
					Break;
				case 7 : $bulan="Juli";
					Break;
				case 8 : $bulan="Agustus";
					Break;
				case 9 : $bulan="September";
					Break;
				case 10 : $bulan="Oktober";
					Break;
				case 11 : $bulan="November";
					Break;
				case 12 : $bulan="Desember";
					Break;
				}
			$new_date = $bulan.' '.$tahun;
		}else{
			$new_date = '';
		}
		
		return $new_date;
	}
}

if (! function_exists('addMonthToDate'))
{

	function addMonthToDate($timeStamp, $totalMonths=1){
        // You can add as many months as you want. mktime will accumulate to the next year.
        $thePHPDate = getdate($timeStamp); // Covert to Array    
        $thePHPDate['mon'] = $thePHPDate['mon']+$totalMonths; // Add to Month    
        $timeStamp = mktime($thePHPDate['hours'], $thePHPDate['minutes'], $thePHPDate['seconds'], $thePHPDate['mon'], $thePHPDate['mday'], $thePHPDate['year']); // Convert back to timestamp
        return $timeStamp;
    }
}	
	
if (! function_exists('explode_trim'))
{
	/**
	 * used to explode data and remove space on data
	 *
	 * @param	data: on array
	 * @return	separator: 
	 */
	function explode_trim($data="",$separator=""){
		$new_data="";
		if(!empty($data)){
			$data=explode($separator,$data);
			foreach($data as $dt){
				$new_data[]=trim($dt);
			}
		}
		return $new_data;
	}
}

if (! function_exists('delete_directory'))
{
	/**
	 * delete directory recursive
	 *
	 * @param	dir: directorypath
	 */
	function delete_directory($dir) {
		if (!file_exists($dir)) return true;
		if (!is_dir($dir) || is_link($dir)) return unlink($dir);
			foreach (scandir($dir) as $item) {
				if ($item == '.' || $item == '..') continue;
				if (!delete_directory($dir . "/" . $item)) {
					chmod($dir . "/" . $item, 0777);
					if (!delete_directory($dir . "/" . $item)) return false;
				};
			}
			return rmdir($dir);
    }
	
}

if (!function_exists('objToArray'))
{
	/**
	 * switch obj to array
	 *
	 * @param	obj : object
	 * @return	array
	 */
	function objToArray($obj)
	{
		$_arr = is_object($obj) ? get_object_vars($obj) : $obj;
		foreach ($_arr as $key => $val)
		{
			$val = (is_array($val) || is_object($val)) ? objToArray($val) : $val;
			$arr[$key] = $val;
		}
		return $arr;
	}
}

if (!function_exists('addText'))
{
	/**
	 * add text to variable, with dynamic separator
	 *
	 * @param	val1 : string -> container
	 * @param	val2 : string -> data
	 * @param	separator : string -> separator
	 * @return	string
	 */
	function addText($val1,$val2,$separator){
		if(!empty($val2)){
			if(empty($val1)){
				$val1=$val2;
			}else
			{
				$val1.=$separator.$val2;
			}
		}
		return $val1;
	}
}

if ( ! function_exists('get_mktime'))
{
	function get_mktime($date){
		//$date = accept only format Y-m-d H:i:s
		$exp_date1 = explode(" ",$date);
		$exp_date2 = array(date('Y'),date('m'),date('d'));
		if(!empty($exp_date1[0])){
			$exp_date2 = explode("-",$exp_date1[0]);
			if(empty($exp_date2[0]) OR empty($exp_date2[1]) OR empty($exp_date2[2])){
				$exp_date2 = array(0,0,0);
			}
		}
		
		$exp_date3 = array(0,0,0);
		if(!empty($exp_date1[1])){
			$exp_date3 = explode(":",$exp_date1[1]);
			if(empty($exp_date3[0]) OR empty($exp_date3[1]) OR empty($exp_date3[2])){
				$exp_date3 = array(0,0,0);
			}
		}
		
		$new_mktime = mktime($exp_date3[0],$exp_date3[1],$exp_date3[2],$exp_date2[1],$exp_date2[2],$exp_date2[0]);
		
		return $new_mktime;
	}
}

if ( ! function_exists('reformat_date'))
{
	function reformat_date($date, $formatted = "Y-m-d H:i:s"){
		//$date = accept only format Y-m-d H:i:s
		if(!empty($date)){
			if($date<>"0000-00-00"){
				$exp_date1 = explode(" ",$date);
				$exp_date2 = array(date('Y'),date('m'),date('d'));
				if(!empty($exp_date1[0])){
					$exp_date2 = explode("-",$exp_date1[0]);
					if(empty($exp_date2[0]) OR empty($exp_date2[1]) OR empty($exp_date2[2])){
						$exp_date2 = array(0,0,0);
					}
				}
				
				$exp_date3 = array(0,0,0);
				if(!empty($exp_date1[1])){
					$exp_date3 = explode(":",$exp_date1[1]);
					if(empty($exp_date3[0]) OR empty($exp_date3[1]) OR empty($exp_date3[2])){
						$exp_date3 = array(0,0,0);
					}
				}
				
				$new_date = date($formatted, mktime($exp_date3[0],$exp_date3[1],$exp_date3[2],$exp_date2[1],$exp_date2[2],$exp_date2[0]));
				
				return $new_date;
			}
			else{
				return "-";
			}
		}
		else{
			return "-";
		}
	}
}

if ( ! function_exists('datediff'))
{	
	function datediff($d1, $d2){  
		$d1 = (is_string($d1) ? strtotime($d1) : $d1);  
		$d2 = (is_string($d2) ? strtotime($d2) : $d2);  
		$diff_secs = abs($d1 - $d2);  
		$base_year = min(date("Y", $d1), date("Y", $d2));  
		$diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);  
		return array( "years" => date("Y", $diff) - $base_year,  "months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1,  "months" => date("n", $diff) - 1,  "days_total" => floor($diff_secs / (3600 * 24)),  "days" => date("j", $diff) - 1,  "hours_total" => floor($diff_secs / 3600),  "hours" => date("G", $diff),  "minutes_total" => floor($diff_secs / 60),  "minutes" => (int) date("i", $diff),  "seconds_total" => $diff_secs,  "seconds" => (int) date("s", $diff)  );  
	 }  
}
 
if ( ! function_exists('dateDifference'))
{	
	 function dateDifference($startDate, $endDate) 
        { 
            $startDate = strtotime($startDate); 
            $endDate = strtotime($endDate); 
            if ($startDate === false || $startDate < 0 || $endDate === false || $endDate < 0 || $startDate > $endDate) 
                return false; 
                
            $years = date('Y', $endDate) - date('Y', $startDate); 
            
            $endMonth = date('m', $endDate); 
            $startMonth = date('m', $startDate); 
            
            // Calculate months 
            $months = $endMonth - $startMonth; 
            if ($months <= 0)  { 
                $months += 12; 
                $years--; 
            } 
            if ($years < 0) 
                return false; 
            
            // Calculate the days 
                        $offsets = array(); 
                        if ($years > 0) 
                            $offsets[] = $years . (($years == 1) ? ' year' : ' years'); 
                        if ($months > 0) 
                            $offsets[] = $months . (($months == 1) ? ' month' : ' months'); 
                        $offsets = count($offsets) > 0 ? '+' . implode(' ', $offsets) : 'now'; 

                        $days = $endDate - strtotime($offsets, $startDate); 
                        $days = date('z', $days);    
                        
            return array($years, $months, $days); 
        }
}
		
if ( ! function_exists('to_number'))
{
	function to_number($rupiah)
	{
		return preg_replace('/[^0-9]/', '', $rupiah);
	}
}

if ( ! function_exists('to_number2'))
{
	function to_number2($rupiah)
	{
		return str_replace(',', '', $rupiah);
	}
}

function export_excel($export_data){
	extract($export_data);
	
	if(!empty($filename)){
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=".$filename.".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		header("Content-Transfer-Encoding: binary ");
		
		if(is_array($data)){
			//PARSE
			$html = '<table ';
			if(!empty($table_attribute)){
				$html .= $table_attribute;
			}	
			$html .= '>';
			
			//TR
			$td_width = array();
			$td_align = array();
			$total_col = 0;
			if(!empty($column)){
				if(is_array($column)){
					$html .= '<tr>';
					foreach($column as $col){
						$total_col++;
						$html .= '<th ';
						
						//width
						if(!empty($col[1])){
							$html .= 'width="'.$col[1].'" ';
							$td_width[] = 'width="'.$col[1].'" ';
						}

						//align
						if(!empty($col[2])){
							$html .= 'align="'.$col[2].'" ';
							$td_align[] = 'width="'.$col[1].'" ';
						}
						
						$html .= '>';
						
						//TH name
						if(!empty($col[0])){
							$html .= $col[0];
						}
						
						$html .= '</th>';	
					}
					$html .= '</tr>';
				}
			}
			
			//TD
			if(!empty($data)){
				if(is_array($data)){
					
					//all data
					foreach($data as $data_td){
						$html .= '<tr>';
					
						if(is_array($data_td)){
							
							//data td
							$i = 1;
							foreach($data_td as $td){
								$html .= '<td ';
								
								//width
								if(!empty($td_width[$i])){
									//$html .= $td_width[$i];
								}

								//align
								if(!empty($td_align[$i])){
									$html .= $td_align[$i];
								}
						
								$html .= '>';
								
								//TD value
								if(!empty($td)){
									$html .= $td;
								}
								
								$html .= '</td>';							
								$i++;
							}
							
						}
						$html .= '</tr>';
					}
					
					
				}
			}
			
			$html .= '</table>';
		
		}else{
			$html = $data;
		}
		
		if(empty($style)){
			//style
			$style_excel = '
			<style type="text/css">
.bold{ font-weight:bold; }
.colorBlack{ color:#000000;}
.colorWhite{ color:#FFFFFF;}
.colorRed{ color:#ff0000;}
.colorGreen{ color:#194a19;}
.ml10{ margin-left:10px;}
.mr10{ margin-right:10px;}
.mt10{ margin-top:10px;}
.mb10{ margin-bottom:10px;}
.ml15{ margin-left:15px;}
.mr15{ margin-right:15px;}
.mt15{ margin-top:15px;}
.mb15{ margin-bottom:15px;}
.pl10{ padding-left:10px;}
.pr10{ padding-right:10px;}
.pt10{ padding-top:10px;}
.pb10{ padding-bottom:10px;}
.pl15{ padding-left:15px;}
.pr15{ padding-right:15px;}
.pt15{ padding-top:15px;}
.pb15{ padding-bottom:15px;}
.uppercase{
	text-transform: uppercase;
}
.lowercase{
	text-transform: lowercase;
}
.capitalize{
	text-transform: capitalize;
}
/*general report style*/
.printable table{	
  border-collapse: collapse;
  color: #000;
  font-family: tahoma, verdana, sans-serif;
  font-size: 12px;
}

.printable h2, .printable table h2{
	font-size:18px;
	font-weight:bold;
	margin: -5px 0 0;
	color:#000;
}

.printable h3, .printable table h3{
	font-size:14px;
	font-weight:bold;
	margin: -5px 0 0;
	color:#000;
}

/*Header Table*/
.printable table.header {
  font-family: tahoma, verdana, sans-serif;
  border-bottom: 0.8pt solid #000;
}
.printable table.header td.border-top {
  border-top: 0.8pt solid #000;
}

.printable table.header td.title {
    margin: 0;
    font-size: 14px;
	font-weight:bold;
}

.printable table.header td {
    font-size: 12px;
}

/*just border*/
.printable table.table_border{
	border:0.8pt solid #000;
}

.printable table.table_border tr td{
	padding:3px 5px;
}

/*table skin with odd even bg*/
.printable table.grid_table { 
  font-size: 12px;
}

.printable table.grid_table { 
  border: 0.8pt solid #000;
}

.printable table.grid_table tr th,
.printable table.grid_table tr td { 
  border: 0.8pt solid #000;
  padding:2px 5px;
}

.printable table.grid_table tr td.textgray,
.printable table.grid_table tr th.textgray{
	color:#444; 
}

.printable table.grid_table tr.emptyhead{
	height:2px;
	font-size:1px;
}

.printable table.grid_table tr.table_header, 
.printable table.grid_table tr.table_header td,
.printable table.grid_table tr.table_header th{ 
	background-color:#e8e8e8;
	font-weight:bold;
	border:0.8pt solid #000;
	border-left:0px solid #000;
	vertical-align: middle;
}

.printable table.grid_table tr.table_header th.td_first,
.printable table.grid_table tr.table_header td.td_first{
	border:0.8pt solid #000;
}

.printable table.grid_table tr.even_row td,
.printable table tr.even_row td {
    background-color: #F6F6F6;
    border-bottom: 0.8pt solid #aaaaaa;
}

.printable table.grid_table tr.odd_row td,
.printable table tr.odd_row td {
    background-color: transparent;
    border-bottom: 0.8pt solid #aaaaaa;
}

.printable table.grid_table tr.even_row.no_border td,
.printable table tr.even_row.no_border td {
    border-bottom: 0px solid #aaaaaa;
}

.printable table.grid_table tr.odd_row.no_border td,
.printable table tr.odd_row.no_border td {
    border-bottom: 0px solid #aaaaaa;
}
.printable table tr th.left, .printable table tr td.left{text-align:left;}
.printable table tr th.right, .printable table tr td.right{text-align:right;}
.valign_top{vertical-align:top;}
.valign_mid{vertical-align:mid;}
.valign_btm{vertical-align:bottom;}
</style>
			';
			
			$html = $style_excel.$html;
		}else{
			$html = $style.$html;
		}
		
		echo $html;
	}
}


if (! function_exists('get_name'))
{
	function get_name($table_name,$field_name,$field_id,$value_id)
	{
		//echo "Select ".$field_name." from ".$table_name." where ".$field_id."='".$value_id."'";
		$ci=&get_instance();
		$ci->db->select($field_name, false)->from($table_name, false)->where($field_id,$value_id);
		$query=$ci->db->get();
		
		if ($query->num_rows() > 0) {
			$data=$query->row();
			return $data->$field_name;
		}else{
			return '';
		}
	}
}

if (! function_exists('selectdata'))
{	
	function selectdata($table_name, $id_name, $id_field, $name_field, $selected_id, $where, $group_by, $pilih="", $add_text=""){
	  $ci=& get_instance();
	  $selected="";
	  $ret_value = '<select name="'.$id_name.'" id="'.$id_name.'" '.$add_text.'>';
	  if (!empty($pilih)){
		$ret_value .= '<option value="">'.$pilih.'</option>';
	  }
	  if(!empty($where)){
		$ci->db->where($where);
	  }
	  $ci->db->select(" ".$id_field.",".$name_field." ")->from($table_name)->order_by($group_by);
	  $data = $ci->db->get();
	  $number = $data->num_rows();
	  if(!empty($number)){
		  foreach($data->result_array() as $row)
		  {
			if($row[$id_field]==$selected_id)
			{
				$selected = "selected";
			}
			$ret_value .= '<option value="'.$row[$id_field].'" '.$selected.'>'.$row[$name_field].'</option>';
			$selected = "";
		  }
	  }
	  else{
	  		if(empty($pilih)){
				$ret_value.="<option value=''>-</option>";
			}
	  }
	  $ret_value .= "</select>";
	  return $ret_value;
	} 
}

if (! function_exists('build_accountWhere'))
{	
	function build_accountWhere($perkiraan_id){
		$ci=&get_instance();
		$account_list=array();
		$q_account=$ci->db->query("select * from erp_master_perkiraan where perkiraan_root_id='".$perkiraan_id."'");
		array_push($account_list,$perkiraan_id);
		foreach($q_account->result() as $row){
			$q_account2=$ci->db->query("select * from erp_master_perkiraan where perkiraan_root_id='".$row->perkiraan_id."'");
			$num_cek=$q_account2->num_rows();
			array_push($account_list,$row->perkiraan_id);
			if(!empty($num_cek)){
				$child_value=build_accountWhere($row->perkiraan_id);
				foreach($child_value as $k=>$v){
					if(!in_array($v,$account_list)){
						array_push($account_list,$v);
					}
				}
			}
		}
		return $account_list;
	}
}

if ( ! function_exists('to_number_split'))
{
	function to_number_split($value,$decimal=0)
	{
		if($value < 0)
		{
			return '( '.number_format(abs($value), $decimal, '.', ',').' )';
		}
		else
		{
			return number_format($value, $decimal, '.', ',');
		}
	}		
}

if ( ! function_exists('number_format_nr'))
{
	function number_format_nr($value, $decimal = 0)
	{
		if($value < 0)
		{
			return '('.number_format(abs($value), $decimal, '.', ',').')';
		}
		else
		{
			return number_format($value, $decimal, '.', ',');
		}
	}		
}

if ( ! function_exists('number_format_id'))
{
	function number_format_id($value, $decimal = 0)
	{
		if($value < 0)
		{
			return 'Rp. ('.number_format(abs($value), $decimal, ',', '.').')';
		}
		else
		{
			return 'Rp. '.number_format($value, $decimal, ',', '.');
		}
	}		
}

if ( ! function_exists('number_format_db'))
{
	function number_format_db($value, $decimal = 0)
	{
		$value = str_replace('Rp. (','', $value);
		$value = str_replace('Rp. ','', $value);
		$value = str_replace('.', '',$value);
		$value = str_replace(')', '',$value);
		$value = str_replace(',', '',$value);
		if($value > 0)
		{
			return abs($value);
		}
		else
		{
			return 0;
		}
	}		
}

if ( ! function_exists('go_print'))
{
	function go_print($echoed = true)
	{
		$objCI =& get_instance();
		echo $objCI->js->print_js();	
		echo '	
		<a href="javascript:print();" id="go_print_iframe" style="display:none;"></a>
		<script type="text/javascript">	
		$(document).ready(function(){
			$("#go_print_iframe").click(function(){
				print();
			});
			$("#go_print_iframe").trigger("click");
		});
		</script>
		
		';
	}		
}

if ( ! function_exists('to_mysql_date'))
{
	function to_mysql_date($date,$sep="-"){
		if(!empty($date)){
			$date_arr=explode($sep,$date);
			return @$date_arr[2]."-".@$date_arr[1]."-".@$date_arr[0];
		}
		else{
			return "-";
		}
	}
}

function add_text($data, $value, $separator = '', $echoed = false){
	if(!empty($value)){
		if(empty($data)){
			$data = $value;
		}else{
			$data .= $separator.$value;
		}
	}
	
	if($echoed){
		echo $data;
	}else{
		return $data;
	}
}


if(!function_exists('notify_roles')){
	function notify_roles($sub_module = '', $access = ''){
		$objCI =& get_instance();
		
		if(!empty($sub_module) AND !empty($access)){
			$data_access = explode("-", $access);
			$objCI->db->from("module_roles");
			$objCI->db->where("module_access LIKE '%".$sub_module."%'");
			$module_roles = $objCI->db->get();
			
			$role_id = array();
			if($module_roles->num_rows() > 0){
				foreach($module_roles->result() as $data_module){
					if(!in_array($data_module->role_id,$role_id)){
					
						//check access
						$data_access_roles = json_decode($data_module->module_access,true);
						
						if(!empty($data_access_roles[$sub_module])){
							//foreach $data_access
							foreach($data_access as $acc){
								if(in_array($acc,$data_access_roles[$sub_module])){
									$role_id[] = $data_module->role_id;
									break;
								}
							}
							
						}
						
						
					}
				}
			}
			
			if(empty($role_id)){
				return '';
			}else{
				$data_roles = '"'.implode('","', $role_id).'"';
				return $data_roles;
			}
			
		}
	}
}

if(!function_exists('add_notify')){
	function add_notify($data){
		
		$objCI =& get_instance();	
		global $current_user;
		
		
		$data_required = array(
			'notify_date' => date("Y-m-d H:i:s"),
			'sub_module' => '',
			'access' => '',
			'notify_title' => '',
			'notify_message' => ''
		);
		
		$data_notify = $data + $data_required;
		
		if(empty($data_notify['sub_module'])){
			return 'failed';
		}else{
			if(empty($data_notify['access'])){
				$data_notify['access'] = 'i-u-d-v';
			}
		}
		
		$notify_roles = notify_roles($data_notify['sub_module'], $data_notify['access']);
		
		$data_required = array(
			'notify_date' => date("Y-m-d H:i:s"),
			'notify_roles' => $notify_roles,
			'notify_title' => '',
			'notify_message' => ''
		);
		
		$data_notify = $data + $data_required;
		
		if(empty($data_notify['sub_module'])){
			return 'failed';
		}else{
			if(empty($data_notify['access'])){
				$data_notify['access'] = 'i-u-d-v';
			}
		}
		
		$add_notify = $objCI->db->insert('notify',$data_notify); 
		
		if($add_notify){
			return 'success';
		}else{
			return 'failed';
		}
	}
}

function buat_barcode($txtcode,$code="code128",$thickness=30,$resolution=2,$font_size=8, $width="", $height=""){
	//$text='<img alt="Barcode Image" src="'.base_url().'barcode/html/image.php?code='.$code.'&amp;o=1&amp;dpi=96&amp;t='.$thickness.'&amp;r='.$resolution.'&amp;rot=0&amp;text='.$txtcode.'&amp;f1=Arial.ttf&amp;f2='.$font_size.'&amp;a1=&amp;a2=NULL&amp;a3=">';
	$text='<img width="'.$width.'" height="'.$height.'" alt="'.$txtcode.'" src="'.BASE_URL.'barcode/html/image.php?code=code128&amp;o=1&amp;dpi=96&amp;t='.$thickness.'&amp;r='.$resolution.'&amp;rot=0&amp;text='.$txtcode.'&amp;f1=Arial.ttf&amp;f2=&amp;a1=&amp;a2=NULL&amp;a3=">';
	return $text;
}

?>