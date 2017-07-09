<?php
namespace app\common\model;

use think\Config;
use think\Model;

/**
 * 管理员模型
 * Class AdminUser Model
 * @package app\common\model
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $status
 * @property string $createTime
 * @property string $last_login_time
 * @property string $last_login_ip
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
}