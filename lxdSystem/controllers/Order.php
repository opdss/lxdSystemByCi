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

        $where = ' order_isdel=0 ';
        $where .= $kw ? ' and order_name like "%'.$kw.'%" ' : '';

		$this->load->model('order_model');
		$count  = $this->order_model->getTotal($where);
		$offset = ($p-1)*$this->pageSize;

		$data['list'] = $this->order_model->getList($offset, $this->pageSize, $where);
        foreach($data['list'] as $k=>$v){
            $data['list'][$k]['order_process_num'] = $this->order_model->getProcessNum($v['id'],'total');
        }

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
            $this->restyle['js'][] = 'bootstrap.datepicker.js';
            $this->restyle['css'][] = 'lib/bootstrap.datepicker.css';
			$this->view('order/add');
		} else {
			$res = $this->input->post('data');
			parse_str($res, $data);
            if(empty($data['process'])){
                $this->jsonMsg(0,'工序没有添加');
            }
            $process = $data['process'];
            unset($data['process']);
            array_map('trim',$data);
			if(empty($data['order_name'])) {
				$this->jsonMsg(0, '请输入订单名字');
			}
            if (empty($data['order_desc'])) {
                $this->jsonMsg(0, '请输入订单介绍');
            }
			if (empty($data['order_jiafang'])) {
				$this->jsonMsg(0, '请输入订单委托商');
			}
            $data['order_num'] = (int)$data['order_num'];
            if (!($data['order_num'])) {
                $this->jsonMsg(0, '请输入订单产品数量');
            }
            $data['order_amount'] = (float)$data['order_amount'];
            if (!($data['order_amount'])) {
                $this->jsonMsg(0, '请输入订单总金额');
            }
            if (empty($data['order_start_date'])) {
                $this->jsonMsg(0, '请输入订单预计开始时间');
            }
            if (empty($data['order_end_date'])) {
                $this->jsonMsg(0, '请输入订单预计结束时间');
            }
			$data['order_no']    = date('YmdHis').mt_rand(10, 99);
			$data['create_time'] = TIMESTAMP;
            //开始处理工序
            $this->load->library('processes');
            $count = $this->processes->createProcess($process);

            if(empty($this->processes->sucProcess)){
                $this->jsonMsg(0, '插入工序失败');
            }

			$this->load->model('order_model');
			$res = (int) $this->order_model->addOrderProcess($data,$this->processes->sucProcess);
			$this->jsonMsg($res);
		}
	}

	public function edit() {
        if(!$this->input->is_ajax_request()) {
            $this->load->model('order_model');
            $id = (int)$this->input->get('id');
            $data['order_info'] = $this->order_model->getRow(array('id' => $id, 'order_isdel' => 0));
            if (empty($data['order_info'])) {
                exit('order error');
            }
            $this->view('order/edit', $data);
        }else{
            $res = $this->input->post('data');
            parse_str($res, $data);
            array_map('trim',$data);
            if(empty($data['order_id'])){
                $this->jsonMsg(0,'订单错误');
            }
            $order_id = $data['order_id'];
            unset($data['order_id']);

            if(empty($data['order_name'])) {
                $this->jsonMsg(0, '请输入订单名字');
            }
            if (empty($data['order_desc'])) {
                $this->jsonMsg(0, '请输入订单介绍');
            }
            if (empty($data['order_jiafang'])) {
                $this->jsonMsg(0, '请输入订单委托商');
            }
            $data['order_num'] = (int)$data['order_num'];
            if (!($data['order_num'])) {
                $this->jsonMsg(0, '请输入订单产品数量');
            }
            $data['order_amount'] = (float)$data['order_amount'];
            if (!($data['order_amount'])) {
                $this->jsonMsg(0, '请输入订单总金额');
            }
            if (empty($data['order_start_date'])) {
                $this->jsonMsg(0, '请输入订单预计开始时间');
            }
            if (empty($data['order_end_date'])) {
                $this->jsonMsg(0, '请输入订单预计结束时间');
            }

            $this->load->model('order_model');
            $res = (int) $this->order_model->editOrder($order_id,$data);
            $this->jsonMsg($res);
        }
	}

	public function del() {
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		$res = (int)$this->db->update('order',array('order_isdel'=>1));
		$this->jsonMsg($res);
	}

    public function order_process(){
        if(!$this->input->is_ajax_request()) {
            $o_id = (int)$this->input->get('order_id');
            if (!$o_id) {
                exit('order_id error');
            }
            $this->load->model('order_model');
            $data['order_info'] = $this->order_model->getRow(array('id' => $o_id));
            $data['list'] = $this->order_model->getOrderProcess($o_id);
            //var_dump($data);exit;
            $this->view('order/order_process', $data);
        }else{
            $res = $this->input->post('data');
            parse_str($res, $data);

            if(empty($data['order_id'])){
                $this->jsonMsg(0,'订单错误');
            }
            if(empty($data['process'])){
                $this->jsonMsg(0,'请填写工序');
            }
            $this->load->library('processes');
            $count = $this->processes->createProcess($data['process']);
            $this->load->model('order_model');
            if($count){
                $res = (int)$this->order_model->addProcessForOrder($data['order_id'],$this->processes->sucProcess);
                $this->jsonMsg($res);
            }
            $this->jsonMsg(0);
        }
    }

    public function del_order_process(){
        if ($this->input->is_ajax_request()) {
            $id = (int)$this->input->post('id');
            if(!$id){
                $this->jsonMsg(0);
            }
            $this->load->model('order_model');
            $res = (int)$this->order_model->delOrderProcess($id);
            $this->jsonMsg($res);
        }
    }
}

?>
