<?php
/**
 * Created by PhpStorm.
 * @author jinliangping
 * @date 2015 15/5/15 上午11:45
 * @copyright 7659.com
 */
class Order_model extends MY_Model {

	public function getTotal($kw = null) {
		$filter = ' 1 ';
		$filter .= $kw?' and order_name like "%'.$kw.'%" ':'';
		$sql   = "select id from ".$this->db->dbprefix('order')." where $filter ";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function getList($offset, $number, $kw = null) {
		$filter = ' 1 ';
		$filter .= $kw?' and order_name like "%'.$kw.'%" ':'';
		$sql   = "select * from ".$this->db->dbprefix('order')." where $filter order by id asc limit $offset,$number";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function add($data) {
		return $this->db->insert('order', $data);
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
