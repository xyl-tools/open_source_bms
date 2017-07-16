<?php
/**
 * Created by PhpStorm.
 * User: wuang
 * Date: 2017/7/16
 * Time: 15:30
 */
namespace app\wechat\validate;

use think\Validate;

class WechatConfig extends Validate
{

    protected $rule = [
        'appid|公众号appid' => ['require','regex'=>'/^wx[0-9a-z]{16}$/'],
        'appsecret|AppSecret(应用密钥)' => 'require|length:32|alphaDash',
        'token|Token(令牌)' => 'require',
    ];

    protected $message = [
        'appid.regex' => '请输入以wx开头的18位公众号APPID'
    ];
}