<?php
/**
 * Created by PhpStorm.
 * @author wuxin
 * @date 2015 15/5/8 下午3:30
 * @copyright 7659.com
 */
class User_model extends CI_Model {

    public function checkUser($username,$password,$type=true){
        $this->db->select('*');
        $this->db->where('username',$username);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0){
            $row = $query->row_array();
            if(md5($password) === $row['pwd']){
                //$this->update_login_user($row['id']);
                return $type ? $row['id'] : $row;
            }
        }
        return false;
    }
}