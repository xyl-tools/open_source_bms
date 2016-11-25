<?php
namespace app\admin\model;

use think\Model;

class AdminUser extends Model {

    protected $insert = ['create_time'];
    
    /**
     * 创建时间
     * @return bool|string
     */
    protected function setCreateTimeAttr() {
        return date('Y-m-d H:i:s');
    }
}