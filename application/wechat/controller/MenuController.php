<?php
/**
 * Created by PhpStorm.
 * User: wuang
 * Date: 2017/7/23
 * Time: 14:52
 */

namespace app\wechat\controller;


use app\common\controller\AdminBaseController;

class MenuController extends AdminBaseController
{

    public function index()
    {
        return $this->fetch();
    }

}