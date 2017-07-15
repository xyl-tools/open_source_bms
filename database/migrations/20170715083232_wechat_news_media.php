<?php

use think\migration\Migrator;
use think\migration\db\Column;

class WechatNewsMedia extends Migrator
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
        $table = $this->table('wechat_news_media',['comment'=>'微信素材表']);
        $table->addColumn('appid','char',['limit'=>50,'null'=>true,'default'=>'公众号ID'])
            ->addColumn('md5','string',['limit'=>32,'null'=>true,'default'=>null,'comment'=>'文件md5'])
            ->addColumn('type','string',['limit'=>20,'null'=>true,'default'=>null,'comment'=>'媒体类型'])
            ->addColumn('media_id','string',['limit'=>100,'null'=>true,'default'=>null,'comment'=>'永久素材MediaID'])
            ->addColumn('local_url','string',['limit'=>300,'null'=>true,'default'=>null,'comment'=>'本地文件链接'])
            ->addColumn('media_url','string',['limit'=>300,'null'=>true,'default'=>null,'comment'=>'远程图片链接'])
            ->addColumn('created_at','string',['comment'=>'创建时间'])
            ->save();
    }
}
