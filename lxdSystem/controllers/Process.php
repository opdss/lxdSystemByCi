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
            $errno = array();
            $this->load->model('process_model');
            foreach($data['process_desc'] as $k=>$v){
                $process_arr['process_desc'] = trim($v);
                $process_arr['process_name'] = trim($data['process_name'][$k]);
                $process_arr['process_price'] = (float)$data['process_price'][$k];
                if(empty($process_arr['process_name']) || $process_arr['process_price']<=0){
                    $errno[] = $k+1;
                    continue;
                }
                $process_arr['create_time'] = TIMESTAMP;
                $process_arr['sign'] = md5($process_arr['process_name'].$process_arr['process_price']);
                $process_arr['process_isdel'] = 0;
                $where = "sign='".$process_arr['sign']."'";
                $info = $this->process_model->getRow($where);
                if(empty($info)){
                    $this->process_model->add($process_arr) || $errno[]=$k+1;
                }else{
                    $info['process_isdel']==0 || $this->process_model->edit($info['id'],array('process_isdel'=>0,'process_desc'=>$process_arr['process_desc'])) || $errno[]=$k+1;
                }
            }
            $status = count($data['process_desc'])==count($errno) ? 0 : 1;
			$this->jsonMsg($status,(empty($errno)?'':'工序'.implode(',',$errno).'出错'));
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
