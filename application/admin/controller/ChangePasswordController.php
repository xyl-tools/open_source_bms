<?php
namespace app\admin\controller;

use app\common\controller\AdminBaseController;
use app\common\model\AdminUser as AdminUserModel;
use think\Config;
use think\Db;
use think\Session;

/**
 * 修改密码
 * Class ChangePassword
 * @package app\admin\controller
 */
class ChangePasswordController extends AdminBaseController
{
    /**
     * 修改密码
     * @return mixed
     */
    public function index()
    {
        return $this->fetch('system/change_password');
    }

    /**
     * 更新密码
     */
    public function updatePassword()
    {
        if ($this->request->isPost()) {
            $admin_id    = Session::get('admin_id');
            $data   = $this->request->param();
            /*@ver $user AdminUserModel*/

            $user = AdminUserModel::get($admin_id);


            if ($user->verifyPassword($data['old_password'])) {
                if ($data['password'] == $data['confirm_password']) {
                    $user->password = $data['password'];
                    $res          = $user->save();
                    if ($res !== false) {
                        $this->success('修改成功');
                    } else {
                        $this->error('修改失败');
                    }
                } else {
                    $this->error('两次密码输入不一致');
                }
            } else {
                $this->error('原密码不正确');
            }
        }
    }
}