<?php
/**
 * Created by PhpStorm.
 * @author wuxin
 * @date 2015 15/5/9 下午6:45
 * @copyright 7659.com
 */
class Role_model extends MY_Model {

    public function getTotal($kw=null){
        $filter = ' 1 ';
        $filter .= $kw ? ' and role_name like "%'.$kw.'%" ' : '';
        $sql = "select id from ".$this->db->dbprefix('role')." where $filter ";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function getList($offset,$number,$kw=null){
        $filter = ' 1 ';
        $filter .= $kw ? ' and role_name like "%'.$kw.'%" ' : '';
        $sql = "select * from ".$this->db->dbprefix('role')." where $filter order by id asc limit $offset,$number";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}