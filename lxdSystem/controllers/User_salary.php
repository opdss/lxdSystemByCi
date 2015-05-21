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
        $this->restyle['js'][] = 'jquery.min.js';
        $this->restyle['js'][] = 'jquery.jqprint-0.3.js';
        $this->restyle['js'][] = 'jquery-migrate-1.1.0.js';
        $sign = $this->input->get('sign');
        $this->load->model('user_process_model');
        $where = ' t_user_process.sign="'.$sign.'" ';
        $count = $this->user_process_model->getTotal($where);
        $list = $this->user_process_model->getList(0,$count,' a.sign="'.$sign.'" ');
        foreach($list as $k=>$v){

            $new_list['username'] = $v['username']; unset($v['username']);
            $new_list['truename'] = $v['truename']; unset($v['truename']);
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
            //判断是否结算，已结算不能修改
            foreach($list as $k=>$v){
                if($v['ispay']==1){
                    echo '<script>alert("请员工已结算，不能修改！");window.location.href="'.$_SERVER["HTTP_REFERER"].'";</script>';
                }
                $new_list['username'] = $v['username']; unset($v['username']);
                $new_list['user_id'] = $v['user_id']; unset($v['user_id']);
                $new_list['truename'] = $v['truename']; unset($v['truename']);
                $new_list['work_month'] = $v['work_month']; unset($v['work_month']);
                $new_list['desc'] = $v['desc']; unset($v['desc']);
                $new_list[$v['order_id']][] = $v;
            }
            $data['salary_info'] = $new_list;
            //echo '<pre>';print_r($new_list);die();
            $this->load->model('order_model');
            $count        = $this->order_model->getTotal();
            $data['order_list'] = $this->order_model->getList(0, $count);

            $data['sign'] = $sign;
            $this->view('user_salary/edit',$data);
        } else {
            $res = $this->input->post('data');
            parse_str($res, $data);
            //echo '<pre>';print_r($data);die();
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
                if(!empty($v)) {
                    //根据订单id循环插入该订单的每一道工序
                    foreach ($data['process_id'][$v] as $key => $val) {

                        $arr['process_num'] = $data['process_num'][$v][$key];
                        $arr['order_process_id'] = $val;
                        //判断添加过该道工序，有 更新  无 添加
                        $sum = $this->user_process_model->checkUserProcess(' order_process_id="' . $val . '" ');
                        if ($sum > 0) {
                            //更新
                            $ures = $this->user_process_model->edit($data['user_process_id'][$v][$key], array('process_num' => $arr['process_num'],'ispay' => $arr['ispay']));
                            if (!$ures) {
                                $flag = false;
                            }
                        } else {
                            //添加
                            $res = (int)$this->user_process_model->add($arr);
                            if (!$res) {
                                $flag = false;
                            }
                        }

                        $totle += $data['process_num'][$v][$key] * $data['process_price'][$v][$key];

                    }
                    //更新订单当前花费的金额
                    $this->load->model('order_model');
                    $diff_price = $data['salary'] - $totle;
                    if (!$this->order_model->edit($v, $diff_price)) {
                        $flag = false;
                    }
                }
            }

            //更新员工薪资表
            $salary_data['salary'] = $totle;
            $this->load->model('user_salary_model');
            $result = (int) $this->user_salary_model->edit($data['sign'],$salary_data);
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

    public function exportUserSalaryList() {

        $id           = isset($_GET['id'])?(int) $_GET['id']:0;
        $keyword      = isset($_GET['keyword'])?trim($_GET['keyword']):'';
        $pay_status   = isset($_GET['pay_status'])?(int) $_GET['pay_status']:0;
        $order_status = isset($_GET['order_status'])?(int) $_GET['order_status']:0;

        $where = '';
        $where .= 'actid = '.$id;
        if ($keyword != "") {
            $where .= " and (username like '%".$keyword."%' or consignee like '%".$keyword."%' or consignee_phone like '%".$keyword."%')";
        }
        if ($pay_status != 0) {
            $where .= ' and pay_status='.$pay_status;
        }
        if ($order_status != 0) {
            $where .= ' and order_status='.$order_status;
        }
        $order       = 'id desc';
        $count       = $this->gorder->get_count('actid = '.$id);
        $gorder_list = $this->gorder->get_list($where, 1, $count, $order);

        xls_header('用户列表');

        $title = array('ID', '用户名', '联系方式', '报名人数', '报名时间', '订单备注', '付款状态', '确认状态');

        $xls_str = '';
        foreach ($title as $key => $val) {
            $xls_str .= $val."\t";
        }

        $xls_str .= " \n";

        foreach ($gorder_list as $key => $r) {
            $xls_str .= "{$r['userid']} \t";
            $xls_str .= "{$r['username']} \t";
            $xls_str .= $r['consignee_phone']."\t";
            $xls_str .= $r['goods_number']."\t";
            $xls_str .= date('Y-m-d H:i:s', $r['inputtime'])."\t";
            $xls_str .= $r['order_note']."\t";
            $xls_str .= tag(35, 'pay_status', $r['pay_status'])."\t";
            $xls_str .= tag(35, 'order_status', $r['order_status'])."\t";
            $xls_str .= " \n";
        }

        $en = mb_detect_encoding($xls_str, array('UTF-8', 'GBK', 'gb2312'));
        if ($en == 'UTF-8') {
            echo $xls_str;
        } else {
            echo mb_convert_encoding($xls_str, $en, "utf-8");
        }

    }

}