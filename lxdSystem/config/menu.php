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
		'desc'    => '员工管理',
		'submenu' => array(
			'index'  => '全部员工',
			'add'    => '添加员工',
		)
	),
	'department' => array(
		'style'     => "icon-th-large",
		'desc'      => '部门管理',
		'submenu'   => array(
			'index'    => '部门列表',
			'add'      => '添加部门',
		)
	),
	'order'    => array(
		'style'   => "icon-signal",
		'desc'    => '订单管理',
		'submenu' => array(
			'index'  => '订单列表',
			'add'    => '添加订单',
		)
	),
	'process'  => array(
		'style'   => "icon-edit",
		'desc'    => '工序管理',
		'submenu' => array(
			'index'  => '工序列表',
			'add'    => '添加工序',
		)
	),
	'role'     => array(
		'style'   => "icon-calendar-empty",
		'desc'    => '权限管理',
		'submenu' => array(
			'index'  => '角色列表',
			'add'    => '角色添加',
		)
	),
	'user_process' => array(
		'style'       => "icon-code-fork",
		'desc'        => '工资结算管理',
		'submenu'     => array(
			'index'      => '员工工资列表',
			'add'        => '添加个人工序',
		)
	),
    'user_salary' => array(
        'style'       => "icon-code-fork",
        'desc'        => '员工薪资',
        'submenu'     => array(
            'index' => '薪资单列表',
        )
    ),
);
