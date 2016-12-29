<?php
namespace app\admin\validate;

use think\Validate;

/**
 * 轮播图验证器
 * Class Slide
 * @package app\admin\validate
 */
class Slide extends Validate
{
    protected $rule = [
        'cid'  => 'require',
        'name' => 'require',
        'sort' => 'require|number'
    ];

    protected $message = [
        'cid.require'  => '请选择所属分类',
        'name.require' => '请输入名称',
        'sort.require' => '请输入排序',
        'sort.number'  => '排序只能填写数字'
    ];
}