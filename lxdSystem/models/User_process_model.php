<?php
/**
 * Created by PhpStorm.
 * @author jinliangping
 * @date 2015 15/5/15 上午11:45
 * @copyright 7659.com
 */
class User_process_model extends MY_Model {

	public function getTotal($kw = null) {

		$sql   = "select id from ".$this->db->dbprefix('user_process');
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function getList($offset, $number, $kw = null) {

		$sql   = "select a.id,a.process_num,a.create_time,b.username,b.truename,c.order_name,d.process_name,d.process_price from ".$this->db->dbprefix('user_process')." as a inner join ".$this->db->dbprefix('user')." as b on a.user_id=b.id inner join ".$this->db->dbprefix('order')." as c on a.order_id=c.id inner join ".$this->db->dbprefix('process')." as d on a.process_id=d.id order by b.username asc limit $offset,$number";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function add($data) {
		return $this->db->insert('user_process', $data);
	}

}
