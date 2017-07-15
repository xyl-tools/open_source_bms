<?php

use think\migration\Migrator;
use think\migration\db\Column;

class WechatFansTags extends Migrator
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

        $table = $this->table('wechat_fans_tags',['id'=>false,'primary_key'=>['id'],'comment'=>'微信会员标签']);
        $table->addColumn('id','biginteger',['identity'=>true,'signed'=>true])
            ->addColumn('appid','char',['limit'=>50,'null'=>true,'default'=>null,'comment'=>'公众号APPID'])
            ->addColumn('name', 'string',['limit'=>35,'null'=>true,'default'=>null,'comment'=>'标签名称'])
            ->addColumn('count','integer',['signed'=>true,'null'=>true,'default'=>null,'comment'=>'总数'])
            ->addColumn('created_at','timestamp',['default'=>'CURRENT_TIMESTAMP'])
            ->addIndex('appid')
            ->save();

    }
}
