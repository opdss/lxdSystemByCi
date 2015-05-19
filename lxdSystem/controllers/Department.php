<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: jlping
 * Date: 15/5/18
 * Time: 11:28
 */
class Department extends MY_Controller {

    public function index(){
        $kw = $this->input->get('kw');
        $p = (int)$this->input->get('p');
        $p = $p ? $p : 1;

        $where = ' 1 ';
        $where .= $kw ? ' and dept_name like "%'.$kw.'%" ' : '';

        $this->load->model('department_model');
        $count = $this->department_model->getTotal($where);
        $offset = ($p-1)*$this->pageSize;
        $data['list'] = $this->department_model->getList($offset,$this->pageSize,$where);

        $this->load->library('page',array('total'=>$count,'pageSize'=>$this->pageSize));
        $data['page_show'] = $this->page->pageShow();
        $data['kw'] = $kw;

        $this->view('department/index',$data);
    }

    public function add(){
        if(!$this->input->is_ajax_request()){
            $this->load->model('department_model');
            $count = $this->department_model->getTotal();
            $dept_list = $this->department_model->getList(0,$count);
            $dept_list = $this->department_model->generateTree($dept_list);
            //echo '<pre>';var_dump($dept_list);die();
            $this->view('department/add',array('dept_list'=>$dept_list));
        }else {
            $res = $this->input->post('data');
            parse_str($res, $data);
            if (empty($data['dept_name'])) {
                $this->jsonMsg(0, '请输入部门名字');
            }
            if (empty($data['dept_desc'])) {
                $this->jsonMsg(0, '请输入部门介绍');
            }
            $data['create_time'] = TIMESTAMP;
            $api_key = 'n0nLmtkc0Q3anWxGYGyww4rl';
            $url = 'http://openapi.baidu.com/public/2.0/bmt/translate?client_id='.$api_key.'&q='.$data['dept_name'].'&from=auto&to=auto';
            $result = $this->curls($url);
            $result = json_decode($result,true);
            $data['dept_no'] = $result['trans_result'][0]['dst'];
            $this->load->model('department_model');
            $res = (int)$this->department_model->add($data);
            if($res)
                $this->jsonMsg(1);
            else
                $this->jsonMsg($res);
        }
    }

    public function edit(){
        //访问页面
        $this->load->model('department_model');
        if(!$this->input->is_ajax_request()){
            if(!($id = (int)$this->input->get('id'))){
                exit('no this product');
            }
            $count = $this->department_model->getTotal();
            $dept_list = $this->department_model->getList(0,$count);
            $data['dept_list'] = $this->department_model->generateTree($dept_list);
            $data['dept_info'] = $this->department_model->getRowById($id);

            $this->view('department/edit',$data);
        }
        //ajax提交数据
        else{
            $res = $this->input->post('data');
            parse_str($res, $data);
            if(!$data['id']){
                $this->jsonMsg(0);
            }
            $id = $data['id'];
            unset($data['id']);
            if (empty($data['dept_name'])) {
                $this->jsonMsg(0, '请输入部门名字');
            }
            if (empty($data['dept_desc'])) {
                $this->jsonMsg(0, '请输入部门介绍');
            }
            $data['create_time'] = TIMESTAMP;
            $api_key = 'n0nLmtkc0Q3anWxGYGyww4rl';
            $url = 'http://openapi.baidu.com/public/2.0/bmt/translate?client_id='.$api_key.'&q='.$data['dept_name'].'&from=auto&to=auto';
            $result = $this->curls($url);
            $result = json_decode($result,true);
            $data['dept_no'] = $result['trans_result'][0]['dst'];

            $this->load->model('department_model');
            $res = (int)$this->department_model->edit($id,$data);
            $this->jsonMsg($res);
        }
    }

    public function del(){
        if($this->input->is_ajax_request()){
            $id = (int)$this->input->post('id');
            if(!$id){
                $this->jsonMsg(0);
            }
            $this->load->model('department_model');
            $res = (int)$this->department_model->del($id);
            $this->jsonMsg($res);
        }
    }

    public function curls($url, $timeout = '60')
    {
        // 1. 初始化
        $ch = curl_init();
        // 2. 设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        // 3. 执行并获取HTML文档内容
        $info = curl_exec($ch);
        // 4. 释放curl句柄
        curl_close($ch);

        return $info;
    }
}