<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Init extends Migrator
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


    public function up()
    {
        $sql = file_get_contents('./open_source_bms.sql');
        $this->execute($sql);

        $tableNames = [
            'os_admin_user' => 'admin_user',
            'os_article' => 'article',
            'os_auth_group' => 'auth_group',
            'os_auth_group_access' => 'auth_group_access',
            'os_auth_rule' => 'auth_rule',
            'os_category' => 'category',
            'os_link' => 'link',
            'os_nav' => 'nav',
            'os_slide' => 'slide',
            'os_slide_category' => 'slide_category',
            'os_system' => 'system',
            'os_user' => 'user',
        ];
        foreach ($tableNames as $key => $name){
            $table = $this->table($key);
            if($table->exists()){
                $table->rename($name);
            }
        }
    }
    public function down()
    {
    }

}
