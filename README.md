# Think Admin 1.0
===============

Think Admin 1.0 基于ThinkPHP5开发，初始的1.0版本没有完全开发成CMS，只是个后台管理系统，附带常用的功能，方便扩展使用。

```
后台演示：http://www.xiyilou.com/index.php/admin （若配置了URL重写可省略index.php）
演示账号：demo demo
```

### Think Admin的运行环境要求PHP5.4以上；
### 为了兼容虚拟主机的使用，index.php入口文件移至根目录；
### 默认管理员账号：admin，默认密码：admin；

## 注意事项：
```
*   数据库表前缀默认为think_开头，`application`目录下的`config.php`配置文件中，`salt`项的值为全站需要加密的地方公用的加密盐值，
*   开发新站点前请注意修改此项，使用`md5('新密码' . config('salt'))`重新生成管理员密码，替换`think_admin_user`中的默认密码
```

详细配置及开发文档参考 [ThinkPHP5完全开发手册](http://www.kancloud.cn/manual/thinkphp5)

## 目录结构

初始的目录结构如下：

```
www  WEB部署目录（或者子目录）
│
├─admin_themes          后台模板目录
├─themes                前台模板目录
│
├─application           应用目录
│  ├─common             公共模块目录
│  │  └─controller      公共模块控制器目录
│  │     ├─AdminBase.php后台公用基础控制器
│  │     └─HomeBase.php 前端公用基础控制器
│  │
│  ├─admin              后台管理模块
│  │  ├─config.php      模块配置文件
│  │  ├─controller      控制器目录
│  │  ├─model           模型目录
│  │  └─validate        验证器目录
│  │
│  ├─api                API模块
│  │  ├─controller      控制器目录
│  │  └─model           模型目录
│  │
│  ├─index              前台模块
│  │  ├─controller      控制器目录
│  │  └─model           模型目录
│  │
│  ├─command.php        命令行工具配置文件
│  ├─common.php         公共函数文件
│  ├─config.php         公共配置文件
│  ├─route.php          路由配置文件（暂未使用路由功能）
│  ├─tags.php           应用行为扩展定义文件
│  └─database.php       数据库配置文件
│
├─public                WEB公共资源目录
│  ├─static             静态资源文件
│  ├─uploads            上传目录
│  ├─router.php         快速测试文件
│  └─.htaccess          用于apache的重写
│
├─thinkphp              框架系统目录
│  ├─lang               语言文件目录
│  ├─library            框架类库目录
│  │  ├─think           Think类库包目录
│  │  └─traits          系统Trait目录
│  │
│  ├─tpl                系统模板目录
│  ├─base.php           基础定义文件
│  ├─console.php        控制台入口文件
│  ├─convention.php     框架惯例配置文件
│  ├─helper.php         助手函数文件
│  ├─phpunit.xml        phpunit配置文件
│  └─start.php          框架入口文件
│
├─extend                扩展类库目录
├─runtime               应用的运行时目录（可写，可定制）
├─vendor                第三方类库目录（Composer依赖库）
├─build.php             自动生成定义文件（参考）
├─composer.json         composer 定义文件
├─LICENSE.txt           授权说明文件
├─README.md             README 文件
├─think                 命令行入口文件
├─index.php             网站入口文件
```


## 数据表和字段
```
*   `think_admin_user`  管理员表
*   `think_article`     文章表
*   `think_auth_group`  权限组表
*   `think_auth_group_access`  权限组规则表
*   `think_auth_rule`   规则表
*   `think_category`    分类表
*   `think_nav`         导航表
*   `think_system`      系统配置表
```