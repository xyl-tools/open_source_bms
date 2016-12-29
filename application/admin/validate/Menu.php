<?php
namespace app\admin\validate;

use think\Validate;

class Menu extends Validate
{
    protected $rule = [
        'pid'   => 'require',
        'title' => 'require',
        'name'  => 'require',
        'sort'  => 'require|number'
    ];

    protected $message = [
        'pid.require'   => '请选择上级菜单',
        'title.require' => '请输入菜单名称',
        'name.require'  => '请输入控制器方法',
        'sort.require'  => '请输入排序',
        'sort.number'   => '排序只能填写数字'
    ];
}