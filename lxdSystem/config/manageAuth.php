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
			'user/add'   => '添加员工',
		)
	),
	'order'         => array(
		'name'         => '部门管理',
		'sub'          => array(
			'order/index' => '订单列表',
			'order/info'  => '订单详情',
			'order/edit'  => '修改订单信息',
			'order/add'   => '添加订单',
			'order/del'   => '删除订单',
		)
	),
	'process'         => array(
		'name'           => '工序管理',
		'sub'            => array(
			'process/index' => '工序列表',
			'process/edit'  => '修改工序信息',
			'process/add'   => '添加工序',
			'process/del'   => '删除工序',
		)
	),
	'department'         => array(
		'name'              => '部门管理',
		'sub'               => array(
			'department/index' => '部门列表',
			'department/info'  => '部门详情',
			'department/edit'  => '部门信息',
			'department/add'   => '添加部门',
			'department/del'   => '删除部门',
		)
	),
	'role'         => array(
		'name'        => '角色管理',
		'sub'         => array(
			'role/index' => '角色列表',
			'role/del'   => '角色删除',
			'role/edit'  => '角色修改',
			'role/add'   => '角色添加',
		)
	),
	'user_process'         => array(
		'name'                => '员工工序管理',
		'sub'                 => array(
			'user_process/index' => '员工工序列表',
			'user_process/del'   => '删除员工工序',
			'user_process/edit'  => '修改员工工序',
			'user_process/add'   => '添加员工工序',
		)
	),
);