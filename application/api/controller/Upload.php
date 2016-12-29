<?php
namespace app\api\controller;

use think\Controller;
use think\Session;

/**
 * 通用上传接口
 * Class Upload
 * @package app\api\controller
 */
class Upload extends Controller
{
    protected function _initialize()
    {
        parent::_initialize();
        if (!Session::has('admin_id')) {
            $result = [
                'error'   => 1,
                'message' => '未登录'
            ];

            return json($result);
        }
    }

    /**
     * 通用图片上传接口
     * @return \think\response\Json
     */
    public function upload()
    {
        $config = [
            'size' => 2097152,
            'ext'  => 'jpg,gif,png,bmp'
        ];

        $file = $this->request->file('file');

        $upload_path = str_replace('\\', '/', ROOT_PATH . 'public/uploads');
        $save_path   = '/uploads/';
        $info        = $file->validate($config)->move($upload_path);

        if ($info) {
            $result = [
                'error' => 0,
                'url'   => str_replace('\\', '/', $save_path . $info->getSaveName())
            ];
        } else {
            $result = [
                'error'   => 1,
                'message' => $file->getError()
            ];
        }

        return json($result);
    }
}