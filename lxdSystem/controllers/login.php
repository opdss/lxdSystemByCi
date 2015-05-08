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
        $this->view('login/index');
    }

    public function checkAuth(){
        if(!$this->input->is_ajax_request()){
            return false;
        }
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        echo json_encode(array('code'=>0,'msg'=>$username.$password));
    }
}