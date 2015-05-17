<?php
/**
 * Created by PhpStorm.
 * @author jinliangping
 * @date 2015 15/5/15 上午11:45
 * @copyright 7659.com
 */
class Order_model extends MY_Model {

	public function getTotal($where = '1') {
        $where = $this->getWhereStr($where);
		$sql   = "select id from ".$this->db->dbprefix('order')." where $where ";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function getList($offset, $number, $where = '1',$order=' id desc') {
        $where = $this->getWhereStr($where);
		$sql   = "select * from ".$this->db->dbprefix('order')." where $where order by $order limit $offset,$number";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function add($data) {
		return $this->db->insert('order', $data) ? $this->db->insert_id() : 0;
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
    //订单插入和订单工序关联插入
    public function addOrderProcess(array $order_data,array $order_process_id) {
        $p_id = '"'.implode('","',$order_process_id).'"';
        $sql = "select sum(process_price) as price from ".$this->db->dbprefix('process')." where id in ($p_id) ";
        $query = $this->db->query($sql);
        $res = $query->row_array();
        $order_data['order_mate_amount'] = round($res['price']*$order_data['order_num'],2);
        $this->db->trans_start();
        $this->db->insert('order',$order_data);
        $o_id = $this->db->insert_id();
        foreach($order_process_id as $k=>$v){
            $this->db->insert('order_process',array('order_id'=>$o_id,'process_id'=>$v,'create_time'=>TIMESTAMP));
        }
        return !($this->db->trans_complete()===false);
    }

    public function getProcessNum($order_id){
        $sql = "select count(id) as total from ".$this->db->dbprefix('order_process')." where order_id='$order_id' ";
        $query = $this->db->query($sql);
        $res = $query->row_array();
        return $res['total'];
    }
}
