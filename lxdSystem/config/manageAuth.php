<?php
/**
 * Created by PhpStorm.
 * @author wuxin
 * @date 2015 15/5/9 下午12:00
 * @copyright 7659.com
 */
$config['manage_auth'] = array(

	'user'         => array(
		'name'        => '员工管理',
		'sub'         => array(
			'user/index' => '全部员工',
            'user/info' => '员工详情',
			'user/add'   => '添加员工',
			'user/del'   => '删除员工',
			'user/edit'   => '修改员工',
		)
	),
    'department'         => array(
        'name'              => '部门管理',
        'sub'               => array(
            'department/index' => '部门列表',
            'department/info'  => '部门详情',
            'department/edit'  => '修改部门信息',
            'department/add'   => '添加部门',
            'department/del'   => '删除部门',
        )
    ),
	'order'         => array(
		'name'         => '订单管理',
		'sub'          => array(
			'order/index' => '订单列表',
			'order/info'  => '订单详情',
			'order/edit'  => '修改订单信息',
			'order/add'   => '添加订单',
			'order/del'   => '删除订单',
			'order/order_process'   => '订单工序管理',
		)
	),
	'process'         => array(
		'name'           => '工序管理',
		'sub'            => array(
			'process/index' => '工序列表',
            'process/info'  => '工序详情',
			'process/edit'  => '修改工序信息',
			'process/add'   => '添加工序',
			'process/del'   => '删除工序',
		)
	),
	'role'         => array(
		'name'        => '角色管理',
		'sub'         => array(
			'role/index' => '角色列表',
            'role/info' => '角色详情',
			'role/del'   => '角色删除',
			'role/edit'  => '角色修改',
			'role/add'   => '角色添加',
		)
	),
	'user_process'         => array(
		'name'                => '工资结算管理',
		'sub'                 => array(
			'user_process/index' => '员工工资列表',
			'user_process/add'   => '添加员工工序',
            'user_process/pay'   => '结算工资',
            'user_process/edit'  => '修改员工工序',
		)
	),
    'user_salary'         => array(
        'name'                => '员工薪资',
        'sub'                 => array(
            'user_salary/index' => '薪资单列表',
            'user_salary/info'   => '薪资详情',
            'user_salary/edit'  => '修改员工工序',
        )
    ),
);