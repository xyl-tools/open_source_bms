<?php
namespace app\index\controller;

use app\common\controller\HomeBase;

class Index extends HomeBase {
    public function index() {
        
        return $this->fetch();
    }
}
