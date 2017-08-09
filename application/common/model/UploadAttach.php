<?php

namespace app\common\model;

use think\Exception;
use think\exception\ClassNotFoundException;
use think\File;
use think\Model;
use think\Request;

/**
 * This is the model class for table "os_upload_attach".
 *
 * @property string $id
 * @property string $original
 * @property string $file_name
 * @property string $hash
 * @property string $url
 * @property string $path
 * @property integer $size
 * @property string $created_at
 */
class UploadAttach extends Model
{
    /**
     * @param File $file
     * @param string $uploadPath
     * @param string $savePath
     */
    public function upload($file,$uploadPath,$savePath){
        $md5 = static::hash($file->getPath().DS.$file->getFilename());
        /**
         * @var UploadAttach $fileData
         */
        $fileData = $this->where(['hash'=>$md5])->find();
        if(empty($fileData)){
            $info = $file->move($uploadPath);
            if(!$info){
                $this->error = $file->getError();
                return false;
            }
            $fileData = new UploadAttach();
            $fileData->original = $info->getInfo('name');
            $fileData->file_name = $info->getFilename();
            $fileData->file_type = $info->getMime();
            $fileData->hash = $md5;
            $fileData->url = str_replace('\\', '/', $savePath . $info->getSaveName());
            $fileData->path = $info->getPath();
            $fileData->size = $info->getSize();
            if(!$fileData->save()){
                $this->error = $fileData->getError();
                return false;
            }
        }else{

                if(!file_exists($fileData->path.DS.$fileData->file_name)){
                $file->move($fileData->path,$fileData->file_name);
            }
        }
        return $fileData;
    }

    public static function hash($filePath)
    {
        return md5(md5_file($filePath).filesize($filePath));

    }

}
