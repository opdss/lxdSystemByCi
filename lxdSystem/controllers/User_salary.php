<?php
/**
 * Created by PhpStorm.
 * User: jlping
 * Date: 15/5/20
 * Time: 15:44
 */
class User_salary extends MY_Controller {

    public function index(){
        $kw = trim($this->input->get('kw'));
        $p  = (int) $this->input->get('p');
        $p  = $p?$p:1;
        $where = 'status=0 ';
        if(!empty($kw)){
            $where .= ' and username like "%'.$kw.'%" ';
        }

        $this->load->model('user_salary_model');
        $count  = $this->user_salary_model->getTotal($where);
        $offset = ($p-1)*$this->pageSize;

        $data['list'] = $this->user_salary_model->getList($offset, $this->pageSize, $where);
        $this->load->library('page', array('total' => $count, 'pageSize' => $this->pageSize));
        $data['page_show'] = $this->page->pageShow();

        $this->view('user_salary/index', $data);
    }

    public function info(){

        $sign = $this->input->get('sign');
        $this->load->model('user_process_model');
        $where = ' t_user_process.sign="'.$sign.'" ';
        $count = $this->user_process_model->getTotal($where);
        $list = $this->user_process_model->getList(0,$count,' a.sign="'.$sign.'" ');
        foreach($list as $k=>$v){

            $new_list['username'] = $v['username']; unset($v['username']);
            $new_list['truename'] = $v['truename']; unset($v['truename']);
            $new_list['order_name'] = $v['order_name']; unset($v['order_name']);
            $new_list['work_month'] = $v['work_month']; unset($v['work_month']);
            $new_list[$v['order_id']][] = $v;
        }
        //echo '<pre>';
        //print_r($new_list);die();
        $this->view('user_salary/info',array('salary_info'=>$new_list));

    }

    public function edit(){
        if (!$this->input->is_ajax_request()) {
            $sign = $this->input->get('sign');
            $this->load->model('user_process_model');
            $where = ' t_user_process.sign="'.$sign.'" ';
            $count = $this->user_process_model->getTotal($where);
            $list = $this->user_process_model->getList(0,$count,' a.sign="'.$sign.'" ');
            foreach($list as $k=>$v){

                $new_list['username'] = $v['username']; unset($v['username']);
                $new_list['truename'] = $v['truename']; unset($v['truename']);
                $new_list['order_name'] = $v['order_name']; unset($v['order_name']);
                $new_list['work_month'] = $v['work_month']; unset($v['work_month']);
                $new_list[$v['order_id']][] = $v;
            }
            $data['salary_info'] = $new_list;

            $this->view('user_salary/edit',$data);
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
            $this->load->model('user_process_model');
            $sign = md5($data['user_id'].$data['work_month']);
            $sum = $this->user_process_model->checkUserProcess(' sign="'.$sign.'" ');
            if($sum>0){
                $this->jsonMsg(0, '已添加过该员工工序');
            }

            $arr = array();
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
                    if($arr['process_num']>0) {
                        $res = (int)$this->user_process_model->add($arr);
                        if(!$res){
                            $flag = false;
                        }
                    }

                }
                //更新订单当前花费的金额
                $this->load->model('order_model');
                if(!$this->order_model->update($totle,'id='.$v)){
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

}