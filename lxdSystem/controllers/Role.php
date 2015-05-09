<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * @author wuxin
 * @date 2015 15/5/9 下午2:58
 * @copyright 7659.com
 */
class Role extends MY_Controller {

    public function index(){
        $kw = $this->input->get('kw');
        $p = (int)$this->input->get('p');
        $p = $p ? $p : 1;
        $this->load->model('role_model');
        $count = $this->role_model->getTotal($kw);
        $offset = ($p-1)*$this->pageSize;

        $data['list'] = $this->role_model->getList($offset,$this->pageSize,$kw);

        $this->load->library('page',array('total'=>$count,'pageSize'=>$this->pageSize));
        $data['page_show'] = $this->page->pageShow();
        $data['kw'] = $kw;

        $this->view('role/index',$data);
    }

    public function checkAuth(){
        if(!$this->input->is_ajax_request()){
            return false;
        }
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->load->model('user_model');
        $res = $this->user_model->checkUser($username,$password);
        if(empty($res)){
            $this->jsonMsg(0,'账号或者密码错误');
        }
        $this->session->set_userdata('USER_INFO',$res);
        $this->session->set_userdata('uid',$res['id']);
        $this->jsonMsg(1);
    }
}