<?php
/**
 * Created by PhpStorm.
 * @author jinliangping
 * @date 2015 15/5/13 下午3:10
 * @copyright 7659.com
 */
class User_role_model extends MY_Model {


    public function add($data){
        return $this->db->insert('user_role',$data);
    }
}
