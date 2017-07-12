<?php
namespace app\index\controller;

use app\common\controller\HomeBaseController;
use think\Db;

class IndexController extends HomeBaseController
{
    public function index()
    {
        return $this->fetch();
    }
}
