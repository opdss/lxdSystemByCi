<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * @author wuxin
 * @date 2015 15/5/10 下午8:10
 * @copyright 7659.com
 */
class User extends MY_Controller{

    function index(){
        $kw = $this->input->get('kw');
        $p = (int)$this->input->get('p');
        $p = $p ? $p : 1;
        $this->load->model('user_model');
        $count = $this->user_model->getTotal($kw);
        $offset = ($p-1)*$this->pageSize;

        $data['list'] = $this->user_model->getList($offset,$this->pageSize,$kw);

        $this->load->library('page',array('total'=>$count,'pageSize'=>$this->pageSize));
        $data['page_show'] = $this->page->pageShow();
        $data['kw'] = $kw;

        $this->view('user/index',$data);
    }

    function info(){

    }

    function del(){

    }

    function add(){

    }
}