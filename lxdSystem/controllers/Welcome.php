<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * @author wuxin
 * @date 2015 15/5/8 下午3:05
 * @copyright 7659.com
 */
class Welcome extends MY_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}
}
