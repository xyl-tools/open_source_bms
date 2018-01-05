## Open Source BMS是什么?
全称Open Source Background Manager System，开源后台管理系统
一个节省开发时间的后台管理系统，程序基于ThinkPHP 5开发，后台UI使用LayUI搭建

### 官网地址：http://opensourcebms.com

## 安装使用：
* 方式一：git克隆下载，请执行`composer install`命令进行完整安装
* 方式二：非git用户请下载完整版，完整版无须执行`composer install`命令
* 数据库文件为`open_source_bms.sql`
* 下载程序至本地，请搭建虚拟域名，并开启URL重写（必须）
* 站点开发前，建议修改`application`目录下的`config`配置文件，找到`salt`项，此项为全站加密公用盐值，请先修改，然后使用`md5('新密码' . config('salt'))`生成新密码，替换`admin_user`表中的默认管理员密码
* 默认后台账号 `admin`，密码`admin`

## 2017.4.19更新（v1.1.1)：

* 核心框架同步更新为官方5.0.7
* 后台UI同步更新为官方1.0.9_rls
* 更换后台富文本编辑器为Ueditor 1.4.3.3
* 调整后台模板目录至themes目录下
* 入口文件移至根目录
* 重命名项目名为Open Source BMS
* 增加composer.lock文件
* 此版本功能方向无大变动，目的为修复BUG，下一版本会进行功能方向调整
* 修复一些BUG

## 2016.12.29更新（v1.1）：

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

## 版权信息

Open Source BMS遵循Apache2开源协议发布，并提供免费使用。

版权所有Copyright © 2016-2017 by Open Source BMS All rights reserved。
