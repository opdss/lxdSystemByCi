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
            $this->load->model('department_model');
            $dep_sum = $this->department_model->getTotal();
            $dept_list = $this->department_model->getList(0, $dep_sum);
            $data['dept_list'] = $this->department_model->generateTree($dept_list);
			$this->load->model('order_model');
			$count        = $this->order_model->getTotal();
			$data['order_list'] = $this->order_model->getList(0, $count);
			$this->view('user_process/add', $data);
		} else {
			$res = $this->input->post('data');
			parse_str($res, $data);

			if (count($data['order_id'])==0) {
				$this->jsonMsg(0, '请选择所属订单');
			}
			if (count($data['process_id'])==0) {
				$this->jsonMsg(0, '请选择工序');
			}
			if (count($data['process_num'])==0) {
				$this->jsonMsg(0, '请填写工序数量');
			}

            $arr = array();
            $arr['user_id'] = $data['user_id'];
            $arr['desc'] = $data['desc'];
            $arr['create_time'] = TIMESTAMP;
            $this->load->model('user_process_model');

            $flag = true;
            $this->db->query('BEGIN');

            foreach($data['order_id'] as $k=>$v){
                foreach($data['process_id'][$v] as $key=>$val){

                    $arr['order_id'] = $v;
                    $arr['process_id'] = $val;
                    $arr['process_num'] = $data['process_num'][$v][$key];

                    $res = (int) $this->user_process_model->add($arr);
                    if(!$res){
                        $flag = false;
                    }

                }
            }
            if($flag){
                $this->db->query('COMMIT');
                $this->jsonMsg(1);
            }else{
                $this->db->query('ROLLBACK');
                $this->jsonMsg(0);
            }


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
        if(empty($res)){
            $this->jsonMsg(0, 'param error');
        }
		$this->load->model('process_model');
        $where = ' process_isdel=0 and order_id='.$res;
        $sql = 'select a.id,a.process_name,a.process_price,a.process_desc from '.$this->db->dbprefix('process').' as a right join '.$this->db->dbprefix('order_process').' as b on a.id=b.process_id where b.order_id='.$res.' and a.process_isdel=0';
        $query = $this->db->query($sql);
        $process_list = $query->result_array();
		$this->jsonMsg(1, $process_list);

	}

    public function getUserListByDeptId(){
        $res = $this->input->post('data');
        $this->load->model('user_model');
        if(empty($res)){
            $this->jsonMsg(0, 'param error');
        }
        $where = 'isdel=0 and dept_id='.$res;
        $count = $this->user_model->getTotal($where);
        $user_lsit = $this->user_model->getList(0, $count, $where, ' a.id desc ');
        $this->jsonMsg(1,$user_lsit);

    }
}

?>
