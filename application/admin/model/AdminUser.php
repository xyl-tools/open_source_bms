<?php

namespace app\admin\model;

use think\Config;
use think\Model;

/**
 * This is the model class for table "os_admin_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $status
 * @property string $create_time
 * @property string $last_login_time
 * @property string $last_login_ip
 * @property AuthGroupAccess $authGroupAccess
 */
class AdminUser extends Model
{
    protected $insert = ['create_time'];

    /**
     * 创建时间
     * @return bool|string
     */
    protected function setCreateTimeAttr()
    {
        return date('Y-m-d H:i:s');
    }

    public function setPasswordAttr($val)
    {
        return $this->encrypt($val);
    }
    public function verifyPassword($password){
        return $this->getAttr('password') === $this->encrypt($password);
    }

    public function encrypt($val){
        return md5($val . Config::get('salt'));
    }


    public function authGroupAccess(){
        return $this->hasOne('AuthGroupAccess','uid');
    }
    public function getGroupIdAttr(){
        return $this->authGroupAccess->group_id;
    }
}
