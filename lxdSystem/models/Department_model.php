<?php
/**
 * Created by PhpStorm.
 * @author jinliangping
 * @date 2015 15/5/12 下午5:45
 * @copyright 7659.com
 */
class Department_model extends MY_Model {

    public function getTotal($where='1'){
        $where = $this->getWhereStr($where);
        $sql = "select id from ".$this->db->dbprefix('department')." where $where ";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

	public function getList($offset, $number, $where = '1', $order = ' id asc ') {
        $where = $this->getWhereStr($where);
		$sql   = "select * from ".$this->db->dbprefix('department')." where $where order by $order limit $offset,$number";
		$query = $this->db->query($sql);
		return $query->result_array();
	}


    /**
     * @param array $items
     * @return array
     * 无限极分类，生成树状结构
     */
    public function generateTree($items,$pid=0,$level=1){
        $tree = array();
        foreach($items as $item){
            if($item['pid']==$pid){
                $item['level'] = $level;
                $tree[] = $item;
                $tree = array_merge($tree,$this->generateTree($items,$item['id'],$level+1));
            }
        }
        return $tree;
    }

    public function getRowById($id){
        $this->db->where('id',$id);
        $query = $this->db->get('department');
        return $query->row_array();
    }

    public function add($data){
        return $this->db->insert('department',$data) ? $this->db->insert_id() : 0;
    }

    public function edit($id,$data){
        $this->db->where('id', $id);
        return $this->db->update('department', $data);
    }

    public function del($id){
        $this->db->where('id', $id);
        return $this->db->delete('department');
    }

}
