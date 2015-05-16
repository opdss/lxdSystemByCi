<?php
/**
 * Created by PhpStorm.
 * @author wuxin
 * @date 2015 15/5/8 下午6:52
 * @copyright 7659.com
 */
class ManageAuth {
    private $CI;

    public function __construct() {
        $this->CI = &get_instance();
    }
    /**     * 权限认证  */
    public function auth() {
        $class = strtolower($this->CI->router->class);
        $method = $this->CI->router->method;
        if($class=='login'){
            $this->CI->session->unset_userdata('USER_INFO');
            return;
        }
        $this->CI->load->config('manageAuth');
        $manageAuth = $this->CI->config->item('manage_auth');
        $p = array();
        foreach($manageAuth as $k=>$v){
            $p[] = $k;
            if(isset($v['sub']) && !empty($v['sub'])){
                foreach($v['sub'] as $_k=>$_v){
                    $p[] = $_k;
                }
            }
        }
//var_dump(serialize($p));exit;
        $_U = $this->CI->session->userdata('USER_INFO');
        $ajax = $this->CI->input->is_ajax_request();
        if(empty($_U)){
            $ajax ? $this->CI->jsonMsg(-1) : redirect('login');
        }
        $this->createMenu($_U['privileges']);
        if(!in_array($class.'/'.$method,$p)){
            return;
        }

        if(!in_array($class.'/'.$method,$_U['privileges'])){
            $ajax ? $this->CI->jsonMsg(2) : exit('no auth');
        }
    }

    public function createMenu(array $privileges){
        if(empty($privileges)){return false;}
        $this->CI->load->config('menu');
        $menu = $this->CI->config->item('manage_menu');
        $M = array();
        foreach($menu as $k=>$v){
            if(in_array($k,$privileges)){
                $M[$k] = $v;
                if(isset($v['submenu'])){
                    $sM = array();
                    foreach($v['submenu'] as $_k=>$_v){
                        if(in_array($k.'/'.$_k,$privileges)){
                            $sM[$_k] = $_v;
                        }
                    }
                    $M[$k]['submenu'] = $sM;
                }
            }
        }
        $this->CI->MENU = $M;
    }
}