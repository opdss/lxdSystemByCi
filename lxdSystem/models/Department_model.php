<?php
/**
 * Created by PhpStorm.
 * @author jinliangping
 * @date 2015 15/5/12 下午5:45
 * @copyright 7659.com
 */
class Department_model extends MY_Model {

	public function getTotal($kw = null) {
		$filter = ' 1 ';
		$filter .= $kw?' and role_name like "%'.$kw.'%" ':'';
		$sql   = "select id from ".$this->db->dbprefix('department')." where $filter ";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function getList($offset, $number, $kw = null) {
		$filter = ' 1 ';
		$filter .= $kw?' and role_name like "%'.$kw.'%" ':'';
		$sql   = "select * from ".$this->db->dbprefix('department')." where $filter order by id asc limit $offset,$number";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function add($data) {
		return $this->db->insert('department', $data);
	}
}
