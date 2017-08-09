<?php
namespace app\admin\controller;

use app\common\model\Link as LinkModel;
use app\common\controller\AdminBaseController;
use think\Db;

/**
 * 友情链接
 * Class Link
 * @package app\admin\controller
 */
class LinkController extends AdminBaseController
{
    protected $linkModel;

    protected function _initialize()
    {
        parent::_initialize();
        $this->linkModel = new LinkModel();
    }

    /**
     * 友情链接
     * @return mixed
     */
    public function index()
    {
        $link_list = $this->linkModel->select();

        return $this->fetch('index', ['link_list' => $link_list]);
    }

    /**
     * 添加友情链接
     * @return mixed
     */
    public function add()
    {
        return $this->fetch();
    }

    /**
     * 保存友情链接
     */
    public function save()
    {
        if ($this->request->isPost()) {
            $data            = $this->request->param();
            $validate_result = $this->validate($data, 'Link');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                if ($this->linkModel->allowField(true)->save($data)) {
                    $this->success('保存成功');
                } else {
                    $this->error('保存失败');
                }
            }
        }
    }

    /**
     * 编辑友情链接
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $link = $this->linkModel->find($id);

        return $this->fetch('edit', ['link' => $link]);
    }

    /**
     * 更新友情链接
     * @param $id
     */
    public function update($id)
    {
        if ($this->request->isPost()) {
            $data            = $this->request->param();
            $validate_result = $this->validate($data, 'Link');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                if ($this->linkModel->allowField(true)->save($data, $id) !== false) {
                    $this->success('更新成功');
                } else {
                    $this->error('更新失败');
                }
            }
        }
    }

    /**
     * 删除友情链接
     * @param $id
     */
    public function delete($id)
    {
        if ($this->linkModel->destroy($id)) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
}