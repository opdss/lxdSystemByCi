<?php
/**
 * Created by PhpStorm.
 * @author wuxin
 * @date 2015 15/5/21 上午10:12
 * @copyright 7659.com
 */
class Setting extends MY_Controller{

    public function index(){
        $this->view('setting/index', array('setting'=>$this->_G['_SET']));
    }

    public function edit(){
        if($this->input->is_ajax_request()){
            $res = $this->input->post('data');
            parse_str($res, $data);
            array_map('trim',$data);

            foreach ($data as $k=>$v){
                $this->_G['_SET']->$k->value = $v;
            }
            $res = (int)$this->_G['_SET']->asXML($this->settingXml);
            $this->jsonMsg($res);
        }
    }

    public function editPwd(){

        if($this->input->is_ajax_request()){
            $res = $this->input->post('data');
            parse_str($res, $data);
            array_map('trim',$data);
            $user_info = $this->session->userdata('USER_INFO');
            if(empty($data['old_pwd']) || empty($data['new_pwd']) ||empty($data['confirm_new_pwd'])){
                $this->jsonMsg(0, '请填写完整');
            }
            if($user_info['pwd']!=md5($data['old_pwd'])){
                $this->jsonMsg(0, '原密码错误');
            }
            if($data['new_pwd']!=$data['confirm_new_pwd']){
                $this->jsonMsg(0, '两次输入的密码不一致');
            }
            $new_pwd = md5($data['new_pwd']);

            $this->load->model('user_model');
            $result = $this->user_model->edit($user_info['id'], array('pwd'=>$new_pwd));
            if($result){
                $this->jsonMsg(1);
            }

        }else{
            $this->view('setting/edit_pwd');
        }
    }
}