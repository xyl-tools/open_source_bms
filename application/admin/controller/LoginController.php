<?php
namespace app\admin\controller;

use think\Config;
use think\Controller;
use think\Db;
use think\Session;
use app\common\model\AdminUser as AdminUserModel;

/**
 * 后台登录
 * Class Login
 * @package app\admin\controller
 */
class LoginController extends Controller
{
    /**
     * 后台登录
     * @return mixed
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 登录验证
     * @return string
     */
    public function login()
    {
        if ($this->request->isPost()) {
            $data            = $this->request->only(['username', 'password', 'verify']);
            $validate_result = $this->validate($data, 'Login');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                $adminUser = AdminUserModel::get(['username'=>$data['username']]);
                if (!empty($adminUser)  && $adminUser->verifyPassword($data['password'])) {
                    if ($adminUser->status != 1) {
                        $this->error('当前用户已禁用');
                    } else {
                        Session::set('admin_id', $adminUser['id']);
                        Session::set('admin_name', $adminUser['username']);
                        $adminUser->last_login_ip = $this->request->ip();
                        $adminUser->last_login_time = date('Y-m-d H:i:s');
                        $adminUser->save();
                        $this->success('登录成功', 'admin/index/index');
                    }
                } else {
                    $this->error('用户名或密码错误');
                }
            }
        }
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        Session::delete('admin_id');
        Session::delete('admin_name');
        $this->success('退出成功', 'admin/login/index');
    }
}
