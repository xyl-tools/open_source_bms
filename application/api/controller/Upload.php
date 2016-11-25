<?php
namespace app\api\controller;

use app\common\controller\AdminBase;
use think\Controller;

class Upload extends AdminBase {
    protected function _initialize() {
        parent::_initialize();
    }

    public function upload() {
        $file = $this->request->file('file');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');

        if ($info) {
            $result = [
                'code' => 0,
                'msg'  => '上传成功',
                'data' => [
                    'src'   => '/public/uploads/' . str_replace('\\', '/', $info->getSaveName()),
                    'title' => ''
                ]
            ];
        } else {
            $result = [
                'code' => -1,
                'msg'  => $file->getError()
            ];
        }

        return json($result);
    }

    /**
     * 上传缩略图
     * @return \think\response\Json
     */
    public function uploadThumb() {
        $file = $this->request->file('file');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');

        if ($info) {
            $result = [
                'code'     => 0,
                'msg'      => '上传成功',
                'filename' => '/public/uploads/' . str_replace('\\', '/', $info->getSaveName())
            ];
        } else {
            $result = [
                'code' => -1,
                'msg'  => $file->getError()
            ];
        }

        return json($result);
    }

    /**
     * 上传图集
     * @return \think\response\Json
     */
    public function uploadPhoto() {
        $files  = request()->file('photo');
        $result = [];
        foreach ($files as $file) {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if ($info) {
                $result[] = [
                    'code' => 0,
                    'msg'  => '上传成功',
                    'data' => [
                        'filename' => '/public/uploads/' . str_replace('\\', '/', $info->getSaveName()),
                        'title'    => ''
                    ]
                ];
            } else {
                $result[] = [
                    'code' => -1,
                    'msg'  => $file->getError()
                ];
            }
        }

        return json($result);
    }
}