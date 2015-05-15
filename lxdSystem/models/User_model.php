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
				//$this->update_login_user($row['id']);
				if ($type) {
					return array_merge($row, $this->getUserAuth($row['id']));
				}
				return $row['id'];
			}
		}
		return false;
	}

	public function getUserAuth($id) {
		$privileges = array();
		$sql        = 'select b.role_name,b.role_privileges from '.$this->db->dbprefix('user_role').' as a ';
		$sql .= ' left join '.$this->db->dbprefix('role').' as b ';
		$sql .= ' on a.role_id=b.id ';
		$sql .= ' where a.user_id="'.$id.'" ';
		$query = $this->db->query($sql);
		$res   = $query->result_array();
		if (!empty($res)) {
			foreach ($res as $k => $v) {
				$privileges = array_merge($privileges, unserialize($v['role_privileges']));
			}
		}
		return array('role' => $res, 'privileges' => $privileges);

	}

	public function getTotal($kw = null) {
		$filter = ' 1 ';
		$filter .= $kw?' and username like "%'.$kw.'%" ':'';
		$sql   = "select id from ".$this->db->dbprefix('user')." where $filter ";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function getList($offset, $number, $kw = null) {
		$filter = ' 1 ';
		$filter .= $kw?' and username like "%'.$kw.'%" or truename like "%'.$kw.'%" ':'';
		$sql      = "select a.id,a.no,a.username,a.truename,a.age,a.sex,a.dept_id,a.begin_work_time,a.idcard,a.mobile,a.address,a.qq,a.weixin,a.isdel,a.bothday,b.dept_no,b.dept_name from ".$this->db->dbprefix('user')." as a left join ".$this->db->dbprefix('department')." as b on a.dept_id=b.id where $filter order by a.id asc limit $offset,$number";
		$query    = $this->db->query($sql);
		$userList = $query->result_array();

		foreach ($userList as $k => $v) {
			$sql2 = 'select b.role_name from '.$this->db->dbprefix('user_role').' as a inner join '.$this->db->dbprefix('role').' as b on a.role_id=b.id where a.user_id='.$v['id'];

			$query                     = $this->db->query($sql2);
			$roleList                  = $query->result_array();
			$userList[$k]['role_name'] = $roleList;
		}
		return $userList;
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
		$role_arr = array();
		if (empty($where)) {
			return false;
		}
		$sql            = 'select * from '.$this->db->dbprefix('user').' where '.$where.' order by id desc limit 0,1';
		$query          = $this->db->query($sql);
		$user           = $query->row_array();
		$sql2           = 'select * from '.$this->db->dbprefix('user_role').' where user_id='.$user['id'];
		$query          = $this->db->query($sql2);
		$user_role_list = $query->result_array();
		if (!empty($user_role_list)) {
			foreach ($user_role_list as $key => $value) {
				$role_arr[] = $value['role_id'];
			}
		}
		$user['role_id'] = $role_arr;
		return $user;
	}

	public function edit($id, $data) {
		$this->db->where('id', $id);
		return $this->db->update('user', $data);
	}
}