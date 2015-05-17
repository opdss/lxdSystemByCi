<?php
/**
 * Created by PhpStorm.
 * @author wuxin
 * @date 2015 15/5/9 下午6:45
 * @copyright 7659.com
 */
class Role_model extends MY_Model {

    public function getTotal($where='1'){
        $where = $this->getWhereStr($where);
        $sql = "select id from ".$this->db->dbprefix('role')." where $where ";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function getList($offset,$number,$where='1',$order='id asc '){
        $where = $this->getWhereStr($where);
        $sql = "select * from ".$this->db->dbprefix('role')." where $where order by $order limit $offset,$number";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getRoleInfo($id){
        $this->db->where('id',$id);
        $query = $this->db->get('role');
        return $query->row_array();
    }

    public function add($data){
        return $this->db->insert('role',$data) ? $this->db->insert_id() : 0;
    }

    public function edit($id,$data){
        $this->db->where('id', $id);
        return $this->db->update('role', $data);
    }

    public function del($id){
        $this->db->where('id', $id);
        return $this->db->delete('role');
    }
}
