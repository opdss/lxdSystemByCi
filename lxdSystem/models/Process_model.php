<?php
/**
 * Created by PhpStorm.
 * @author jinliangping
 * @date 2015 15/5/15 上午11:45
 * @copyright 7659.com
 */
class Process_model extends MY_Model {

	public function getTotal($kw = null) {
		$filter = ' 1 ';
		$filter .= $kw?' and order_name like "%'.$kw.'%" ':'';
		$sql   = "select id from ".$this->db->dbprefix('process')." where $filter ";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function getList($offset, $number, $kw = null, $where = null) {
		$filter = ' 1 ';
		$filter .= $kw?' and a.process_name like "%'.$kw.'%" ':'';
		$filter .= $where?' and '.$where:'';
		$sql   = "select a.id,a.process_name,a.create_time,a.process_price,b.order_name from ".$this->db->dbprefix('process')." as a left join ".$this->db->dbprefix('order')." as b on a.order_id=b.id where $filter order by a.id asc limit $offset,$number";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function add($data) {
		return $this->db->insert('process', $data);
	}

	public function getRow($where) {
		if (empty($where)) {
			return false;
		}
		$sql   = 'select * from '.$this->db->dbprefix('order').' where '.$where.' order by id desc limit 0,1';
		$query = $this->db->query($sql);
		$order = $query->row_array();

		return $order;
	}
}
