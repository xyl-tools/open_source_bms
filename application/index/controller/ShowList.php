<?php
namespace app\index\controller;

use app\common\controller\HomeBase;
use app\common\model\Category as CategoryModel;
use think\Controller;
use think\Db;

/**
 * 列表页
 * Class ShowList
 * @package app\index\controller
 */
class ShowList extends HomeBase
{
    public function index()
    {
        $cid = $this->request->param('cid/d');

        if (empty($cid)) {
            return false;
        }

        // 当前分类
        $current = CategoryModel::get($cid);
        if (empty($current)) {
            return false;
        }

        $article_list = [];
        $path         = explode(',', $current['path']);
        $pid          = !empty($path[1]) ? $path[1] : $cid;
        // 当前分类顶级父类
        $parent = CategoryModel::get($pid);
        // 当前分类所有子分类
        $children = get_category_children($pid);

        if ($current['type'] == 1) {
            $article_list = get_articles_by_cid_paged($cid);
            $template     = $current['list_template'];
        } else {
            $template = $current['detail_template'];
        }

        return $this->fetch(":{$template}", [
            'parent'       => $parent,
            'current'      => $current,
            'children'     => $children,
            'article_list' => $article_list
        ]);
    }
}