<?php
namespace app\admin\controller;

use app\common\model\Article as ArticleModel;
use app\common\model\Category as CategoryModel;
use app\common\controller\AdminBase;
use think\Db;

/**
 * 栏目管理
 * Class Category
 * @package app\admin\controller
 */
class Category extends AdminBase
{

    protected $category_model;
    protected $article_model;

    protected function _initialize()
    {
        parent::_initialize();
        $this->category_model = new CategoryModel();
        $this->article_model  = new ArticleModel();
        $category_level_list  = $this->category_model->getLevelList();

        $this->assign('category_level_list', $category_level_list);
    }

    /**
     * 栏目管理
     * @return mixed
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 添加栏目
     * @param string $pid
     * @return mixed
     */
    public function add($pid = '')
    {
        return $this->fetch('add', ['pid' => $pid]);
    }

    /**
     * 保存栏目
     */
    public function save()
    {
        if ($this->request->isPost()) {
            $data            = $this->request->param();
            $validate_result = $this->validate($data, 'Category');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                if ($this->category_model->allowField(true)->save($data)) {
                    $this->success('保存成功');
                } else {
                    $this->error('保存失败');
                }
            }
        }
    }

    /**
     * 编辑栏目
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $category = $this->category_model->find($id);

        return $this->fetch('edit', ['category' => $category]);
    }

    /**
     * 更新栏目
     * @param $id
     */
    public function update($id)
    {
        if ($this->request->isPost()) {
            $data            = $this->request->param();
            $validate_result = $this->validate($data, 'Category');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                $children = $this->category_model->where(['path' => ['like', "%,{$id},%"]])->column('id');
                if (in_array($data['pid'], $children)) {
                    $this->error('不能移动到自己的子分类');
                } else {
                    if ($this->category_model->allowField(true)->save($data, $id) !== false) {
                        $this->success('更新成功');
                    } else {
                        $this->error('更新失败');
                    }
                }
            }
        }
    }

    /**
     * 删除栏目
     * @param $id
     */
    public function delete($id)
    {
        $category = $this->category_model->where(['pid' => $id])->find();
        $article  = $this->article_model->where(['cid' => $id])->find();

        if (!empty($category)) {
            $this->error('此分类下存在子分类，不可删除');
        }
        if (!empty($article)) {
            $this->error('此分类下存在文章，不可删除');
        }
        if ($this->category_model->destroy($id)) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
}