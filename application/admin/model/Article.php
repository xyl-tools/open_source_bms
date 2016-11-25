<?php
namespace app\admin\model;

use think\Model;
use think\Session;

class Article extends Model {

    protected $insert = ['create_time'];

    /**
     * 文章作者
     * @param $value
     * @return mixed
     */
    protected function setAuthorAttr($value) {
        return $value ? $value : Session::get('admin_name');
    }

    /**
     * 反转义HTML实体标签
     * @param $value
     * @return string
     */
    protected function setContentAttr($value) {
        return htmlspecialchars_decode($value);
    }

    /**
     * 创建时间
     * @return bool|string
     */
    protected function setCreateTimeAttr() {
        return date('Y-m-d H:i:s');
    }
}