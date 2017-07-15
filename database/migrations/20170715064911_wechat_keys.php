<?php

use think\migration\Migrator;
use think\migration\db\Column;

class WechatKeys extends Migrator
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
        $table = $this->table('wechat_keys',['collation'=>'utf8mb4_general_ci','comment'=>'微信关键字']);

        $table->addColumn('appid','char',['limit'=>50,'null'=>true,'default'=>null,'comment'=>'公众号appid'])
            ->addColumn('type','string',['limit'=>20,'null'=>true,'default'=>null,'comment'=>'类型，text 文件消息，image 图片消息，news 图文消息'])
            ->addColumn('keys','string',['limit'=>100,'null'=>true,'default'=>null,'comment'=>'关键字'])
            ->addColumn('content','text',['comment'=>'文本类容','null'=>true])
            ->addColumn('image_url','string',['limit'=>255,'null'=>true,'default'=>null,'comment'=>'图片链接'])
            ->addColumn('voice_url','string',['limit'=>255,'null'=>true,'default'=>null,'comment'=>'语音链接'])
            ->addColumn('music_title','string',['limit'=>255,'null'=>true,'default'=>null,'comment'=>'音乐标题'])
            ->addColumn('music_url','string',['limit'=>255,'null'=>true,'default'=>null,'comment'=>'音乐链接'])
            ->addColumn('music_image','string',['limit'=>255,'null'=>true,'default'=>null,'comment'=>'音乐缩略图链接'])
            ->addColumn('music_desc','string',['limit'=>255,'null'=>true,'default'=>null,'comment'=>'音乐描述'])
            ->addColumn('video_title','string',['limit'=>255,'null'=>true,'default'=>null,'comment'=>'视频标题'])
            ->addColumn('video_url','string',['limit'=>255,'null'=>true,'default'=>null,'comment'=>'视频URL'])
            ->addColumn('video_desc','string',['limit'=>255,'null'=>true,'default'=>null,'comment'=>'视频描述'])
            ->addColumn('news_id','string',['limit'=>255,'null'=>true,'default'=>null,'comment'=>'图文ID'])
            ->addColumn('sort','integer',['signed'=>true,'default'=>0,'comment'=>'排序'])
            ->addColumn('status','boolean',['signed'=>true,'default'=>1,'comment'=>'0.禁用，1.启用'])
            ->addColumn('create_by','biginteger',['null'=>true,'default'=>null,'comment'=>'创建人'])
            ->addColumn('created_at','timestamp',['default'=>'CURRENT_TIMESTAMP','update'=>'CURRENT_TIMESTAMP'])
            ->save();
    }
}
