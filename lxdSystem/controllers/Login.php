<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * @author wuxin
 * @date 2015 15/5/7 下午5:33
 * @copyright 7659.com
 */
class Login extends MY_Controller {

    public function index(){
        $this->restyle['css'] = array(
            'compiled/signin.css',
            'bootstrap/bootstrap.css',
            'bootstrap/bootstrap-overrides.css',
            'compiled/layout.css',
            'lib/font-awesome.css',
        );
        $data['title'] = '隆鑫达后台系统登录';
        $this->view('login/index',$data);
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

    public function checkOut(){
        redirect('login');
    }
}