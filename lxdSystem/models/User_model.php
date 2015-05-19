<?php
/**
 * Created by PhpStorm.
 * @author wuxin
 * @date 2015 15/5/8 下午3:30
 * @copyright 7659.com
 */
class User_model extends MY_Model {

	public function checkUser($username, $password, $type = true) {
		$this->db->select('*');
		$this->db->where('username', $username);
		$query = $this->db->get('user');
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			if (md5($password) === $row['pwd']) {
				if ($type) {
                    $privi = $this->getUserAuth($row['id']);
                    if(!empty($privi)) {
                        $privi['role_privileges'] = $privi['enabled']==0 ? unserialize($privi['role_privileges']) : '';
                        return array_merge($row, $privi);
                    }
                    return array_merge($row,array('role_name'=>'','role_desc'=>'','role_privileges'));
				}
				return $row['id'];
			}
		}
		return false;
	}

	public function getUserAuth($id) {
		$sql = 'select role_name,role_desc,role_privileges,enabled from '.$this->db->dbprefix('role').' where id="'.$id.'" ';
		$query = $this->db->query($sql);
		return $query->row_array();
	}


	public function getList($offset, $number,$where='1', $order=' id desc ') {
        $where = $this->getWhereStr($where);
		$sql      = "select a.id,a.no,a.username,a.truename,a.age,a.sex,a.dept_id,a.begin_work_time,a.idcard,a.mobile,a.address,a.qq,a.weixin,a.role_id,a.bothday,b.role_name,c.dept_no,c.dept_name from ".$this->db->dbprefix('user')." as a inner join ".$this->db->dbprefix('role')." as b on a.role_id=b.id left join ".$this->db->dbprefix('department')." as c on a.dept_id=c.id where $where order by $order limit $offset,$number";
		$query    = $this->db->query($sql);
		$userList = $query->result_array();

		return $userList;
	}

    public function getTotal($where='1') {
        $where = $this->getWhereStr($where);
        $sql = "select id from ".$this->db->dbprefix('user')." where $where ";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }


	/**
	 * username唯一
	 */
	public function checkUserIsOneByUserName($username) {
		$this->db->select('*');
		$this->db->where('username', $username);
		$query = $this->db->get('user');
		if ($query->num_rows() > 0) {
			return false;
		}
		return true;
	}

	public function makeUserNo() {
		$sql   = 'select * from '.$this->db->dbprefix('user').' order by id desc limit 0,1';
		$query = $this->db->query($sql);
		$user  = $query->row_array();
		if ($user) {
			$pos   = strrpos($user['no'], '0');
			$newNo = intval(substr($user['no'], $pos))+1;
			$newNo = substr($user['no'], 0, $pos+1).$newNo;
			return $newNo;
		} else {
			return 'GD0001';
		}
	}

	public function add($data) {
		$this->db->insert('user', $data);
		return $this->db->insert_id();
	}

	public function getRow($where) {
		if (empty($where)) {
			return false;
		}
		$sql            = 'select * from '.$this->db->dbprefix('user').' where '.$where.' limit 0,1';
		$query          = $this->db->query($sql);
		$user           = $query->row_array();
		return $user;
	}

	public function edit($id, $data) {
		$this->db->where('id', $id);
		return $this->db->update('user', $data);
	}
}