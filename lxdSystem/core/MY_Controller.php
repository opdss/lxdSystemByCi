<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * @author wuxin
 * @date 2015 15/5/7 下午5:33
 * @copyright 7659.com
 */
class MY_Controller extends CI_Controller {

    protected $style = array(
        'css' => array(
            'compiled/layout.css',
            'compiled/elements.css',
            'compiled/icons.css'
        ),
        'js' => array(
            'bootstrap.min.js',
            'theme.js'
        )
    );

    protected $restyle = array(
        'css' => array(),
        'js' => array()
    );

	public function __construct(){
		parent::__construct();
	}

    protected function view($page,$data=null){
        if ( ! file_exists(VIEWPATH.$page.'.php')){
            // 页面不存在
            show_404();
        }
        $head = array(
            'css' => array_merge($this->style['css'],$this->restyle['css']),
            'js' => array_merge($this->style['js'],$this->restyle['js']),
            'title' => isset($data['title']) ? $data['title'] : 'title'
        );
        $this->load->view('public/header', $head);
        $this->load->view($page, $data);
        $this->load->view('public/footer');
    }

    protected function jsonMsg(array $param,$type=false){
        $param = array_merge(array('code'=>1,'msg'=>'','data'=>array()),$param);
        $msg = array(
            -1 => 'please login',
            0 => 'system error',
            1 => 'success',
        );
        $data['code'] = $param['code'];
        $data['msg'] = $param['msg'] ? $param['msg'] : (isset($msg[$param['code']]) ? $msg[$param['code']] : 'error');
        if($param['code']==1){
            $data['data'] = $param['data'];
        }
        if($type){
            return $data;
        }else{
            exit(json_encode($data));
        }
    }
}