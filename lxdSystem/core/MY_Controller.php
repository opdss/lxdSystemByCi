<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * @author wuxin
 * @date 2015 15/5/7 下午5:33
 * @copyright 7659.com
 */
class MY_Controller extends CI_Controller {

    public $style = array(
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

    public $restyle = array(
        'css' => array(),
        'js' => array()
    );

	public function __construct(){
		parent::__construct();
	}

    public function view($page,$data=null){
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
}