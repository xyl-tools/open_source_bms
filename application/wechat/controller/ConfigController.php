<?php
/**
 * Created by PhpStorm.
 * User: wuang
 * Date: 2017/7/15
 * Time: 17:39
 */

namespace app\wechat\controller;


use app\common\controller\AdminBaseController;

class ConfigController extends AdminBaseController
{

    public function index()
    {
        return $this->fetch();
    }
}