<?php
/**
 * Created by PhpStorm.
 * @author jinliangping
 * @date 2015 15/5/10 下午1:30
 * @copyright 7659.com
 */
class User extends MY_Controller {

	public function index() {
		$kw = trim($this->input->get('kw'));
		$p  = (int) $this->input->get('p');
		$p  = $p?$p:1;
        $where = 'isdel=0 ';
        if(!empty($kw)){
            $where .= ' and username like "%'.$kw.'%" or truename like "%'.$kw.'%" or mobile like "%'.$kw.'%" or no like "%'.$kw.'%" ';
        }
		$this->load->model('user_model');
		$count  = $this->user_model->getTotal($where);
		$offset = ($p-1)*$this->pageSize;

		$data['list'] = $this->user_model->getList($offset, $this->pageSize, $where, 'a.id desc');

		$this->load->library('page', array('total' => $count, 'pageSize' => $this->pageSize));
		$data['page_show'] = $this->page->pageShow();
		$data['kw']        = $kw;
		/*
		echo '<pre>';
		print_r($data['list']);
		die();*/
		$this->view('user/index', $data);

	}

	public function add() {

		//访问页面
		if (!$this->input->is_ajax_request()) {
            $this->restyle['js'][] = 'bootstrap.datepicker.js';
            $this->restyle['css'][] = 'lib/bootstrap.datepicker.css';
			$this->load->model('department_model');
			$count            = $this->department_model->getTotal();
			$dept_list = $this->department_model->getList(0, $count);
            $data['dep_list'] = $this->department_model->generateTree($dept_list);

			$this->load->model('role_model');
			$count2            = $this->role_model->getTotal();
			$data['role_list'] = $this->role_model->getList(0, $count2);

			$this->view('user/add', $data);

		}
		//ajax提交数据
		 else {
			$data = $this->input->post();
			$msg  = '';
			$this->load->model('user_model');

            if (!$this->user_model->checkUserIsOneByUserName($data['username'])) {
                $msg .= '用户名要唯一\r\n';
            }
			if (preg_match("/^\s*$/", $data['truename'])) {$msg .= '请填写真实名称\r\n';}
			if (preg_match("/^\s*$/", $data['sex'])) {$msg .= '请选择性别\r\n';}
			if (preg_match("/^[a-zA-Z][a-zA-Z0-9_]{6,18}$/", $data['pwd'])) {$msg .= '密码在6-18位字符\r\n';}
			if (preg_match("/^\s*$/", $data['dept_id'])) {$msg .= '请选择部门\r\n';}
			if (!preg_match("/^(\d{4})-(\d{2})-(\d{2})$/", $data['begin_work_time'])) {$msg .= '时间格式不正确\r\n';}
			if (preg_match("/^\s*$/", $data['role_id'])) {$msg .= '请选择角色\r\n';}

			if (!empty($msg)) {
				$this->jsonMsg(0, $msg);
			}

			$data['no']              = $this->user_model->makeUserNo();
			$data['create_time']     = TIMESTAMP;
			$data['pwd']             = md5($data['pwd']);
			$data['begin_work_time'] = strtotime($data['begin_work_time']);

             unset($data['id']);
             $insertId = (int) $this->user_model->add($data);
             if($insertId){
                 $this->jsonMsg(1);
             }else{
                 $this->jsonMsg(0);
             }

		}
	}

	public function edit() {
        if (!$this->input->is_ajax_request()) {
            $this->load->model('department_model');
            $count = $this->department_model->getTotal();
            $dept_list = $this->department_model->getList(0, $count);
            $data['dep_list'] = $this->department_model->generateTree($dept_list);

            $this->load->model('role_model');
            $count2 = $this->role_model->getTotal();
            $data['role_list'] = $this->role_model->getList(0, $count2);

            $this->load->model('user_model');
            $id = $this->input->get('id');
            $data['user_info'] = $this->user_model->getRow('id=' . $id);

            $this->view('user/edit', $data);
        }else{
            $data = $this->input->post();
            $msg  = '';
            $this->load->model('user_model');

            if (preg_match("/^\s*$/", $data['truename'])) {$msg .= '请填写真实名称\r\n';}
            if (preg_match("/^\s*$/", $data['sex'])) {$msg .= '请选择性别\r\n';}
            if (preg_match("/^\s*$/", $data['dept_id'])) {$msg .= '请选择部门\r\n';}
            if (!preg_match("/^(\d{4})-(\d{2})-(\d{2})$/", $data['begin_work_time'])) {$msg .= '时间格式不正确\r\n';}
            if (preg_match("/^\s*$/", $data['role_id'])) {$msg .= '请选择角色\r\n';}

            if (!empty($msg)) {
                $this->jsonMsg(0, $msg);
            }

            $data['begin_work_time'] = strtotime($data['begin_work_time']);

            $id = $data['id'];
            unset($data['id']);
            $result = $this->user_model->edit($id, $data);

            if($result){
                $this->jsonMsg(1);
            }else{
                $this->jsonMsg(0);
            }

        }
	}

	public function del() {

		$id = $this->input->post('id');
        $this->load->model('user_model');
        $this->user_model->edit($id, array('isdel'=>1));
		$this->jsonMsg(1);
	}
}

?>
