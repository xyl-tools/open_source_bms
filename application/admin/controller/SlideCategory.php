<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\Db;

/**
 * 轮播图分类
 * Class SlideCategory
 * @package app\admin\controller
 */
class SlideCategory extends AdminBase
{
    protected function _initialize()
    {
        parent::_initialize();

    }

    /**
     * 轮播图分类
     * @return mixed
     */
    public function index()
    {
        $slide_category_list = Db::name('slide_category')->select();

        return $this->fetch('index', ['slide_category_list' => $slide_category_list]);
    }

    /**
     * 添加分类
     * @return mixed
     */
    public function add()
    {
        return $this->fetch();
    }

    /**
     * 保存分类
     */
    public function save()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();

            if (Db::name('slide_category')->insert($data)) {
                $this->success('保存成功');
            } else {
                $this->error('保存失败');
            }
        }
    }

    /**
     * 编辑分类
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $slide_category = Db::name('slide_category')->find($id);

        return $this->fetch('edit', ['slide_category' => $slide_category]);
    }

    /**
     * 更新分类
     * @throws \think\Exception
     */
    public function update()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();

            if (Db::name('slide_category')->update($data) !== false) {
                $this->success('更新成功');
            } else {
                $this->error('更新失败');
            }
        }
    }

    /**
     * 删除分类
     * @param $id
     * @throws \think\Exception
     */
    public function delete($id)
    {
        if (Db::name('slide_category')->delete($id) !== false) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
}