<?php
/**
 * Created by PhpStorm.
 * @author wuxin
 * @date 2015 15/5/9 下午12:59
 * @copyright 7659.com
 */
$config['manage_menu'] = array(
	'user'     => array(
		'style'   => "icon-group",
		'desc'    => '员工相关',
		'submenu' => array(
			'user/index'  => '员工管理',
            'department/index' => '部门管理',
		)
	),
	'order'    => array(
		'style'   => "icon-signal",
		'desc'    => '订单工序',
		'submenu' => array(
			'order/index'  => '订单列表',
            'process/index'  => '工序管理',
		)
	),
	'role'     => array(
		'style'   => "icon-calendar-empty",
		'desc'    => '权限管理',
		'submenu' => array(
			'role/index'  => '角色列表',
			'role/add'    => '角色添加',
		)
	),
	'user_salary' => array(
		'style'       => "icon-code-fork",
		'desc'        => '薪资管理',
		'submenu'     => array(
            'user_salary/index' => '薪资单列表',
			'user_process/index'  => '员工工序详情',
			'user_process/add' => '添加个人工序',
		)
	),
);
