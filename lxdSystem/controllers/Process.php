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

        $where = ' process_isdel=0 ';
        $where .= empty($kw) ? ' ' : " and process_name like '%$kw%' ";

		$count  = $this->process_model->getTotal($where);
		$offset = ($p-1)*$this->pageSize;
		$data['list'] = $this->process_model->getList($offset, $this->pageSize, $where);

		$this->load->library('page', array('total' => $count, 'pageSize' => $this->pageSize));
		$data['page_show'] = $this->page->pageShow();
		$data['kw'] = $kw;

		$this->view('process/index', $data);

	}

	public function add() {
		if (!$this->input->is_ajax_request()) {
			$this->view('process/add');
		} else {
			$res = $this->input->post('data');
			parse_str($res, $data);
            //开始处理工序
            $this->load->library('processes');
            $count = $this->processes->createProcess($data);
            $status = $count==count($this->processes->errProcess) ? 0 : 1;
			$this->jsonMsg($status,(empty($this->processes->errProcess)?'':'工序'.implode(',',$this->processes->errProcess).'出错'));
		}
	}

	public function del() {
        if ($this->input->is_ajax_request()) {
            $id = (int)$this->input->post('id');
            if(!$id){
                $this->jsonMsg(0);
            }
            $this->load->model('process_model');
            $res = (int)$this->process_model->edit($id,array('process_isdel'=>1));
            $this->jsonMsg($res);
        }
	}
}

?>
