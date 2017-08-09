<?php

use think\migration\Migrator;
use think\migration\db\Column;

class WechatFans extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('wechat_fans',['id'=>false,'primary_key'=>['id'],'comment'=>'微信粉丝','engine'=>'InnoDB','collation'=>'utf8mb4_general_ci']);
        $table->addColumn('id','biginteger',['identity'=>true,'signed'=>true])
            ->addColumn('appid','string',['limit'=>50,'default'=>null,'null'=>true,'comment'=>'公众号Appid'])
            ->addColumn('groupid','biginteger',['limit'=>20,'signed'=>true,'default'=>null,'null'=>true,'comment'=>'分组ID'])
            ->addColumn('tagid_list','string',['limit'=>100,'default'=>'','comment'=>'标签ID'])
            ->addColumn('is_back','boolean',['signed'=>true,'default'=>0,'comment'=>'是否为黑名单用户'])
            ->addColumn('subscribe','boolean',['signed'=>true,'default'=>0,'comment'=>'用户是否订阅该公众号，0：未关注，1：已关注'])
            ->addColumn('openid','char',['default'=>'','limit'=>100,'comment'=>'用户的标识，对当前公众号唯一'])
            ->addColumn('spread_openid','char',['limit'=>100,'default'=>'','comment'=>'推荐人OPENID'])
            ->addColumn('spread_at','datetime',['default'=>null,'null'=>true])
            ->addColumn('nickname','string',['limit'=>20,'comment'=>'用户的昵称'])
            ->addColumn('sex','boolean',['signed'=>true,'default'=>null,'null'=>true,'comment'=>'用户的性别，值为1时是男性，值为2时是女性，值为0时是未知'])
            ->addColumn('country','string',['limit'=>50,'default'=>null,'null'=>true,'comment'=>'用户所在国家'])
            ->addColumn('province','string',['limit'=>50,'default'=>null,'null'=>true,'comment'=>'用户所在省份'])
            ->addColumn('city','string',['limit'=>50,'default'=>null,'null'=>true,'comment'=>'用户所在城'])
            ->addColumn('language','string',['limit'=>50,'default'=>null,'null'=>true,'comment'=>'用户的语言，简体中文为zh_CN'])
            ->addColumn('headimgurl','string',['limit'=>500,'default'=>null,'null'=>true,'comment'=>'用户头像url'])
            ->addColumn('subscribe_at','datetime',['default'=>null,'null'=>true,'comment'=>'用户关注时间'])
            ->addColumn('unionid','string',['limit'=>100,'default'=>null,'null'=>true,'comment'=>'unionid'])
            ->addColumn('remark','string',['limit'=>100,'default'=>null,'null'=>true,'comment'=>'备注'])
            ->addColumn('expires_in','biginteger',['signed'=>true,'default'=>0,'comment'=>'有效时间'])
            ->addColumn('refresh_token','string',['limit'=>200,'default'=>null,'null'=>true,'comment'=>'刷新token'])
            ->addColumn('access_token','string',['limit'=>200,'default'=>null,'null'=>true,'comment'=>'访问token'])
            ->addColumn('created_at','timestamp',['default'=>'CURRENT_TIMESTAMP'])
            ->save();

    }
}
