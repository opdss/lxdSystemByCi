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

	public function getRow($where=' 1 ') {
		$where = $this->getWhereStr($where);
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
    //获取某订单的相关工序
    public function getOrderProcess($oid){
        $sql = " select a.id,a.process_id,b.process_name,b.process_price,b.process_desc from ".$this->db->dbprefix('order_process')." as a left join ".$this->db->dbprefix('process')." as b on b.id=a.process_id where order_id='$oid'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    //追加订单工序
    public function addProcessForOrder($order_id,array $order_process_id) {
        if(!$order_id || empty($order_process_id)){
            return false;
        }
        $this->db->trans_start();
        foreach($order_process_id as $k=>$v){
            $this->db->insert('order_process',array('order_id'=>$order_id,'process_id'=>$v,'create_time'=>TIMESTAMP));
        }
        $this->updateOrderMateAmount($order_id);
        return !($this->db->trans_complete()===false);
    }
    //更新订单据工序的预估成本
    public function updateOrderMateAmount($order_id){
        $sql = "select sum(process_price) as price from ".$this->db->dbprefix('process')." where id in (select process_id as id from ".$this->db->dbprefix('order_process')." where order_id=$order_id) ";
        $query = $this->db->query($sql);
        $process = $query->row_array();
        //$sql = "select order_num from ".$this->db->dbprefix('order')." where id=$order_id ";
        //$query = $this->db->query($sql);
        //$order = $query->row_array();
        //$price = $order*$process;
        $sql = "update t_order set order_mate_amount=(order_num*".$process['price'].") where id=$order_id";
        return $this->db->query($sql);
    }
    //删除order_process记录
    public function delOrderProcess($id){
        $this->db->trans_start();
        $sql = "select order_id from ".$this->db->dbprefix('order_process')." where id=$id ";
        $query = $this->db->query($sql);
        $order = $query->row_array();
        $order_id = $order['order_id'];
        $sql = "delete from ".$this->db->dbprefix('order_process')." where id=$id";
        $this->db->query($sql);
        $this->updateOrderMateAmount($order_id);
        return !($this->db->trans_complete()===false);
    }
}
