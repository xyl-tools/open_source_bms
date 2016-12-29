<?php
namespace app\common\model;

use think\Db;
use think\Model;

class SlideCategory extends Model
{
    /**
     * 获取轮播图分类列表
     * @return false|static[]
     */
    public function getSlideCategoryList()
    {
        $slide_category_list = self::all();

        return $slide_category_list;
    }
}