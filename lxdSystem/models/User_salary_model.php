<?php
/**
 * Created by PhpStorm.
 * User: jlping
 * Date: 15/5/20
 * Time: 15:06
 */
class User_salary_model extends MY_Model {


    public function add($data) {
        return $this->db->insert('user_salary', $data);
    }

    public function getTotal($where='1') {
        $where = $this->getWhereStr($where);
        $sql   = "select id from ".$this->db->dbprefix('user_salary')." where $where ";;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function getList($offset, $number,$where='1', $order=' id desc ') {
        $where = $this->getWhereStr($where);
        $sql   = "select * from ".$this->db->dbprefix('user_salary')." where $where order by $order limit $offset,$number";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function edit($sign,$data){
        $this->db->where('sign', $sign);
        return $this->db->update('user_salary', $data);
    }


}