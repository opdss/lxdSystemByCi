<?php
/**
 * Created by PhpStorm.
 * @author wuxin
 * @date 2015 15/5/9 下午12:00
 * @copyright 7659.com
 */
$config['manage_auth'] = array(

    'user' => array(
        'name' => '员工管理',
        'sub' => array(
            'user/index' => '全部员工',            
            'user/add' => '添加员工',
        )
    ),
    'department' => array(
        'name' => '部门管理',
        'sub' => array(
            'user/index' => '部门列表',
            'user/info' => '部门详情',
            'user/edit' => '部门信息',
            'user/add' => '添加部门',
        )
    ),
    'role' => array(
        'name' => '角色管理',
        'sub' => array(
            'role/index' => '角色列表',
            'role/del' => '角色删除',
            'role/edit' => '角色修改',
            'role/add' => '角色添加',
        )
    ),
);