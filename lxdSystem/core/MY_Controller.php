<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

/**
 * Created by PhpStorm.
 * @author wuxin
 * @date 2015 15/5/7 下午5:33
 * @copyright 7659.com
 */
class MY_Controller extends CI_Controller {

    protected $settingXml;

	protected $_U = array();
    protected $_SET = array();//全局配置，一个对象

	protected $pageSize;

	protected $style = array(
		'css' => array(
			'bootstrap/bootstrap.css',
			'bootstrap/bootstrap-overrides.css',
			'compiled/layout.css',
			'compiled/elements.css',
			'compiled/icons.css',
			'compiled/signin.css',
			'lib/font-awesome.css',
			'compiled/form-showcase.css',
            'compiled/new-user.css'
		),
		'js' => array(
            'jquery.min.js',
			'bootstrap.min.js',
			'jquery.uniform.min.js',
			'theme.js',
            'code.lates.js',
            'lxd.js'
		)
	);

	protected $restyle = array(
		'css' => array(),
		'js'  => array()
	);

	public function __construct() {
		parent::__construct();
        $this->settingXml = APPPATH.'config/setting.xml';
        $this->_SET = $this->getSetting();
        $this->pageSize = $this->_SET->pageSize->value;
	}

	protected function view($page, $data = null) {
		if (!file_exists(VIEWPATH.$page.'.php')) {
			exit('no template');
			//show_404();
		}
		$head = array(
			'css'   => array_merge($this->style['css'], $this->restyle['css']),
			'js'    => array_merge($this->style['js'], $this->restyle['js']),
			'title' => isset($data['title'])?$data['title']:(isset($this->MENU[$this->router->class]['submenu'][$this->router->method])?$this->MENU[$this->router->class]['submenu'][$this->router->method].'-'.$this->_SET->systemName->value:$this->_SET->systemName->value)
		);
		$this->load->view('public/header', $head);
		if (isset($this->MENU)) {
			$this->load->view('public/menu', array('menu' => $this->MENU));
		}
		$this->load->view($page, $data);
		$this->load->view('public/footer');
	}

	public function jsonMsg($code, $data_msg = '', $type = false) {
		$msg = array(
			-1=> 'please login',
			0 => 'system error',
			1 => 'success',
			2 => 'permission denied',
		);
		$data['code']               = $code;
		$data['msg']                = $code == 1?'success':(!empty($data_msg)?(string) $data_msg:(isset($msg[$code])?$msg[$code]:'error'));
		$code != 1 || $data['data'] = $data_msg;
		if ($type) {
			return $data;
		} else {
			exit(json_encode($data));
		}
	}

    protected function getSetting(){
        $str = file_get_contents($this->settingXml);
        if(empty($str)){
            exit('setting error');
        }
        $setting = new SimpleXMLElement($str);
        return $setting;
    }
}