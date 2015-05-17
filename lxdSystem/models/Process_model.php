<?php
/**
 * Created by PhpStorm.
 * @author jinliangping
 * @date 2015 15/5/15 上午11:45
 * @copyright 7659.com
 */
class Process_model extends MY_Model {

	public function getTotal($where='1') {
		$sql = "select id from ".$this->db->dbprefix('process')." where $where ";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function getList($offset, $number, $where='1',$order=' id desc ') {
		$sql = "select * from ".$this->db->dbprefix('process')." where $where order by $order limit $offset,$number";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function add($data) {
		return $this->db->insert('process', $data) ? $this->db->insert_id() : 0;
	}

	public function getRow($where) {
		if (empty($where)) {
			return false;
		}
		$sql   = 'select * from '.$this->db->dbprefix('process').' where '.$where.' order by id desc limit 0,1';
		$query = $this->db->query($sql);
		$order = $query->row_array();

		return $order;
	}

    public function edit($id,$data){
        $this->db->where('id', $id);
        return $this->db->update('process', $data);
    }
}
