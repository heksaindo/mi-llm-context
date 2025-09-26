<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('loginme') != 'qwerty-0981728392'){
			redirect('logout');
		}
		$this->load->model('dashboard_model');
		$this->load->model('pensiun_model');
		$this->load->model('info_model');
	}

	public function index()
	{	
		
	}
	
	function getColor($n){
			$color = array(
						   /*green*/'#07DB04',
						   /*red*/'#FF0E0A',
						   /*blue*/'#1006CC',
						   /*blue fb*/'#047BEA',
						   /*yellow*/'#E3F70E',
						   /*dark yellow*/'#BBC417',
						   /*pink*/'#F711EB',
						   /*darkPink*/'#AD08A5',
						   /*orange*/'#FFBA19',
						   /*darkOrange*/'#C18907',
						   /*lightSea*/'#4FFFEA',
						   /*lightGreen*/'#7FFFC5');
			return $color[$n];
	}
	public function dashboard_pereselon()
	{	
	
		header("Content-type: text/xml");
		
		//get data eselon
		$data_pereselon = $this->dashboard_model->data_pereselon();
		
		?>
		<chart palette='3' showValues='0' lineColor='FCB541'>
			
			<?php
			if(!empty($data_pereselon)){
				foreach($data_pereselon as $dt){
					
					$issliced = '';
					if($dt['issliced'] == 1){
						//$issliced = 'issliced="1" ';
					}
					
					echo '<set label="'.$dt['nama_eselon'].'" value="'.$dt['total'].'" '.$issliced.'/>';
					
				}
			}
			?>
			
			<styles>
				<definition>
					<style name='Anim1' type='animation' param='_xscale' start='0' duration='1' />
					<style name='Anim2' type='animation' param='_alpha' start='0' duration='0.6' />
					<style name='DataShadow' type='Shadow' alpha='40'/>
				</definition>
				<application>
					<apply toObject='DIVLINES' styles='Anim1' />
					<apply toObject='HGRID' styles='Anim2' />
					<apply toObject='DATALABELS' styles='DataShadow,Anim2' />
			</application>	
			</styles>

		</chart> 
		<?php
	}

	/*public function dashboard_pergolongan()
	{	
	
		header("Content-type: text/xml");
		
		//get dashboard_pergolongan
		$dashboard_pergolongan = $this->dashboard_model->dashboard_pergolongan();
		
		?>
		<chart palette="5"  shownames="0" showdatavalues="0" numberPrefix="" showSum="1" decimals="0" overlapColumns="0" showlegend="0">
			<categories>
				<?php
				if(!empty($dashboard_pergolongan['categories'])){
					foreach($dashboard_pergolongan['categories'] as $dt){
						echo '<category label="'.$dt.'" />';
					}
				}
				?>
			</categories>
			
			<?php
			if(!empty($dashboard_pergolongan['dataset'])){
				foreach($dashboard_pergolongan['dataset'] as $nama_gol => $dt_gol){
					echo '<dataset seriesName="Gol '.$nama_gol.'" showValues="0">';
					foreach($dt_gol as $dt){
						echo '<set value="'.$dt['total'].'" />';
					}
					echo '</dataset>';
				}
			}
			
			//<dataset seriesName='Gol I'  showValues='0'>
			?>			
		</chart> 
		<?php
	}
	**/
	
	public function dashboard_pergolongan(){
		$dashboard_pergolongan = $this->dashboard_model->dashboard_pergolongan();
		$golongan = array();
		$golongan2 = array();
		$n=0;
		if(!empty($dashboard_pergolongan['dataset'])){
			foreach($dashboard_pergolongan['dataset'] as $dt){
				foreach($dt as $dtt){
						$golongan[$dtt['golongan']][$dtt['kategori']]= $dtt['total'];
					}
				}
		}
		foreach($golongan as $k=>$v){
			$v['golongan']=$k;
			array_push($golongan2,$v);
		}
		
		//echo json_encode($golongan2);
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($golongan2));
	
	}
	
	public function dashboard_perpendidikan()
	{	
		//get dashboard_perpendidikan
		$dashboard_perpendidikan = $this->dashboard_model->dashboard_perpendidikan();
		$pegawai = array();
		$n=0;
		
		if(!empty($dashboard_perpendidikan)){
			foreach($dashboard_perpendidikan as $dt){
				//echo '<set label="'.$dt['nama'].'" value="'.$dt['total'].'" '.$issliced.'/>';
				$dt['color'] = $this->getColor($n);
					array_push($pegawai,$dt);				
				$n++;
			}
		}
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($pegawai));


	}
	
	public function dashboard_cuti_pegawai()
	{	
		
		
		//header("Content-type: text/xml");
		
		//get dashboard_cuti_pegawai
		$dashboard_cuti_pegawai = $this->dashboard_model->dashboard_cuti_pegawai_detail();
		$data = array();
		$n = 0;
		//<chart palette='3' yAxisMinValue='10' showValues='0' labelDisplay='Rotate' slantLabels='1'>
			if(!empty($dashboard_cuti_pegawai)){
				foreach($dashboard_cuti_pegawai as $dt){
					array_push($data,$dt);
					//echo '<set label="'.$dt['nama'].'" value="'.$dt['total'].'" />';
				}
			}
		$hasil = array();
		foreach($data as $k => $v){
			$hasil[0]['nama'] = 'Approve';
			$hasil[1]['nama'] = 'Submit';
			$hasil[0][$v['nama']] = $v['approve'];
			$hasil[1][$v['nama']] = $v['submit'];
		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($hasil));
		
	}
	
	/*public function dashboard_jumlah_peg_unit()
	{	
	
		header("Content-type: text/xml");
		
		//get dashboard_jumlah_peg_unit
		$dashboard_jumlah_peg_unit = $this->dashboard_model->dashboard_jumlah_peg_unit();
		
		?>
		<chart palette='4' showValues='0' decimals='0' formatNumberScale='0' showlabel="0" >
			
			<?php
			if(!empty($dashboard_jumlah_peg_unit)){
				
				foreach($dashboard_jumlah_peg_unit as $dt){
										
					echo '<set label="'.$dt['nama'].'" value="'.$dt['total'].'" />';
					
					
				}
			}
			?>
		</chart>	 
		<?php
	}*/
	public function dashboard_jumlah_peg_unit()
	{	
		
		$dashboard_jumlah_peg_unit = $this->dashboard_model->dashboard_jumlah_peg_unit();
		$unit = array();
		$n=0;
		if(!empty($dashboard_jumlah_peg_unit)){
				foreach($dashboard_jumlah_peg_unit as $dt){
					$dt['cl'] = $this->getColor($n);
						array_push($unit,$dt);				
					$n++;
				}
		}
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($unit));
	}
	
	//public function dashboard_jumlah_peg_pensiun()
	//{
	//	//Query Pensiun //
	//	$dashboard_jumlah_peg_pensiun = $this->pensiun_model->get_pensiun_forlist();
	//	
	//	//echo "<pre>";
	//	//print_r($dashboard_jumlah_peg_pensiun);
	//	//echo "</pre>";
	//	
	//	$datas = array();
	//	$today = date("Y-m-d");
	//	
	//	foreach($dashboard_jumlah_peg_pensiun as $row){
	//		$lahir_th = substr($row['nip_baru'], 0, 4);
	//		$lahir_bl = substr($row['nip_baru'], 4, 2);
	//		$lahir_tgl = substr($row['nip_baru'], 6, 2);
	//		echo $tgl_lahir = $lahir_th.'-'.$lahir_bl.'-'.$lahir_tgl;
	//		
	//		$selisih = datediff($tgl_lahir, $today);
	//		$usia_th = $selisih['years'];
	//		$usia_bl = $selisih['months'];
	//		$usia = $usia_th.'-'.$usia_bl.'bln';
	//		
	//		$tgl_pensiun = date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($tgl_lahir))+1,   date("d",strtotime($tgl_lahir)),   date("Y",strtotime($tgl_lahir))+56));
	//		
	//		if(!empty($row['eselon']) && ($row['eselon'] == 'I.a' || $row['eselon'] == 'I.b' || $row['eselon'] == 'II.a' || $row['eselon'] == 'II.b')){
	//			$tgl_pensiun  = date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($tgl_lahir))+1,   date("d",strtotime($tgl_lahir)),   date("Y",strtotime($tgl_lahir))+60));
	//		}
	//		
	//		$tgl_ewars_mk = mktime(0, 0, 0, date("m",strtotime($tgl_lahir))+6,   date("d",strtotime($tgl_lahir)),   date("Y",strtotime($tgl_lahir)));
	//		$tgl_ewars_y = date("Y", mktime(0, 0, 0, date("m",strtotime($tgl_lahir))+6,   date("d",strtotime($tgl_lahir)),   date("Y",strtotime($tgl_lahir))));
	//		$tgl_ewars_md = date("d-m", mktime(0, 0, 0, date("m",strtotime($tgl_lahir))+6,   date("d",strtotime($tgl_lahir)),   date("Y",strtotime($tgl_lahir))));
	//		$tgl_ewars = $tgl_ewars_md.'-'.($tgl_ewars_y+55);
	//		$tgl_ewars_mk = $tgl_ewars_mk + (55*86400);
	//			
	//		$today_mk = mktime(0, 0, 0, date("m",strtotime($today)),   date("d",strtotime($today)),   date("Y",strtotime($today)));
	//			
	//		//limit pensiun
	//		$limit = date("Y-m-d", mktime(0, 0, 0, date("m",strtotime($today))-7,   date("d",strtotime($today)),   date("Y",strtotime($today))));
	//		$limit_mk = mktime(0, 0, 0, date("m",strtotime($today))+7,   date("d",strtotime($today)),   date("Y",strtotime($today)));
	//		
	//		
	//		if($row['id'] == 0){
	//				if($tgl_pensiun >= $limit){
	//					
	//					//if(!empty($row['id'])){
	//					if($tgl_pensiun <= $today){
	//						$row['tgl_ewars'] = $tgl_ewars;
	//						$row['usia'] = $usia;
	//						$row['tgl_pensiun'] = $tgl_pensiun;
	//						if(!empty($row['gelar_belakang'])){
	//							$row['nama'] = $row['gelar_depan'].' '.ucwords(strtolower($row['nama'])).', '.$row['gelar_belakang'];
	//						}
	//						$row['nama'] = trim(ucwords(strtolower($row['nama'])));
	//						$datas[] = $row;
	//					}
	//				
	//				}
	//				
	//			}else{
	//			
	//				$row['tgl_ewars'] = $tgl_ewars;
	//				$row['usia'] = $usia;
	//				$row['tgl_pensiun'] = $tgl_pensiun;
	//				if(!empty($row['gelar_belakang'])){
	//					$row['nama'] = $row['gelar_depan'].' '.ucwords(strtolower($row['nama'])).', '.$row['gelar_belakang'];
	//				}
	//				$row['nama'] = trim(ucwords(strtolower($row['nama'])));
	//				$datas[] = $row;
	//			}
	//	} 
	//	
	//	//$this->output
	//	//	->set_content_type('application/json')
	//	//	->set_output(json_encode($datas));
	//
	//	//die(json_encode($datas));
	//}
	
	public function dashboard_total_pensiun(){
		//Query
		//$data = $this->db->get('pegawai')->result();
		$data = $this->info_model->getPensiun();
		
		$send = array();
		$output_bulan = array(
			'01' => "Jan",
			'02' => "Feb",
			'03' => "Mar",
			'04' => "Apr",
			'05' => "May",
			'06' => "Jun",
			'07' => "Jul",
			'08' => "Agu",
			'09' => "Sep",
			'10' => "Oct",
			'11' => "Nov",
			'12' => "Des"
		);
		$tgl = new DateTime(date('Y-m-d'));
		$kirim = array();
		foreach($data as $d){
			/*$tgl_lahir = $d['tanggal_lahir'];
			
			$tgl1  = new DateTime($tgl_lahir);
			$usia = $tgl->diff($tgl1);
			$tgl_pensiun  = date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($tgl_lahir))+1,   date("d",strtotime($tgl_lahir)),   date("Y",strtotime($tgl_lahir))+56));
				//Jika eselon I & II = 60th
			if(!empty($row['eselon']) && ($row['eselon'] == 'I.a' || $row['eselon'] == 'I.b' || $row['eselon'] == 'II.a' || $row['eselon'] == 'II.b')){
				$tgl_pensiun  = date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($tgl_lahir))+1,   date("d",strtotime($tgl_lahir)),   date("Y",strtotime($tgl_lahir))+60));
			}
			
			// E-warning 7 bulan sebelum pensiun
			$tgl_ewars_mk = mktime(0, 0, 0, date("m",strtotime($tgl_lahir))+6,   date("d",strtotime($tgl_lahir)),   date("Y",strtotime($tgl_lahir)));
			$tgl_ewars_y = date("Y", mktime(0, 0, 0, date("m",strtotime($tgl_lahir))+6,   date("d",strtotime($tgl_lahir)),   date("Y",strtotime($tgl_lahir))));
			$tgl_ewars_md = date("d-m", mktime(0, 0, 0, date("m",strtotime($tgl_lahir))+6,   date("d",strtotime($tgl_lahir)),   date("Y",strtotime($tgl_lahir))));
			$tgl_ewars = $tgl_ewars_md.'-'.($tgl_ewars_y+55);
			$tgl_e = date("m-Y",strtotime($tgl_ewars));
			$today = date("Y-m-d");
			$today_mk = mktime(0, 0, 0, date("m",strtotime($today)),   date("d",strtotime($today)),   date("Y",strtotime($today)));
			
			// limit pensiun Warning -7 Bulan dari Tanggal Pensiun
			$limit = date("Y-m-d", mktime(0, 0, 0, date("m",strtotime($today))-7,   date("d",strtotime($today)),   date("Y",strtotime($today))));
			$limit_mk = mktime(0, 0, 0, date("m",strtotime($today))+7,   date("d",strtotime($today)),   date("Y",strtotime($today)));
				//echo $limit_mk;
				//echo "<br>";
				
			if($d['id'] == 0){
				if($tgl_pensiun >= $limit){
					
					//if(!empty($row['id'])){
					if($tgl_pensiun <= $today){
						$d['tgl_e'] = $tgl_e;
						$d['tgl_ewars'] = $tgl_ewars;
						$d['usia'] = $usia;
						$d['tgl_pensiun'] = $tgl_pensiun;
						if(!empty($d['gelar_belakang'])){
							$d['nama'] = $d['gelar_depan'].' '.ucwords(strtolower($d['nama'])).', '.$d['gelar_belakang'];
						}
						$d['nama'] = trim(ucwords(strtolower($d['nama'])));
						$send[] = $d;
					}
				
				}
				
			}*/
			$send[] = $d;
			
			$tahun_awal = date("Y");
			$tahun = array(
				date("Y",strtotime("-3 year",strtotime($tahun_awal))),
				date("Y",strtotime("-2 year",strtotime($tahun_awal))),
				date("Y",strtotime("-1 year",strtotime($tahun_awal))),
				$tahun_awal
			);
			foreach($tahun as $t){
				$kirim[$t]['tahun']= $t;
				$i=0;
				foreach($output_bulan as $ko => $vo){
					$bln[$i] =$ko.'-'.$t;
					$kirim[$t][$vo] =0;
					foreach($send as $s){
						//if($bln[$i]==$s['tmt_pensiun']){
							$kirim[$t][$ko] = $kirim[$t][$vo]++;
						//}
					}
					$i++;
					unset($kirim[$t][$ko]);
				}
			}
		}
		
		$peg = array();
		foreach($kirim as $kk=>$vk){
			array_push($peg,$vk);
		}
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($peg));
	}
	
	public function dashboard_distribusi_pegawai()
	{	
	
		header("Content-type: text/xml");
		
		//get dashboard_distribusi_pegawai
		$dashboard_distribusi_pegawai = $this->dashboard_model->dashboard_distribusi_pegawai();
		
		//<entity id='01' value='100' toolText='Aceh&lt;BR&gt;100 Pegawai' color='0099FF'  />
		?>
		<map showMarkerLabels='1' fillColor='F1f1f1' borderColor='000033' connectorColor='FFFFFF' canvasBorderColor='FFCCCC' baseFont='Verdana' baseFontSize='10' baseFontColor='000000' markerBorderColor='000000' markerBgColor='FF5904' markerRadius='3' legendPosition='bottom' useHoverColor='1' showMarkerToolTip='1'  >
			<data>
				<?php
				if(!empty($dashboard_distribusi_pegawai)){
					foreach($dashboard_distribusi_pegawai as $dt){
					
						echo '<entity id="'.$dt['map_id'].'" value="'.$dt['total'].'" toolText="'.$dt['nama'].' '.$dt['total'].' Pegawai" color="'.$dt['map_color'].'" />';
					
					}					
				}
				?>
			</data>		
			<styles>
			   <definition>
				  <style name='MyFirstFontStyle' type='font' face='Verdana' size='11' color='black' bold='1' />
				  <style name='MyFirstAnimationStyle' type='animation' param='_xScale' start='100' duration='1' easing='bounce' />
				  <style name='MySecondAnimationStyle' type='animation' param='_yScale' start='4' duration='3' easing='elastic'/>
				  <style name='MyFirstShadow' type='animation' param='_y' start='0' duration='5' easing='bounce' />
				  <style name='TTipFont' type='font' isHTML='1'  color='FFFFFF' bgColor='666666' size='11'/>
			   </definition>
			   <application>
				  <apply toObject='Labels' styles='MyFirstFontStyle,MyFirstShadow' />
				  <apply toObject='Plot' styles='MyFirstAnimationStyle,MySecondAnimationStyle' />
				  <apply toObject='TOOLTIP' styles='TTipFont' />
			   </application> 
			</styles>
		</map>
		<?php
	}
	
}