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

    public function add(){
        if(!$this->input->is_ajax_request()){
            $this->load->config('manageAuth');
            $manauth = $this->config->item('manage_auth');
            $this->view('role/add',array('privileges'=>$manauth));
        }else {
            $res = $this->input->post('data');
            parse_str($res, $data);
            if (empty($data['role_name'])) {
                $this->jsonMsg(0, '请输入角色名字');
            }
            if (empty($data['role_desc'])) {
                $this->jsonMsg(0, '请输入角色介绍');
            }
            if (empty($data['privileges'])) {
                $this->jsonMsg(0, '请选择权限');
            }
            $data['role_privileges'] = serialize($data['privileges']);
            unset($data['privileges']);
            $this->load->model('role_model');
            $res = (int)$this->role_model->add($data);
            $this->jsonMsg($res);
        }
    }
}