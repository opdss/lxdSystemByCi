<?php
/**
 * Created by PhpStorm.
 * @author jinliangping
 * @date 2015 15/5/10 下午1:30
 * @copyright 7659.com
 */
class User extends MY_Controller {

	public function index() {
		$kw = $this->input->get('kw');
		$p  = (int) $this->input->get('p');
		$p  = $p?$p:1;
		$this->load->model('user_model');
		$count  = $this->user_model->getTotal($kw);
		$offset = ($p-1)*$this->pageSize;

		$data['list'] = $this->user_model->getList($offset, $this->pageSize, $kw);

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
		$this->load->model('department_model');
		$count            = $this->department_model->getTotal();
		$data['dep_list'] = $this->department_model->getList(0, $count);

		$this->load->model('role_model');
		$count2            = $this->role_model->getTotal();
		$data['role_list'] = $this->role_model->getList(0, $count2);

		$this->view('user/add', $data);
	}
}

?>