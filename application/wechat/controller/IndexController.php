<?php
/**
 * Created by PhpStorm.
 * User: wuang
 * Date: 2017/7/15
 * Time: 17:51
 */

namespace app\wechat\controller;


use think\Response;

class IndexController
{

    public function index()
    {
        return new Response('aaa');
    }
}