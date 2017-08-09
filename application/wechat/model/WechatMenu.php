<?php

namespace app\wechat\model;

use think\Model;

/**
 * This is the model class for table "wechat_menu".
 *
 * @property string $id
 * @property string $index
 * @property string $pindex
 * @property string $type
 * @property string $name
 * @property string $content
 * @property string $sort
 * @property integer $status
 * @property string $create_by
 * @property string $created_at
 */
class WechatMenu extends Model
{

    const TYPE_VIEW = 'view';
    const TYPE_CLICK = 'click';
    const TYPE_SCANCODE_PUSH = 'scancode_push';
    const TYPE_SCANCODE_WAIT_MSG = 'scancode_waitmsg';
    const TYPE_PIC_SYSPHOTO = 'pic_sysphoto';
    const TYPE_PIC_WEIXIN = 'pic_weixin';
    const TYPE_LOCATION_SELECT = 'location_select';
    const TYPE_PIC_PHOTO_OR_ALBUM = 'pic_photo_or_album';


    public function getTypeTxtAttr($val)
    {
        switch ($val){
            case self::TYPE_VIEW:
                return '跳转URL';
            case self::TYPE_CLICK:
                return '点击推事件';
            case self::TYPE_SCANCODE_PUSH:
                return '扫码推事件';
            case self::TYPE_SCANCODE_WAIT_MSG:
                return '扫码推事件且弹出“消息接收中”提示框';
            case self::TYPE_PIC_SYSPHOTO:
                return '弹出系统拍照发图';
            case self::TYPE_PIC_WEIXIN:
                return '弹出微信相册发图器';
            case self::TYPE_LOCATION_SELECT:
                return '弹出地理位置选择器';
            case self::TYPE_PIC_PHOTO_OR_ALBUM:
                return '弹出拍照或者相册发图';
            default:
                return '未知';
        }

    }
}
