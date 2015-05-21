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
}