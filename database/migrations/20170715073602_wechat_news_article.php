<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class WechatNewsArticle extends Migrator
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

        $table = $this->table('wechat_news_article',['comment'=>'微信文章']);
        $table->addColumn('title','string',['limit'=>255,'null'=>true,'default'=>null,'comment'=>'素材标题'])
            ->addColumn('local_url','string',['limit'=>300,'null'=>true,'default'=>null,'comment'=>'永久素材显示URL'])
            ->addColumn('show_cover_pic','boolean',['signed'=>true,'default'=>'0','comment'=>'是否显示封面 0不显示，1 显示'])
            ->addColumn('author','string',['limit'=>20,'null'=>true,'default'=>null,'comment'=>'作者'])
            ->addColumn('digest','string',['limit'=>300,'null'=>true,'default'=>null,'comment'=>'摘要内容'])
            ->addColumn('content','text',['limit'=>MysqlAdapter::TEXT_LONG,'comment'=>'图文内容'])
            ->addColumn('content_source_url','string',['limit'=>200,'null'=>true,'default'=>null,'comment'=>'图文原文地址'])
            ->addColumn('created_at','timestamp',['comment'=>'创建时间'])
            ->addColumn('create_by','biginteger',['null'=>true,'default'=>null,'comment'=>'创建人'])
            ->save();
    }
}
