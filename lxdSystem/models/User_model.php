<?php
/**
 * Created by PhpStorm.
 * @author wuxin
 * @date 2015 15/5/8 下午3:30
 * @copyright 7659.com
 */
class User_model extends MY_Model {

    public function checkUser($username,$password,$type=true){
        $this->db->select('*');
        $this->db->where('username',$username);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0){
            $row = $query->row_array();
            if(md5($password) === $row['pwd']){
                //$this->update_login_user($row['id']);
                if($type){
                    return array_merge($row,$this->getUserAuth($row['id']));
                }
                return $row['id'];
            }
        }
        return false;
    }

    public function getUserAuth($id){
        $privileges = array();
        $sql = 'select b.role_name,b.role_privileges from '.$this->db->dbprefix('user_role').' as a ';
        $sql .= ' left join '.$this->db->dbprefix('role').' as b ';
        $sql .= ' on a.role_id=b.id ';
        $sql .= ' where a.user_id="'.$id.'" ';
        $query = $this->db->query($sql);
        $res = $query->result_array();
        if(!empty($res)){
            foreach($res as $k=>$v){
                $privileges = array_merge($privileges,unserialize($v['role_privileges']));
            }
        }
        return array('role'=>$res,'privileges'=>$privileges);

    }
}