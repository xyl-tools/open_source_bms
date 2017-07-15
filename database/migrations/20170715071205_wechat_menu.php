<?php

use think\migration\Migrator;
use think\migration\db\Column;

class WechatMenu extends Migrator
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
        $table = $this->table('wechat_menu',['collation'=>'utf8mb4_general_ci','comment'=>'微信菜单']);
        $table->addColumn('index','integer',['null'=>true,'default'=>null])
            ->addColumn('pindex','integer',['signed'=>true,'default'=>0,'comment'=>'父ID'])
            ->addColumn('type','string',['limit'=>24,'default'=>'','comment'=>'菜单类型 null主菜单 link链接 keys关键字'])
            ->addColumn('name','string',['limit'=>255,'default'=>'','comment'=>"菜单名称"])
            ->addColumn('content','text',['comment'=>'文字内容'])
            ->addColumn('sort','integer',['signed'=>true,'comment'=>'排序'])
            ->addColumn('status','boolean',['signed'=>true,'default'=>1,'comment'=>'状态(0禁用1启用)'])
            ->addColumn('create_by','biginteger',['signed'=>true,'default'=>'0','comment'=>'创建人'])
            ->addColumn('created_at','timestamp',['default'=>'CURRENT_TIMESTAMP'])
            ->addIndex(['pindex'])
            ->save();

        $table->insert([
            ['index'=>'1','pindex'=>'0','type'=>'text','name'=>'关键字','content'=>'test'],
            ['index'=>'11','pindex'=>'1','type'=>'keys','name'=>'图片','content'=>'图片'],
            ['index'=>'12','pindex'=>'1','type'=>'miniprogram','name'=>'小程序','content'=>'4123412341231,34123,412341'],
            ['index'=>'2','pindex'=>'0','type'=>'event','name'=>'事件类','content'=>'pic_weixin'],
            ['index'=>'3','pindex'=>'0','type'=>'view','name'=>'打开百度','content'=>'http://www.baidu.com'],
        ])->saveData();

    }
}
