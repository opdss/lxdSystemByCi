<?php
/**
 * Created by PhpStorm.
 * @author jinliangping
 * @date 2015 15/5/15 下午11:30
 * @copyright 7659.com
 */
class Order extends MY_Controller {

	public function index() {
		$kw = $this->input->get('kw');
		$p  = (int) $this->input->get('p');
		$p  = $p?$p:1;
		$this->load->model('order_model');
		$count  = $this->order_model->getTotal($kw);
		$offset = ($p-1)*$this->pageSize;

		$data['list'] = $this->order_model->getList($offset, $this->pageSize, $kw);

		$this->load->library('page', array('total' => $count, 'pageSize' => $this->pageSize));
		$data['page_show'] = $this->page->pageShow();
		$data['kw']        = $kw;
		/*
		echo '<pre>';
		print_r($data['list']);
		die();*/
		$this->view('order/index', $data);

	}

	public function add() {
		if (!$this->input->is_ajax_request()) {
			$this->view('order/add');
		} else {
			$res = $this->input->post('data');
			parse_str($res, $data);
			if (empty($data['order_name'])) {
				$this->jsonMsg(0, '请输入订单名字');
			}
			if (empty($data['order_desc'])) {
				$this->jsonMsg(0, '请输入订单介绍');
			}
			$data['order_no']    = date('YmdHi', TIMESTAMP).mt_rand(10000, 99999);
			$data['create_time'] = TIMESTAMP;

			$this->load->model('order_model');
			$res = (int) $this->order_model->add($data);
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
		$this->db->delete('order');

		$this->jsonMsg($res);
	}
}

?>
