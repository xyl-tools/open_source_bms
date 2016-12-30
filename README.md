## Think Admin是什么?
一个节省开发时间的后台管理系统，程序基于ThinkPHP 5开发，后台UI使用LayUI搭建

## 2016.12.29更新：

* 核心框架同步更新为官方5.0.4
* 后台UI同步更新为官方1.0.7
* 调整`model`模型目录至`common`公共目录
* 统一上传接口为`api`模块下`Upload`控制器
* 分类表增加path字段，优化子分类查询
* 增加单独密码修改功能，防止低权管理员随意修改自己权限组
* 更换后台富文本编辑器为KindEditor
* 恢复入口文件至public目录，减少整体结构调整
* 修复一些BUG

其它更新请自行查看

## 安装使用：
* 此版本结构变动较大，不建议1.0.5版本用户直接更新升级
* 使用本程序，默认用户已经掌握composer技能，Github更新默认不上传`vendor`目录，第三方类库`vendor`目录内程序需要用户自行使用composer安装
* 如需下载完整版，可以在`releases`中选择`think_admin_full`版本下载，
* 程序下载完成后，在程序目录内执行`composer update`命令进行`vendor`引用类库安装
* 数据库文件为`think_admin.sql`
* 下载程序至本地，建议搭建虚拟域名站点进行测试，防止出现路径错误的问题
* 站点开发前，请先修改`application`目录下的`config`配置文件，找到`salt`项，此项为全站加密公用盐值，请先修改，然后使用`md5('新密码' . config('salt'))`生成新密码，替换`admin_user`表中的默认管理员密码

## 版权信息

Think Admin遵循Apache2开源协议发布，并提供免费使用。

版权所有Copyright © 2016 by Think Admin All rights reserved。