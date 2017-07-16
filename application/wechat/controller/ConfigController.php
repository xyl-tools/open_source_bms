<?php
/**
 * Created by PhpStorm.
 * User: wuang
 * Date: 2017/7/15
 * Time: 17:39
 */

namespace app\wechat\controller;


use app\common\controller\AdminBaseController;
use app\common\model\System;
use think\db\Query;

class ConfigController extends AdminBaseController
{

    public function index()
    {

        $model = new System();
        $config = $model->where('name','=','wechat_config')->find();
        if(empty($config)){
            $model->name = 'wechat_config';
            $model->value = [
                'url' => '',
                'appid' => '',
                'appsecret' => '',
                'token' => '',
                'encodingaeskey' => '',
            ];
            if($model->save()){
                $config = $model;
            }
        }

        if($this->request->isAjax()){
            $data = $this->request->post();
            $result = $this->validate($data,'WechatConfig');
            if(true !== $result){
                $this->error($result);
            }
            $config->value = $data;
            if($config->save()){
                $this->success('保存成功');
            }

        }

        $this->assign('config',$config);
        return $this->fetch();
    }

    public function pay()
    {

        return $this->fetch();
    }
}