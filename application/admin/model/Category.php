<?php
namespace app\admin\model;

use think\Db;
use think\Model;

class Category extends Model {

    /**
     * 反转义HTML实体标签
     * @param $value
     * @return string
     */
    protected function setContentAttr($value){
        return htmlspecialchars_decode($value);
    }

    /**
     * 获取层级缩进列表数据
     * @return array
     */
    public function getLevelList() {
        $category_level = $this->order(['sort' => 'DESC', 'id' => 'ASC'])->select();

        return array2level($category_level);
    }

}