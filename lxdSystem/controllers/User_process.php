<?php
/**
 * Created by PhpStorm.
 * @author jinliangping
 * @date 2015 15/5/15 下午11:30
 * @copyright 7659.com
 */
class User_process extends MY_Controller {

	public function index() {

		$p = (int) $this->input->get('p');
		$p = $p?$p:1;
		$this->load->model('user_process_model');
		$count  = $this->user_process_model->getTotal();
		$offset = ($p-1)*$this->pageSize;

		$data['list'] = $this->user_process_model->getList($offset, $this->pageSize);
		$this->load->library('page', array('total' => $count, 'pageSize' => $this->pageSize));
		$data['page_show'] = $this->page->pageShow();
		/*
		echo '<pre>';
		print_r($data['list']);
		die();*/
		$this->view('user_process/index', $data);

	}

	public function add() {
		if (!$this->input->is_ajax_request()) {
			$this->load->model('order_model');
			$count        = $this->order_model->getTotal();
			$data['list'] = $this->order_model->getList(0, $count);
			$this->view('user_process/add', $data);
		} else {
			$res = $this->input->post('data');
			parse_str($res, $data);
			if (empty($data['order_id'])) {
				$this->jsonMsg(0, '请选择所属订单');
			}
			if (empty($data['process_id'])) {
				$this->jsonMsg(0, '请选择工序');
			}
			if (empty($data['process_num'])) {
				$this->jsonMsg(0, '请填写工序数量');
			}
			if (empty($data['user_name'])) {
				$this->jsonMsg(0, '请填写员工姓名');
			} else {
				$this->load->model('user_model');
				$user_list = $this->user_model->getList(0, 10000, $data['user_name']);
				if (empty($user_list)) {
					$this->jsonMsg(0, '没有该员工');
				} else {
					$data['user_id'] = $user_list[0]['id'];
					unset($data['user_name']);
				}
			}
			$data['create_time'] = TIMESTAMP;

			$this->load->model('user_process_model');
			$res = (int) $this->user_process_model->add($data);
			$this->jsonMsg($res);
		}
	}

	public function edit() {

		$this->load->model('order_model');
		$id                 = $this->input->get('id');
		$data['order_info'] = $this->user_model->getRow('id='.$id);

		$this->view('order/add', $data);
	}

	public function del() {

		$id = $this->input->post('id');
		$this->db->where('id', $id);
		$this->db->delete('user_process');

		$this->jsonMsg($res);
	}

	public function getUserInfoByName() {
		$res = $this->input->post('data');
		$this->load->model('user_model');
		$user_list = $this->user_model->getList(0, 10000, $res);
		$this->jsonMsg(1, $user_list);

	}

	public function getProcessByOrderId() {
		$res = $this->input->post('data');
		$this->load->model('process_model');
		$process_list = $this->process_model->getList(0, 10000, '', 'order_id='.$res);
		$this->jsonMsg(1, $process_list);

	}
}

?>
