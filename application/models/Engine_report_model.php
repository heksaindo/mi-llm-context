<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class engine_report_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function get_report($id = '') 
	{
		$this->db->from('report_data');
		$this->db->select('*');
		
		if(!empty($id)){
			$this->db->where('id_report', $id);
		}
		$query = $this->db->get();
		
		if(!empty($id)){
			return $query->row_array();
		}else{
			return $query->result_array();
		}
	}
	
	function get_byId($id) 
	{
		$this->db->where('id_report', $id);
		$query = $this->db->get('report_data');

		return $query->row_array();
	}

	
	public function insert_data($data)
	{
		$this->db->insert('report_data', $data);
		
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;
	}

	public function update_data($data, $id)
	{
		$this->db->where('id_report', $id);
		$update = $this->db->update('report_data', $data);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function delete_data($id)
	{
		$this->db->where('id_report', $id);
		$delete = $this->db->delete('report_data');
		
		return (isset($delete)) ? true : FALSE;
	}	
	
	public function running_report($info_report)
	{
		$ret_data = array();
		
		if(!empty($info_report)){
						
			$use_child = 0;			
			$have_sums = false;
			$all_header_data = array();						
			$data_header_parent = array();						
			$data_header_child = array();			
			$data_table = array();
			$data_table_id = array();
			$data_table_name = array();
			$all_req_field = array();
			$all_select = '';
			$all_join_field = array();
			$cek_join_table = array();
			$data_group_by = array();
			$data_order_by = array();
			$result_report = array();
			
			//preparing query
			$this->db->select("a.id_rdd, a.id_rtf, a.header_name, a.parent_id, a.level_header, a.output_format, a.rdd_order,
			b.id_rtg, b.tf_name, b.ref_field, b.tf_tipe, b.option_value, b.tf_additional_sql_select,
			b.tf_additional_sql_join, b.tf_additional_sql_where, b.tf_additional_sql_order_group, b.require_sql,
			c.group_name, c.ref_table");
			$this->db->from('report_data_detail as a');
			$this->db->join('report_table_field as b','b.id_rtf = a.id_rtf', "LEFT");
			$this->db->join('report_table_group as c','c.id_rtg = b.id_rtg', "LEFT");
			$this->db->where('a.id_report', $info_report['id_report']);
			$this->db->order_by('a.parent_id, a.rdd_order','ASC');
			$get_detail = $this->db->get();
			
			if($get_detail->num_rows() > 0){
				foreach($get_detail->result_array() as $dt_field){
				
					if(!empty($dt_field['parent_id']) AND $use_child == 0){
						$use_child = 1;
					}

					$ref_field_data = $dt_field['ref_field'];
					if(strstr($ref_field_data, '.')){
						$exp_ref_field = explode('.',$ref_field_data);
						$ref_field_data = $exp_ref_field[1];
					}
					
					$all_header_data[] = array(
						'header_name' 	=> $dt_field['header_name'],
						'ref_field' 	=> $ref_field_data,
						'output_format' => $dt_field['output_format'],
						'id_rtf' => $dt_field['id_rtf']
					);
					
					
					if(empty($dt_field['parent_id'])){
						$data_header_parent[$dt_field['id_rdd']] = array(
							'id_rdd' 		=> $dt_field['id_rdd'],
							'header_name' 	=> $dt_field['header_name'],
							'parent_id' 	=> $dt_field['parent_id'],
							'ref_field' 	=> $ref_field_data,
							'ref_table' 	=> $dt_field['ref_table'],
							'output_format' => $dt_field['output_format'],
							'id_rtf' => $dt_field['id_rtf']
						);
					}else{
					
						if(empty($data_header_child[$dt_field['parent_id']])){
							$data_header_child[$dt_field['parent_id']] = array();
						}
						
						$data_header_child[$dt_field['parent_id']][$dt_field['id_rdd']] = array(
							'id_rdd' 		=> $dt_field['id_rdd'],
							'header_name' 	=> $dt_field['header_name'],
							'parent_id' 	=> $dt_field['parent_id'],
							'ref_field' 	=> $ref_field_data,
							'ref_table' 	=> $dt_field['ref_table'],
							'output_format' => $dt_field['output_format'],
							'id_rtf' => $dt_field['id_rtf']
						);
					}
					
					if(!empty($dt_field['ref_table'])){
						if(!in_array($dt_field['ref_table'], $data_table)){
							$data_table[] = $dt_field['ref_table'];
							$data_table_id[$dt_field['ref_table']] = $dt_field['id_rtg'];
							$data_table_name[$dt_field['id_rtg']] = $dt_field['ref_table'];
						}
					}
					
					if(!empty($dt_field['ref_field'])){
					
						//b.tf_additional_sql_select,
						//b.tf_additional_sql_join, 
						//b.tf_additional_sql_where, 
						//b.require_sql
						
						if(empty($all_req_field[$dt_field['id_rtf']])){
							$all_req_field[$dt_field['id_rtf']] = $dt_field['id_rtf'];
						}
						
						//get select						
						if(!empty($dt_field['tf_additional_sql_select'])){
						
							//check if CONCAT							
							if(strstr($dt_field['tf_additional_sql_select'],'CONCAT')){
								//$trans = array("CONCAT(" => '', ")" => '');
								//$concat_txt = strtr($dt_field['tf_additional_sql_select'], $trans);
								//$concat_exp = explode(',',$concat_txt);

								$dt_field['tf_additional_sql_select'] .= ' as '.$dt_field['ref_field'];
							}
								
							//sheck SUM	
							if(strstr($dt_field['tf_additional_sql_select'],'SUM(')){
								$have_sums = true;
								$dt_field['tf_additional_sql_select'] .= ' as '.$dt_field['ref_field'];
							}
						
							if(empty($all_select)){
								$all_select = $dt_field['tf_additional_sql_select'];
							}else{
								$all_select .= ', '.$dt_field['tf_additional_sql_select'];
							}
							//echo $dt_field['tf_additional_sql_select'].' <br/>';
						}else{
							if(empty($all_select)){
								$all_select = $dt_field['ref_table'].'.'.$dt_field['ref_field'];
							}else{
								$all_select .= ', '.$dt_field['ref_table'].'.'.$dt_field['ref_field'];
							}
							//echo $dt_field['ref_table'].'.'.$dt_field['ref_field'].' <br/>';
						}
						
						//get table		
						if(!empty($dt_field['tf_additional_sql_join'])){
							$update_join_sql = str_replace('{tbl}',$dt_field['ref_table'],$dt_field['tf_additional_sql_join']);
							
							$reg_join_table = explode(' ON ',$update_join_sql);
														
							//check if req field is available
							if(!empty($dt_field['require_sql'])){
								
								if($dt_field['require_sql'] != $dt_field['id_rtf']){
									
									if(!empty($all_req_field[$dt_field['require_sql']])){
										if(!empty($reg_join_table[0])){
											if(!in_array($reg_join_table[0], $cek_join_table)){
												$cek_join_table[] = $reg_join_table[0];
												$all_join_field[] = $update_join_sql;
											}
										}
									}
								
								}else{
									
									if(!empty($reg_join_table[0])){
										if(!in_array($reg_join_table[0], $cek_join_table)){
											$cek_join_table[] = $reg_join_table[0];
											$all_join_field[] = $update_join_sql;
										}
									}
									
								}
							}else{
								if(!empty($reg_join_table[0])){
									if(!in_array($reg_join_table[0], $cek_join_table)){
										$cek_join_table[] = $reg_join_table[0];
										$all_join_field[] = $update_join_sql;
									}
								}
							}
							
							//echo $update_join_sql.'<br/>';
						}
						
						if(!empty($dt_field['tf_additional_sql_order_group'])){
							//GROUP
							if(strstr($dt_field['tf_additional_sql_order_group'],'GROUP BY')){
								$trans = array("GROUP BY " => '', "{tbl}" => $dt_field['ref_table']);
								$group_by_txt = strtr($dt_field['tf_additional_sql_order_group'], $trans);
								
								if(!in_array($group_by_txt, $data_group_by)){
									$data_group_by[] = $group_by_txt;
								}
								
							}
							
							//ORDER
							if(strstr($dt_field['tf_additional_sql_order_group'],'ORDER BY')){
								$trans = array("ORDER BY " => '', "{tbl}" => $dt_field['ref_table']);
								$ORDER_by_txt = strtr($dt_field['tf_additional_sql_order_group'], $trans);
								
								if(!in_array($ORDER_by_txt, $data_order_by)){
									$data_order_by[] = $ORDER_by_txt;
								}
								
							}
						}
						
					}
				}

				//check report_table_group_relasi
				$dt_relasi = array();
				$dt_relasi_table = array();
				if(!empty($data_table[0])){
					$id_main_table = $data_table_id[$data_table[0]];
					$this->db->from('report_table_group_relasi');
					$this->db->where("id_rtg_from = '".$id_main_table."' OR id_rtg_to = '".$id_main_table."'");
					$get_relasi = $this->db->get();
					if($get_relasi->num_rows() > 0){
						foreach($get_relasi->result() as $dtRel){
							if($dtRel->id_rtg_from == $id_main_table){
								$dt_relasi[$dtRel->id_rtg_to] = $dtRel->relasi_rtg;
							}
							
							if($dtRel->id_rtg_to == $id_main_table){
								$dt_relasi[$dtRel->id_rtg_from] = $dtRel->relasi_rtg;
							}
							
							$dt_relasi_antar_table[$dtRel->id_rtg_from.'_'.$dtRel->id_rtg_to] = $dtRel->relasi_rtg;
						}
					}
				}
				
				$query_text = 'SELECT '.$all_select.' FROM ';			
				
				$no = 1;
				$main_tbl = '';
				foreach($data_table as $tbl){
					
					if($no == 1){
						//main table
						$main_tbl = $tbl;
						$query_text .= $tbl;
					}else{
						
						//echo $tbl.'<br/>';
						//check if has relation to main table
						$id_selected_table = $data_table_id[$tbl];
						if(!empty($dt_relasi[$id_selected_table])){
							
							$tbl1 = $data_table_name[$id_selected_table];
							$tbl2 = $data_table_name[$id_main_table];
							
							$trans = array("{tbl1}" => $tbl1, "{tbl2}" => $tbl2);
							$relasi_txt = strtr($dt_relasi[$id_selected_table], $trans);

							$query_text .= ' LEFT JOIN '.$tbl.' ON '.$relasi_txt;
						}else{
							//dt_relasi_antar_table
						}
					}
					
					$no++;
				}

				
				if(!empty($all_join_field)){
					foreach($all_join_field as $join_tbl){
						$query_text .= ' '.$join_tbl;
					}
				}
				
				//GROUP OR ORDER BY
				if(!empty($data_group_by)){
					$all_group_by_txt = '';
					foreach($data_group_by as $dtG){
						if(empty($all_group_by_txt)){
							$all_group_by_txt = $dtG;
						}else{
							$all_group_by_txt .= ','.$dtG;
						}
					}
					
					if(!empty($all_group_by_txt)){
						$query_text .= ' GROUP BY '.$all_group_by_txt;
					}
				}
				
				//echo '<pre>';
				//print_r($dt_relasi);
				
				//echo $query_text;
				$result_report = array();
				$get_result_report = $this->db->query($query_text);
				if($get_result_report->num_rows() > 0){
					$result_report = $get_result_report->result_array();
				}
				
				//print_r($all_header_data);
				
				//echo $all_select;
				//echo '<pre>';
				//print_r($data_table);
				
			}
			
			
			
			$ret_data = array(
				'use_child'			=> $use_child,
				'have_sums'			=> $have_sums,
				'all_header_data'	=> $all_header_data,
				'data_header_parent'=> $data_header_parent,
				'data_header_child'	=> $data_header_child,
				'data_table'		=> $data_table,
				'result_report'		=> $result_report
			);
			
		}
		
		return $ret_data;
	}
		
	
	public function setting_report($info_report)
	{
		$ret_data = array();
		
		if(!empty($info_report)){
			
			$this->db->select("a.*, b.tf_name as field_name, c.id_rtg, c.group_name as table_name");
			$this->db->from('report_data_detail as a');
			$this->db->join('report_table_field as b',"b.id_rtf = a.id_rtf","LEFT");
			$this->db->join('report_table_group as c',"c.id_rtg = b.id_rtg","LEFT");

			if(!empty($info_report['id_report'])){
				$this->db->where('a.id_report', $info_report['id_report']);
			}
			
			$this->db->order_by('a.parent_id','ASC');
			$this->db->order_by('a.rdd_order','ASC');
			$query = $this->db->get();
			
			$data_setting = array();
			if($query->num_rows() > 0){
				foreach($query->result_array() as $dt){
					
					if(empty($data_setting[$dt['parent_id']])){
						$data_setting[$dt['parent_id']] = array();
					}
					
					$data_setting[$dt['parent_id']][] = $dt;
					
				}
			}
			
			if(!empty($data_setting)){
				$ret_data = $this->rearrange_data(0, $data_setting);
			}
			
		}
		
		return $ret_data;
	}
	
	function rearrange_data($parent_id, $data, $re_arr_data = array()){
		
		if(!empty($data[$parent_id])){
			foreach($data[$parent_id] as $dtParent){
				
				$re_arr_data[] = $dtParent;
				//check child
				if(!empty($data[$dtParent['parent_id']])){
					$get_child = $this->rearrange_data($dtParent['id_rdd'], $data);
				}
				
				if(!empty($get_child)){
					foreach($get_child as $dtChild){
						$re_arr_data[] = $dtChild;
					}
				}
			
			}
		
		}
		
		return $re_arr_data;
		
	}
	
	function get_setting($id) 
	{
		$this->db->select("a.*, b.tf_name as field_name, c.id_rtg, c.group_name as table_name");
		$this->db->from('report_data_detail as a');
		$this->db->join('report_table_field as b',"b.id_rtf = a.id_rtf","LEFT");
		$this->db->join('report_table_group as c',"c.id_rtg = b.id_rtg","LEFT");

		$this->db->where('a.id_rdd', $id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			return $query->row_array();
		}else{
			return array();
		}
	}
	
	public function insert_setting($data)
	{
		$this->db->insert('report_data_detail', $data);
		
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;
	}

	public function update_setting($data, $id)
	{
		$this->db->where('id_rdd', $id);
		$update = $this->db->update('report_data_detail', $data);
		
		return (isset($update)) ? true : FALSE;
	}
	
	public function delete_setting($id)
	{
		$this->db->where('id_rdd', $id);
		$delete = $this->db->delete('report_data_detail');
		
		return (isset($delete)) ? true : FALSE;
	}
	
	public function get_rtg_field($id_rtg) 
	{
		$this->db->select('a.*');
		$this->db->from('report_table_field as a');
		
		$this->db->where('a.id_rtg', $id_rtg);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	
	public function get_setting_parent($id_report, $id_curr){
		
		$this->db->select('a.*');
		$this->db->from('report_data_detail as a');
		
		$this->db->where('a.id_report', $id_report);
		
		if(!empty($id_curr)){
			$this->db->where('a.id_rdd != '.$id_rdd);
		}
		
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	
}