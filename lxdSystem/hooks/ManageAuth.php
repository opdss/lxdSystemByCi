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
        $class = $this->CI->router->class;
        $method = $this->CI->router->method;
        if($class=='login'){
            return;
        }
        $ajax = $this->CI->input->is_ajax_request();
        $_U = $this->CI->session->userdata('userdata');
        if(empty($_U)){
            $ajax ? $this->CI->jsonMsg(-1) : redirect('login');
        }
    }
}