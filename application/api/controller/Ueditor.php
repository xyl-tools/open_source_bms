<?php
namespace app\api\controller;

use think\Controller;
use org\UeditorUpload;
use think\Session;

/**
 * Ueditor编辑器统一上传接口
 * Class Ueditor
 * @package app\api\controller
 */
class Ueditor extends Controller
{
    protected $config;
    protected $action;

    protected function _initialize()
    {
        parent::_initialize();

        if(!Session::get('admin_id')){
            $result = [
                'state' => 'ERROR'
            ];

            return json($result);
        }

        $this->config = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents(ROOT_PATH . 'public/static/js/ueditor/config.json')), true);
        $this->action = $this->request->get('action');
    }

    /**
     * Ueditor编辑器统一上传接口
     * @return string|\think\response\Json
     */
    public function index()
    {
        switch ($this->action) {
            case 'config':
                $result = $this->config;
                break;

            /* 上传图片 */
            case 'uploadimage':
                /* 上传涂鸦 */
            case 'uploadscrawl':
                /* 上传视频 */
            case 'uploadvideo':
                /* 上传文件 */
            case 'uploadfile':
                $result = $this->upload();
                break;

            /* 列出图片 */
            case 'listimage':
                $result = $this->getList();
                break;
            /* 列出文件 */
            case 'listfile':
                $result = $this->getList();
                break;

            /* 抓取远程文件 */
            case 'catchimage':
                $result = $this->crawler();
                break;

            default:
                $result = [
                    'state' => '请求地址出错'
                ];
                break;
        }

        /* 输出结果 */
        if (isset($_GET["callback"])) {
            if (preg_match("/^[\w_]+$/", $_GET["callback"])) {
                return htmlspecialchars($_GET["callback"]) . '(' . $result . ')';
            } else {
                return json([
                    'state' => 'callback参数不合法'
                ]);
            }
        } else {
            return json($result);
        }
    }

    /**
     * 上传附件和上传视频
     * @return array
     */
    private function upload()
    {
        /* 上传配置 */
        $base64 = "upload";
        switch ($this->action) {
            case 'uploadimage':
                $param     = [
                    "pathFormat" => $this->config['imagePathFormat'],
                    "maxSize"    => $this->config['imageMaxSize'],
                    "allowFiles" => $this->config['imageAllowFiles']
                ];
                $fieldName = $this->config['imageFieldName'];
                break;
            case 'uploadscrawl':
                $param     = [
                    "pathFormat" => $this->config['scrawlPathFormat'],
                    "maxSize"    => $this->config['scrawlMaxSize'],
                    "oriName"    => "scrawl.png"
                ];
                $fieldName = $this->config['scrawlFieldName'];
                $base64    = "base64";
                break;
            case 'uploadvideo':
                $param     = [
                    "pathFormat" => $this->config['videoPathFormat'],
                    "maxSize"    => $this->config['videoMaxSize'],
                    "allowFiles" => $this->config['videoAllowFiles']
                ];
                $fieldName = $this->config['videoFieldName'];
                break;
            case 'uploadfile':
            default:
                $param     = [
                    "pathFormat" => $this->config['filePathFormat'],
                    "maxSize"    => $this->config['fileMaxSize'],
                    "allowFiles" => $this->config['fileAllowFiles']
                ];
                $fieldName = $this->config['fileFieldName'];
                break;
        }

        /* 生成上传实例对象并完成上传 */
        $up = new UeditorUpload($fieldName, $param, $base64);

        /**
         * 得到上传文件所对应的各个参数,数组结构
         * array(
         *     "state" => "",          //上传状态，上传成功时必须返回"SUCCESS"
         *     "url" => "",            //返回的地址
         *     "title" => "",          //新文件名
         *     "original" => "",       //原始文件名
         *     "type" => ""            //文件类型
         *     "size" => "",           //文件大小
         * )
         */

        /* 返回数据 */

        return $up->getFileInfo();
    }

    /**
     * 获取已上传的文件列表
     * @return array
     */
    private function getList()
    {
        /* 判断类型 */
        switch ($this->action) {
            /* 列出文件 */
            case 'listfile':
                $allowFiles = $this->config['fileManagerAllowFiles'];
                $listSize   = $this->config['fileManagerListSize'];
                $path       = $this->config['fileManagerListPath'];
                break;
            /* 列出图片 */
            case 'listimage':
            default:
                $allowFiles = $this->config['imageManagerAllowFiles'];
                $listSize   = $this->config['imageManagerListSize'];
                $path       = $this->config['imageManagerListPath'];
        }
        $allowFiles = substr(str_replace(".", "|", join("", $allowFiles)), 1);

        /* 获取参数 */
        $size  = isset($_GET['size']) ? htmlspecialchars($_GET['size']) : $listSize;
        $start = isset($_GET['start']) ? htmlspecialchars($_GET['start']) : 0;
        $end   = $start + $size;

        /* 获取文件列表 */
        $path  = $_SERVER['DOCUMENT_ROOT'] . (substr($path, 0, 1) == "/" ? "" : "/") . $path;
        $files = $this->getFiles($path, $allowFiles);
        if (!count($files)) {
            return [
                "state" => "no match file",
                "list"  => [],
                "start" => $start,
                "total" => count($files)
            ];
        }

        /* 获取指定范围的列表 */
        $len = count($files);
        for ($i = min($end, $len) - 1, $list = []; $i < $len && $i >= 0 && $i >= $start; $i--) {
            $list[] = $files[$i];
        }

        //倒序
        //for ($i = $end, $list = array(); $i < $len && $i < $end; $i++){
        //    $list[] = $files[$i];
        //}

        /* 返回数据 */
        $result = [
            "state" => "SUCCESS",
            "list"  => $list,
            "start" => $start,
            "total" => count($files)
        ];

        return $result;
    }

    /**
     * 抓取远程图片
     * @return array
     */
    private function crawler()
    {
        /* 上传配置 */
        $config    = [
            "pathFormat" => $this->config['catcherPathFormat'],
            "maxSize"    => $this->config['catcherMaxSize'],
            "allowFiles" => $this->config['catcherAllowFiles'],
            "oriName"    => "remote.png"
        ];
        $fieldName = $this->config['catcherFieldName'];

        /* 抓取远程图片 */
        $list = [];
        if (isset($_POST[$fieldName])) {
            $source = $_POST[$fieldName];
        } else {
            $source = $_GET[$fieldName];
        }
        foreach ($source as $imgUrl) {
            $item = new UeditorUpload($imgUrl, $config, "remote");
            $info = $item->getFileInfo();
            array_push($list, [
                "state"    => $info["state"],
                "url"      => $info["url"],
                "size"     => $info["size"],
                "title"    => htmlspecialchars($info["title"]),
                "original" => htmlspecialchars($info["original"]),
                "source"   => htmlspecialchars($imgUrl)
            ]);
        }

        /* 返回抓取数据 */

        return [
            'state' => count($list) ? 'SUCCESS' : 'ERROR',
            'list'  => $list
        ];
    }

    /**
     * 遍历获取目录下的指定类型的文件
     * @param string $path
     * @param string $allowFiles
     * @param array  $files
     * @return array|null
     */
    private function getFiles($path, $allowFiles, &$files = [])
    {
        if (!is_dir($path)) return null;
        if (substr($path, strlen($path) - 1) != '/') $path .= '/';
        $handle = opendir($path);
        while (false !== ($file = readdir($handle))) {
            if ($file != '.' && $file != '..') {
                $path2 = $path . $file;
                if (is_dir($path2)) {
                    $this->getFiles($path2, $allowFiles, $files);
                } else {
                    if (preg_match("/\.(" . $allowFiles . ")$/i", $file)) {
                        $files[] = [
                            'url'   => substr($path2, strlen($_SERVER['DOCUMENT_ROOT'])),
                            'mtime' => filemtime($path2)
                        ];
                    }
                }
            }
        }

        return $files;
    }
}