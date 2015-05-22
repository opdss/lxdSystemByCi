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
            $this->restyle['js'][] = 'bootstrap.datepicker.js';
            $this->restyle['css'][] = 'lib/bootstrap.datepicker.css';
            $this->load->model('department_model');
            $dep_sum = $this->department_model->getTotal();
            $dept_list = $this->department_model->getList(0, $dep_sum);
            $data['dept_list'] = $this->department_model->generateTree($dept_list);
			$this->load->model('order_model');
			$count        = $this->order_model->getTotal('order_status=1');
			$data['order_list'] = $this->order_model->getList(0, $count, 'order_status=1');
            //echo '<pre>';print_r($data['order_list']);die();
			$this->view('user_process/add', $data);
		} else {
			$res = $this->input->post('data');
			parse_str($res, $data);

			if (count($data['order_id'])==0) {
				$this->jsonMsg(0, '请选择所属订单');
			}else{
                $orders = $data['order_id'];
                $num1 = count($orders);
                $new_orders = array_unique($orders);//合并相同的元素
                $num2 = count($new_orders);//提取合并后数组个数
                if($num1>$num2)//判断下大小
                {
                    $this->jsonMsg(0, '相同的订单不可以选择多次');
                }
            }
			if (count($data['process_id'])==0) {
				$this->jsonMsg(0, '请选择工序');
			}
			if (count($data['process_num'])==0) {
				$this->jsonMsg(0, '请填写工序数量');
			}
            $this->load->model('user_process_model');
            $sign = md5($data['user_id'].$data['work_month']);
            $sum = $this->user_process_model->checkUserProcess(' sign="'.$sign.'" ');
            if($sum>0){
                $this->jsonMsg(0, '已添加过该员工工序');
            }

            $arr = array();
            if($data['type']=='add_btn'){
                $arr['ispay'] = 0;
            }
            elseif($data['type']=='pay_btn'){
                $arr['ispay'] = 1;
            }
            $arr['user_id'] = $data['user_id'];
            $arr['desc'] = $data['desc'];
            $arr['create_time'] = TIMESTAMP;
            $arr['work_month'] = $data['work_month'];
            $arr['sign'] = md5($arr['user_id'].$arr['work_month']);

            $flag = true;
            $totle = 0;
            //开始事务
            $this->db->query('BEGIN');

            foreach($data['order_id'] as $k=>$v){
                //根据订单id循环插入该订单的每一道工序
                foreach($data['process_id'][$v] as $key=>$val){

                    $arr['order_process_id'] = $val;
                    $arr['process_num'] = $data['process_num'][$v][$key];
                    $totle += $data['process_num'][$v][$key]*$data['process_price'][$v][$key];
                    $res = (int)$this->user_process_model->add($arr);
                    if(!$res){
                        $flag = false;
                    }

                }
                //更新订单当前花费的金额
                $this->load->model('order_model');
                if(!$this->order_model->edit($v,$totle)){
                    $flag = false;
                }
            }

            //向员工薪资表中插入一条记录
            $salary_data['sign'] = $arr['sign'];
            $this->load->model('user_model');
            $user_info = $this->user_model->getRow('id='.$arr['user_id']);
            $salary_data['username'] = $user_info['truename'];
            $salary_data['work_month'] = $arr['work_month'];
            $salary_data['salary'] = $totle;
            $salary_data['create_time'] = TIMESTAMP;
            $this->load->model('user_salary_model');
            $result = (int) $this->user_salary_model->add($salary_data);
            if(!$result){
                $flag = false;
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
        if (!$this->input->is_ajax_request()) {
            $id = $this->input->get('id');
            $this->load->model('user_process_model');
            $data['user_process_info'] = $this->user_process_model->getRow('a.id=' . $id);
            if($data['user_process_info']['ispay']==1){
                echo '<script>alert("请员工已结算，不能修改！");window.location.href="'.$_SERVER["HTTP_REFERER"].'";</script>';
            }
            $this->view('user_process/edit', $data);
        }else{
            $res = $this->input->post('data');
            parse_str($res, $data);
            $this->load->model('user_process_model');
            $id = $data['id'];
            unset($data['id']);
            $res = $this->user_process_model->edit($id,$data);
            if($res){
                $this->jsonMsg(1);
            }else{
                $this->jsonMsg(0);
            }

        }
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
        $sql = 'select a.id,a.process_name,a.process_price,a.process_desc,b.id as order_process_id from '.$this->db->dbprefix('process').' as a right join '.$this->db->dbprefix('order_process').' as b on a.id=b.process_id where b.order_id='.$res.' and a.process_isdel=0';
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
