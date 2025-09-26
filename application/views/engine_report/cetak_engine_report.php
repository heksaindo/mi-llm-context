<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
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
		.printable{
			color: #000;
			font-family: tahoma, verdana, sans-serif;
			font-size: 11px;
			width:100%;
		}

		.printable table{	
		  border-collapse: collapse;
		  color: #000;
		  font-family: tahoma, verdana, sans-serif;
		  font-size: 11px;
		}

		.printable table tr td { 
		  padding:2px 5px;
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
		  border-bottom: 1px solid #000;
		}
		.printable table.header td.border-top {
		  border-top: 1px solid #000;
		}

		.printable table.header td.title {
			margin: 0;
			font-size: 14px;
			font-weight:bold;
		}

		.printable table.header td {
			font-size: 11px;
		}

		/*just border*/
		.printable table.table_border{
			border:1px solid #000;
		}

		.printable table.table_border tr td{
			padding:3px 5px;
			border-bottom:1px solid #000;
		}

		/*table skin with odd even bg*/
		.printable table.grid_table { 
		  font-size: 11px;
		}

		.printable table.grid_table { 
		  border: 1px solid #000;
		}

		.printable table.grid_table tr th,
		.printable table.grid_table tr td { 
		  border: 1px solid #000;
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
			border:1px solid #000;
			border-left:0px solid #000;
			vertical-align: middle;
		}

		.printable table.grid_table tr.table_header th.td_first,
		.printable table.grid_table tr.table_header td.td_first{
			border:1px solid #000;
		}

		.printable table.grid_table tr.even_row td,
		.printable table tr.even_row td {
			background-color: #F6F6F6;
			border-bottom: 1px solid #aaaaaa;
			font-size: 11px;
		}

		.printable table.grid_table tr.odd_row td,
		.printable table tr.odd_row td {
			background-color: transparent;
			border-bottom: 1px solid #aaaaaa;
			font-size: 11px;
		}

		.printable table.grid_table tr.even_row.no_border td,
		.printable table tr.even_row.no_border td {
			border-bottom: 0px solid #aaaaaa;
			font-size: 11px;
		}

		.printable table.grid_table tr.odd_row.no_border td,
		.printable table tr.odd_row.no_border td {
			border-bottom: 0px solid #aaaaaa;
			font-size: 11px;
		}

		.printable table.grid_table tr.with_border td,
		.printable table tr.with_border td {
			border: 1px solid #FFF;
			border-bottom: 1px solid #000;
		}
		
		.printable table.grid_table tr.clear_border td,
		.printable table tr.clear_border td {
			border: 1px solid #FFF;
		}

		.printable table.grid_table tr.clear_border2 td,
		.printable table tr.clear_border2 td {
			border: 1px solid #FFF;
			border-bottom:0px solid #000;
		}

		.printable table tr th.left, .printable table tr td.left{text-align:left;}
		.printable table tr th.right, .printable table tr td.right{text-align:right;}
		.valign_top{vertical-align:top;}
		.valign_mid{vertical-align:mid;}
		.valign_btm{vertical-align:bottom;}
		.table_bg_line{background: url(../images/bg_table_report.png) repeat-x;}
		.title_header{font-size:14px; font-weight:bold;}

		.box_memo { 
		  border: 1px solid #000;
		  padding:2px 5px;
		  width:150px;
		  height: 20px;
		}
		.box_memo2 { 
		  border: 1px solid #000;
		  padding:2px 5px;
		  width:300px;
		  height: 20px;
		}
		
		.printable table.grid_table tr.bold td {
			border-top: 1px solid #000;
		}
		
		.printable table.tbl_footer tr td {
			padding:20px 10px;
			text-align:center;
		}
		
	</style>
</head>
<body>

    <!-- Media datatable -->
	<div class="printable">

		<div class="table-overflow">
			<table class="grid_table" width="100%">
				<thead>
					<?php
					$report_header = $info_report['report_name'];
					
					if(!empty($info_report['report_header'])){
						$trans = array("\n" => '<br/>');
						$report_header = strtr($info_report['report_header'], $trans);
					}
					
					?>
					<tr class="clear_border" >
						<td colspan="20" align="center">
							<h3><?php echo $report_header; ?></h3>
						</td>
					</tr>
					<tr class="clear_border2">
						<td colspan="20" class="uppercase" align="right">TANGGAL CETAK : <?php echo strftime( "%d %B %Y %H:%M:%S", time());?></td>
					</tr>
					<?php 
						$all_cols = 0;
						$colspan_sums = 0;
						$header_data_ready = array();
						if(!empty($data_report['data_header_parent'])){
											
											
							$rowspan = '';
							if(!empty($data_report['use_child'])){
								$rowspan = ' rowspan="2"';
							}
							
							echo '<tr class="table_header">'."\n";
							//PARENT HEADER
							$no_kolom = 1;
							foreach($data_report['data_header_parent'] as $dtheader){
								
								$header_rowspan = $rowspan;
								
								//check child
								$header_colspan = '';
								$td_first = '';
								if(!empty($data_report['data_header_child'][$dtheader['id_rdd']])){
									$total_child = count($data_report['data_header_child'][$dtheader['id_rdd']]);
									$header_colspan = ' colspan="'.$total_child.'" style="text-align:center;"';
									$header_rowspan = '';
									//$all_cols += $total_child;
									
									if($no_kolom == 1){
										$td_first = ' class="td_first" ';
									}
									
									if($total_child > 0){
										foreach($data_report['data_header_child'][$dtheader['id_rdd']] as $dtC){
											$header_data_ready[$no_kolom] = $dtC;
											$no_kolom++;
										}
									}
									
									
								}else{
									$all_cols++;											
									if($dtheader['output_format'] == 'total' AND $colspan_sums == 0){
										$colspan_sums = $all_cols;
									}											
									
									if($no_kolom == 1){
										$td_first = ' class="td_first" ';
									}
									
									$header_data_ready[$no_kolom] = $dtheader;
									$no_kolom++;
									
								}
																		
								echo '<th'.$td_first.$header_rowspan.$header_colspan.'>'.$dtheader['header_name'].'</th>'."\n";
								
							}
							echo '</tr>'."\n";
							
							if(!empty($data_report['data_header_child'])){
								echo '<tr class="table_header">'."\n";
								foreach($data_report['data_header_child'] as $keyChild => $dtChild){
									if(!empty($dtChild)){
										foreach($dtChild as $dtC){
											echo '<th>'.$dtC['header_name'].'</th>'."\n";
											$all_cols++;											
											if($dtC['output_format'] == 'total' AND $colspan_sums == 0){
												$colspan_sums = $all_cols;
											}
										}
									}
								}
								echo '</tr>'."\n";
							}
						}
					?>                               
				</thead>
				<tbody>
					<?php 
					//echo '<pre>';
					//print_r($header_data_ready);
					$no = 1;				
					if(!empty($data_report['result_report'])){
						foreach ($data_report['result_report'] as $dtRes){
							
						?>
							<tr class="odd_row">
							<?php
							$no_kolom_data = 1;
							foreach($header_data_ready as $dtHeader){
														
								if($no_kolom_data == 1){
									$td_first = ' class="td_first"';
								}
								
								if(!empty($dtHeader['ref_field'])){
									$dt_value = '&nbsp;';
									if(!empty($dtRes[$dtHeader['ref_field']])){
										$dt_value = $dtRes[$dtHeader['ref_field']];
									}
									echo '<td'.$td_first.'>'.$dt_value.'</td>';
								}else
								{
									if(!empty($dtHeader['id_rtf'])){
										echo '<td'.$td_first.'>&nbsp;</td>';
									}else{
										if($dtHeader['output_format'] == 'autonumber'){
											echo '<td'.$td_first.'>'.$no.'</td>';
										}
									}
								}
								
								$no_kolom_data++;
							}
							
							/*foreach($data_report['all_header_data'] as $dtHeader){
								
								if(!empty($dtHeader['ref_field'])){
									$dt_value = '&nbsp;';
									if(!empty($dtRes[$dtHeader['ref_field']])){
										$dt_value = $dtRes[$dtHeader['ref_field']];
									}
									echo '<td>'.$dt_value.'</td>';
								}else
								{
									if(!empty($dtHeader['id_rtf'])){
										echo '<td>&nbsp;</td>';
									}else{
										if($dtHeader['output_format'] == 'autonumber'){
											echo '<td>'.$no.'</td>';
										}
									}
								}										
							}*/									
							?>
							</tr>
						<?php
							$no++;
						}
					}
					
					/*if($colspan_sums){
							
						$no_summary = 1;
						foreach($data_report['all_header_data'] as $dtHeader){
							if($no_summary == $colspan_sums){
								
							}
							$no_summary++;
						}
					}*/
					?>
				</tbody>
			</table>
			<?php
				$trans = array("\n" => '<br/>');				
									
				$report_footer_left = '&nbsp;';				
				if(!empty($info_report['report_footer_left'])){
					$report_footer_left = strtr($info_report['report_footer_left'], $trans);
				}
				
				$report_footer_center = '&nbsp;';				
				if(!empty($info_report['report_footer_center'])){
					$report_footer_center = strtr($info_report['report_footer_center'], $trans);
				}
				
				$report_footer_right = '&nbsp;';				
				if(!empty($info_report['report_footer_right'])){
					$report_footer_right = strtr($info_report['report_footer_right'], $trans);
				}
				
			?>
			<table width="100%" class="tbl_footer">
				<tr>
					<td width="30%"><?php echo $report_footer_left; ?></td>
					<td width="40%"><?php echo $report_footer_center; ?></td>
					<td width="30%"><?php echo $report_footer_right; ?></td>
				</tr>
			</table>
			<br/>
		</div>
	</div>
	<!-- /media datatable -->
	
	<script type="text/javascript">
        window.print();
    </script>
</body>
</html>