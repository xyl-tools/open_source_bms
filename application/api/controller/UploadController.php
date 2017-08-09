<?php
namespace app\api\controller;

use app\common\model\UploadImages;
use think\Controller;
use think\Session;

/**
 * 通用上传接口
 * Class Upload
 * @package app\api\controller
 */
class UploadController extends Controller
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


        $result = [
            'error'   => 1,
            'message' => '',
        ];
        if(!$file->validate($config)->check()){
            $result['message'] = $file->getError();
        }else{
            $upload = new UploadImages();
            $info = $upload->upload($file,$upload_path,$save_path);
            if(empty($info)){
                $result['message'] = $upload->getError();
            }else{
                $result['error'] = 0;
                $result['message'] = '上传成功';
                $result['url'] = $info->url;
            }
        }
        return json($result);
    }

    public function index()
    {
        $upload = new UploadImages();
        $upload->name = 'xxxxxx';
        die;
    }
}