<?php
/**
 * Created by PhpStorm.
 * @author jinliangping
 * @date 2015 15/5/15 下午11:30
 * @copyright 7659.com
 */
class Process extends MY_Controller {

	public function index() {
		$kw = $this->input->get('kw');
		$p  = (int) $this->input->get('p');
		$p  = $p?$p:1;
		$this->load->model('process_model');
		$count  = $this->process_model->getTotal($kw);
		$offset = ($p-1)*$this->pageSize;

		$data['list'] = $this->process_model->getList($offset, $this->pageSize, $kw);

		$this->load->library('page', array('total' => $count, 'pageSize' => $this->pageSize));
		$data['page_show'] = $this->page->pageShow();
		$data['kw']        = $kw;
		/*
		echo '<pre>';
		print_r($data['list']);
		die();*/
		$this->view('process/index', $data);

	}

	public function add() {
		if (!$this->input->is_ajax_request()) {
			$this->load->model('order_model');
			$count        = $this->order_model->getTotal();
			$data['list'] = $this->order_model->getList(0, $count);
			$this->view('process/add', $data);
		} else {
			$res = $this->input->post('data');
			parse_str($res, $data);
			if (empty($data['process_name'])) {
				$this->jsonMsg(0, '请输入工序名字');
			}
			if (empty($data['process_price'])) {
				$this->jsonMsg(0, '请输入工序价格');
			}
			if (empty($data['order_id'])) {
				$this->jsonMsg(0, '请选择所属订单');
			}
			$data['create_time'] = TIMESTAMP;

			$this->load->model('process_model');
			$res = (int) $this->process_model->add($data);
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
