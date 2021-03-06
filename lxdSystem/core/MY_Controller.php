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

	public $_G = array(
        '_U'=>array(),//全局，用户登陆信息
        '_SET'=>array(),//全局配置，一个对象
    );
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
        $this->_G['_SET'] = $this->getSetting();
        $this->pageSize = $this->_G['_SET']->pageSize->value;
        $this->chenkRePost();
	}

	protected function view($page, $data = array()) {
		if (!file_exists(VIEWPATH.$page.'.php')) {
			exit('no template');
			//show_404();
		}
		$head = array(
			'css'   => array_merge($this->style['css'], $this->restyle['css']),
			'js'    => array_merge($this->style['js'], $this->restyle['js']),
			'title' => isset($data['title'])?$data['title']:(isset($this->MENU[$this->router->class]['submenu'][$this->router->method])?$this->MENU[$this->router->class]['submenu'][$this->router->method].'-'.$this->_G['_SET']->systemName->value:$this->_G['_SET']->systemName->value)
		);
		$this->load->view('public/header', $head);
		if (isset($this->MENU)) {
			$this->load->view('public/menu', array_merge(array('menu' => $this->MENU),$this->_G));
		}
		$this->load->view($page, array_merge($data,$this->_G));
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

    /**
     * 输出头部为xls
     */
    protected function xlsHeader($file_name = "export")
    {
        $ua = $_SERVER["HTTP_USER_AGENT"];
        if (preg_match("/MSIE/", $ua)) {
            $file_name = urlencode($file_name);
            $file_name = str_replace("+", "%20", $file_name);
        }
        header ( "Expires: 0" );
        header ( 'Content-Type: application/vnd.ms-excel');
        header ( 'Content-Disposition: attachment;filename="' . $file_name . date('Y-m-d',time()). '.xls"' );
        header ( 'Cache-Control: max-age=0' );
        // If you're serving to IE 9, then the following may be needed
        header ( 'Cache-Control: max-age=1' );
        // If you're serving to IE over SSL, then the following may be needed
        header ( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' ); // Date in the past
        header ( 'Last-Modified: ' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' ); // always modified
        header ( 'Cache-Control: cache, must-revalidate' ); // HTTP/1.1
        header ( 'Pragma: public' ); 						// HTTP/1.0
    }

    private function chenkRePost($t=3){
        if($this->input->is_ajax_request()){
            $re = md5(serialize($_POST));
            $re_val = $this->session->userdata($re);
            $this->session->set_userdata($re,TIMESTAMP);
            if($re_val && (TIMESTAMP-$re_val<$t)){
                $this->jsonMsg(0,'请不要重复提交请求相同的数据');
            }
        }
    }
}