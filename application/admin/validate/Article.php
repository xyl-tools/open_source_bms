<?php
namespace app\admin\validate;

use think\Validate;

class Article extends Validate {
    protected $rule = [
        'title' => 'require',
        'sort'  => 'require|number'
    ];

    protected $message = [
        'title.require' => '请输入标题',
        'sort.require'  => '请输入排序',
        'sort.number'   => '排序只能填写数字'
    ];
}