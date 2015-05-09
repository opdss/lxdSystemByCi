<?php
/**
 * Created by PhpStorm.
 * @author wuxin
 * @date 2015 15/5/9 下午12:59
 * @copyright 7659.com
 */
$config['manage_menu'] = array(
    'role' => array(
        'style' => "icon-signal",
        'desc'  => '权限管理',
        'submenu' => array(
            'index' => '角色列表',
            'del' => '角色删除',
            'edit' => '角色修改',
            'add' => '角色添加',
        )
    ),
    'user' => array(
        'style' => "icon-signal",
        'desc'  => '员工管理',
        'submenu' => array(
            'index' => '全部员工',
            'info' => '员工详情',
            'edit' => '修改信息',
            'add' => '添加员工',
        )
    ),
);
