<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('ajaxUpload'))
{
	function ajaxUpload($data){
		$default = array(
			'colorR' => '255',
			'colorG' => '255',
			'colorB' => '255',
			'maxSize' => '9999999999',
			'maxW' => '200',
			'maxH' => '200',
			'fullPath' => APP_URL.'Uploads',
			'relPath' => APP_PATH.'Uploads',
			'filename_field' => 'filename',
			'process_url' => BASE_URL.'pegawai/',
			'result_id' => 'upload_area',
			'result_default' => false,
			'trigger_id' => '',
			'message_upload' => '<p>Uploading.. Please Wait...</p> <img src="'.APP_URL.'img/info-loader.gif" border="0" /> ',
			'message_error' => '<img src="'.APP_URL.'img/cross-circle.png" border="0" /> Error in Upload, check settings and path info in source code.',
			'module' => 'backend',
			'file' => 'upload',
			'action' => '',
			'hide_openfile' => true,
			'only_image' => true
		);
		
		$data_upload = array_merge($default, $data);
		
		$hide_it = '';
		if($data_upload ['hide_openfile']){
			$hide_it = 'opacity_zero';
		}
		
		$ajaxupload_txt ='
		<form  method="post" name="form_uploader" id="form_uploader" enctype="multipart/form-data">			
			<input type="hidden" name="colorR" value="'.$data_upload['colorR'].'" />
			<input type="hidden" name="colorG" value="'.$data_upload['colorG'].'" />
			<input type="hidden" name="colorB" value="'.$data_upload['colorB'].'" />
			<input type="hidden" name="maxSize" value="'.$data_upload['maxSize'].'" />
			<input type="hidden" name="maxW" value="'.$data_upload['maxW'].'" />
			<input type="hidden" name="maxH" value="'.$data_upload['maxH'].'" />
			<input type="hidden" name="fullPath" value="'.$data_upload['fullPath'].'" />
			<input type="hidden" name="relPath"  value="'.$data_upload['relPath'].'" />
			<input type="hidden" name="fieldname" value="'.$data_upload['filename_field'].'" />
			<input type="hidden" name="module" value="'.$data_upload['module'].'" />
			<input type="hidden" name="file" value="'.$data_upload['file'].'" />
			<input type="hidden" name="action" value="'.$data_upload['action'].'" />
			<input type="hidden" name="relate_file" value="'.$data_upload['filename_field'].'" />
			<input type="hidden" name="only_image" value="'.$data_upload['only_image'].'" />
			<input type="file" name="'.$data_upload['filename_field'].'" id="'.$data_upload['filename_field'].'" class="'.$hide_it.' browse_file_upload"/>
		</form>
		<script type="text/javascript">
		$(document).ready(function()
		{	
		';
		
		if($data_upload['trigger_id']){
			$ajaxupload_txt .='
			$(\'#'.$data_upload['trigger_id'].'\').click(function(){
				
				$(\'#form_uploader\').width(0);
				$(\'#form_uploader\').height(0);
				$(\'.browse_file_upload\').trigger(\'click\');				
				return false;
			});
			';
		}
		
		
		$ajaxupload_txt .='
			$(\'.browse_file_upload\').change(function(){
				ajaxUpload(this.form,\''.$data_upload['process_url'].'\',\''.$data_upload['result_id'].'\',\''.$data_upload['message_upload'].'\',\''.$data_upload['message_error'].'\'); 
				return false;
			});
			';
		
		if($data_upload['result_default']){
		$ajaxupload_txt .='
			$(\'#'.$data_upload['result_id'].'\').html(\'<img src="'.IMAGE_THEME_URL.'trans.png" width="'.$data_upload['maxW'].'" class="thumb_img"> <input type="hidden" name="'.$data_upload['filename_field'].'" value="" />\');
		';
		}		
		
		$ajaxupload_txt .='
		});	
		</script>
		';
		
		return $ajaxupload_txt;
	}
}

if (!function_exists('buildDayDropdown'))
{
    function buildDayDropdown($name='',$value='')
    {
        $days = range(1, 31);
		$day_list[''] = 'Day';
        foreach($days as $day)
        {
            $day_list[$day] = $day;
        } 		
        return form_dropdown($name, $day_list, $value);
    }
}	

if ( !function_exists('buildYearDropdown'))
{
	function buildYearDropdown($name='',$value='', $option)
    {        
        $years = range(date("Y")-10, date("Y")+10);
		$year_list[''] = '-- Year --';
        foreach($years as $year)
        {
            $year_list[$year] = $year;
        }    
        
        return form_dropdown($name, $year_list, $value, $option);
    }
}

if (!function_exists('buildMonthDropdown'))
{
    function buildMonthDropdown($name='',$value='', $option)
    {
        $month=array(
			''	=>'-- Bulan --',
            '01'=>'Januari',
            '02'=>'Februari',
            '03'=>'Maret',
            '04'=>'April',
            '05'=>'Mei',
            '06'=>'Juni',
            '07'=>'Juli',
            '08'=>'Agustus',
            '09'=>'September',
            '10'=>'Oktober',
            '11'=>'November',
            '12'=>'Desember');
        return form_dropdown($name, $month, $value, $option);
    }
}

if (!function_exists('buildCountryDropdown'))
{
    function buildCountryDropdown($name='',$value='')
    {
        $country=array(
			''	=>'-- select --',
			"PH"=>"Philippines",
			"GB"=>"United Kingdom",
			"US"=>"United States",			
			"AF"=>"Afghanistan",
			"AL"=>"Albania",
			"DZ"=>"Algeria",
			"AD"=>"Andorra",
			"AO"=>"Angola",
			"AI"=>"Anguilla",
			"AQ"=>"Antarctica",
			"AG"=>"Antigua and Barbuda",
			"AR"=>"Argentina",
			"AM"=>"Armenia",
			"AW"=>"Aruba",
			"AU"=>"Australia",
			"AT"=>"Austria",
			"AZ"=>"Azerbaijan",
			"BS"=>"Bahamas",
			"BH"=>"Bahrain",
			"BD"=>"Bangladesh",
			"BB"=>"Barbados",
			"BY"=>"Belarus",
			"BE"=>"Belgium",
			"BZ"=>"Belize",
			"BJ"=>"Benin",
			"BM"=>"Bermuda",
			"BT"=>"Bhutan",
			"BO"=>"Bolivia",
			"BA"=>"Bosnia and Herzegovina",
			"BW"=>"Botswana",
			"BR"=>"Brazil",
			"IO"=>"British Indian Ocean",
			"BN"=>"Brunei",
			"BG"=>"Bulgaria",
			"BF"=>"Burkina Faso",
			"BI"=>"Burundi",
			"KH"=>"Cambodia",
			"CM"=>"Cameroon",
			"CA"=>"Canada",
			"CV"=>"Cape Verde",
			"KY"=>"Cayman Islands",
			"CF"=>"Central African Republic",
			"TD"=>"Chad",
			"CL"=>"Chile",
			"CN"=>"China",
			"CX"=>"Christmas Island",
			"CC"=>"Cocos (Keeling) Islands",
			"CO"=>"Colombia",
			"KM"=>"Comoros",
			"CD"=>"Congo, Democratic Republic of the",
			"CG"=>"Congo, Republic of the",
			"CK"=>"Cook Islands",
			"CR"=>"Costa Rica",
			"HR"=>"Croatia",
			"CY"=>"Cyprus",
			"CZ"=>"Czech Republic",
			"DK"=>"Denmark",
			"DJ"=>"Djibouti",
			"DM"=>"Dominica",
			"DO"=>"Dominican Republic",
			"TL"=>"East Timor",
			"EC"=>"Ecuador",
			"EG"=>"Egypt",
			"SV"=>"El Salvador",
			"GQ"=>"Equatorial Guinea",
			"ER"=>"Eritrea",
			"EE"=>"Estonia",
			"ET"=>"Ethiopia",
			"FK"=>"Falkland Islands (Malvinas)",
			"FO"=>"Faroe Islands",
			"FJ"=>"Fiji",
			"FI"=>"Finland",
			"FR"=>"France",
			"GF"=>"French Guiana",
			"PF"=>"French Polynesia",
			"GA"=>"Gabon",
			"GM"=>"Gambia",
			"GE"=>"Georgia",
			"DE"=>"Germany",
			"GH"=>"Ghana",
			"GI"=>"Gibraltar",
			"GR"=>"Greece",
			"GL"=>"Greenland",
			"GD"=>"Grenada",
			"GP"=>"Guadeloupe",
			"GT"=>"Guatemala",
			"GN"=>"Guinea",
			"GW"=>"Guinea-Bissau",
			"GY"=>"Guyana",
			"HT"=>"Haiti",
			"HN"=>"Honduras",
			"HK"=>"Hong Kong",
			"HU"=>"Hungary",
			"IS"=>"Iceland",
			"IN"=>"India",
			"ID"=>"Indonesia",
			"IE"=>"Ireland",
			"IL"=>"Israel",
			"IT"=>"Italy",
			"CI"=>"Ivory Coast",
			"JM"=>"Jamaica",
			"JP"=>"Japan",
			"JO"=>"Jordan",
			"KZ"=>"Kazakhstan",
			"KE"=>"Kenya",
			"KI"=>"Kiribati",
			"KR"=>"Korea, South",
			"KW"=>"Kuwait",
			"KG"=>"Kyrgyzstan",
			"LA"=>"Laos",
			"LV"=>"Latvia",
			"LB"=>"Lebanon",
			"LS"=>"Lesotho",
			"LI"=>"Liechtenstein",
			"LT"=>"Lithuania",
			"LU"=>"Luxembourg",
			"MO"=>"Macau",
			"MK"=>"Macedonia, Republic of",
			"MG"=>"Madagascar",
			"MW"=>"Malawi",
			"MY"=>"Malaysia",
			"MV"=>"Maldives",
			"ML"=>"Mali",
			"MT"=>"Malta",
			"MH"=>"Marshall Islands",
			"MQ"=>"Martinique",
			"MR"=>"Mauritania",
			"MU"=>"Mauritius",
			"YT"=>"Mayotte",
			"MX"=>"Mexico",
			"FM"=>"Micronesia",
			"MD"=>"Moldova",
			"MC"=>"Monaco",
			"MN"=>"Mongolia",
			"ME"=>"Montenegro",
			"MS"=>"Montserrat",
			"MA"=>"Morocco",
			"MZ"=>"Mozambique",
			"NA"=>"Namibia",
			"NR"=>"Nauru",
			"NP"=>"Nepal",
			"NL"=>"Netherlands",
			"AN"=>"Netherlands Antilles",
			"NC"=>"New Caledonia",
			"NZ"=>"New Zealand",
			"NI"=>"Nicaragua",
			"NE"=>"Niger",
			"NG"=>"Nigeria",
			"NU"=>"Niue",
			"NF"=>"Norfolk Island",
			"NO"=>"Norway",
			"OM"=>"Oman",
			"PK"=>"Pakistan",
			"PS"=>"Palestinian Territory",
			"PA"=>"Panama",
			"PG"=>"Papua New Guinea",
			"PY"=>"Paraguay",
			"PE"=>"Peru",
			"PN"=>"Pitcairn Island",
			"PL"=>"Poland",
			"PT"=>"Portugal",
			"QA"=>"Qatar",
			"RE"=>"R&eacute;union",
			"RO"=>"Romania",
			"RU"=>"Russia",
			"RW"=>"Rwanda",
			"SH"=>"Saint Helena",
			"KN"=>"Saint Kitts and Nevis",
			"LC"=>"Saint Lucia",
			"PM"=>"Saint Pierre and Miquelon",
			"VC"=>"Saint Vincent and the Grenadines",
			"WS"=>"Samoa",
			"SM"=>"San Marino",
			"ST"=>"S&atilde;o Tome and Principe",
			"SA"=>"Saudi Arabia",
			"SN"=>"Senegal",
			"RS"=>"Serbia",
			"CS"=>"Serbia and Montenegro",
			"SC"=>"Seychelles",
			"SL"=>"Sierra Leon",
			"SG"=>"Singapore",
			"SK"=>"Slovakia",
			"SI"=>"Slovenia",
			"SB"=>"Solomon Islands",
			"SO"=>"Somalia",
			"ZA"=>"South Africa",
			"GS"=>"South Georgia and the South Sandwich Islands",
			"ES"=>"Spain",
			"LK"=>"Sri Lanka",
			"SR"=>"Suriname",
			"SJ"=>"Svalbard and Jan Mayen",
			"SZ"=>"Swaziland",
			"SE"=>"Sweden",
			"CH"=>"Switzerland",
			"TW"=>"Taiwan",
			"TJ"=>"Tajikistan",
			"TZ"=>"Tanzania",
			"TH"=>"Thailand",
			"TG"=>"Togo",
			"TK"=>"Tokelau",
			"TO"=>"Tonga",
			"TT"=>"Trinidad and Tobago",
			"TN"=>"Tunisia",
			"TR"=>"Turkey",
			"TM"=>"Turkmenistan",
			"TC"=>"Turks and Caicos Islands",
			"TV"=>"Tuvalu",
			"UG"=>"Uganda",
			"UA"=>"Ukraine",
			"AE"=>"United Arab Emirates",
			"UM"=>"United States Minor Outlying Islands",
			"UY"=>"Uruguay",
			"UZ"=>"Uzbekistan",
			"VU"=>"Vanuatu",
			"VA"=>"Vatican City",
			"VE"=>"Venezuela",
			"VN"=>"Vietnam",
			"VG"=>"Virgin Islands, British",
			"WF"=>"Wallis and Futuna",
			"EH"=>"Western Sahara",
			"YE"=>"Yemen",
			"ZM"=>"Zambia",
			"ZW"=>"Zimbabwe");
		return form_dropdown($name, $country, $value);
    }
}

if (!function_exists('buildHourDropdown'))
{
    function buildHourDropdown()
    {
        $hours = range(1, 24);
        foreach($hours as $hour)
        {
            $hour_list[$hour] = $hour;
        } 		
		return $hour_list;
    }
}

if (!function_exists('buildMinuteDropdown'))
{
    function buildMinuteDropdown()
    {
        $minutes=array(
            '00'=>'00',
            '05'=>'05',
            '10'=>'10',
            '15'=>'15',
            '20'=>'20',
            '25'=>'25',
            '30'=>'30',
            '35'=>'35',
            '40'=>'40',
            '45'=>'45',
            '50'=>'50',
            '55'=>'55');
        return $minutes;
    }
}