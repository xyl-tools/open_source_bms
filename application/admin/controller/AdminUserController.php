<?php
namespace app\admin\controller;

use app\admin\model\AdminUser;
use app\admin\model\AuthGroup;
use app\admin\model\AuthGroupAccess;
use app\common\controller\AdminBaseController;
use think\Config;
use think\Db;

/**
 * 管理员管理
 * Class AdminUser
 * @package app\admin\controller
 */
class AdminUserController extends AdminBaseController
{
    /**
     * 管理员管理
     * @return mixed
     */
    public function index()
    {
        $admin_user_list = AdminUser::all();
        return $this->fetch('index', ['admin_user_list' => $admin_user_list]);
    }

    /**
     * 添加管理员
     * @return mixed
     */
    public function add()
    {
        $auth_group_list = AuthGroup::all();
        return $this->fetch('add', ['auth_group_list' => $auth_group_list]);
    }

    /**
     * 保存管理员
     * @param $group_id
     */
    public function save($group_id)
    {
        $adminUserModel = new AdminUser();
        $authGroupAccessModel = new AuthGroupAccess();
        if ($this->request->isPost()) {
            $data            = $this->request->param();
            $validate_result = $this->validate($data, 'AdminUser');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                $data['password'] = $adminUserModel->encrypt($data['password']);
                if ( $adminUserModel->allowField(true)->save($data)) {
                    $auth_group_access['uid']      = $adminUserModel->id;
                    $auth_group_access['group_id'] = $group_id;
                    $authGroupAccessModel->save($auth_group_access);
                    $this->success('保存成功');
                } else {
                    $this->error('保存失败');
                }
            }
        }
    }

    /**
     * 编辑管理员
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $model = new AdminUser();
        $admin_user             = $model->where(['id'=>$id])->find();
        $auth_group_list        = AuthGroup::all();
        return $this->fetch('edit', ['admin_user' => $admin_user, 'auth_group_list' => $auth_group_list]);
    }

    /**
     * 更新管理员
     * @param $id
     * @param $group_id
     */
    public function update($id, $group_id)
    {
        $adminUserModel = new AdminUser();
        if ($this->request->isPost()) {
            $data            = $this->request->param();
            $validate_result = $this->validate($data, 'AdminUser');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                $admin_user = $adminUserModel->find($id);
                $admin_user->username = $data['username'];
                $admin_user->status   = $data['status'];
                if (!empty($data['password']) && !empty($data['confirm_password'])) {
                    $admin_user->password = $data['password'];
                }
                if ($admin_user->save() !== false) {
                    $auth_group_access['group_id'] = $group_id;
                    $admin_user->authGroupAccess->group_id = $group_id;
                    $admin_user->authGroupAccess->save();
                    $this->success('更新成功');
                } else {
                    $this->error('更新失败');
                }
            }
        }
    }

    /**
     * 删除管理员
     * @param $id
     */
    public function delete($id)
    {
        if ($id == 1) {
            $this->error('默认管理员不可删除');
        }
        if ($this->adminUserModel->destroy($id)) {
            $this->authGroupAccessModel->where('uid', $id)->delete();
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
}