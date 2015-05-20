<?php
/**
 * Created by PhpStorm.
 * @author jinliangping
 * @date 2015 15/5/15 上午11:45
 * @copyright 7659.com
 */
class User_process_model extends MY_Model {

	public function getTotal($where = '1') {
        $where = $this->getWhereStr($where);
		$sql   = "select id from ".$this->db->dbprefix('user_process')." where $where ";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function getList($offset, $number,$where='1') {
        $where = $this->getWhereStr($where);
		$sql   = "select a.id,a.process_num,a.create_time,a.work_month,b.username,b.truename,e.order_name,e.id as order_id,d.process_name,d.process_price from ".$this->db->dbprefix('user_process')." as a inner join ".$this->db->dbprefix('user')." as b on a.user_id=b.id inner join ".$this->db->dbprefix('order_process')." as c on a.order_process_id=c.id inner join ".$this->db->dbprefix('process')." as d on c.process_id=d.id inner join ".$this->db->dbprefix('order')." as e on c.order_id=e.id where $where order by b.username asc limit $offset,$number";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function add($data) {
		return $this->db->insert('user_process', $data);
	}

    //判断是否添加了该员工工序
    public function checkUserProcess($where){
        $sql = "select * from ".$this->db->dbprefix('user_process')." where $where ";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

}
