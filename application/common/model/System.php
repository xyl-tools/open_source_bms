<?php

namespace app\common\model;

use think\Model;

/**
 * This is the model class for table "os_system".
 *
 * @property string $id
 * @property string $name
 * @property string $value
 */
class System extends Model
{

    public function getValueAttr($value)
    {
        if (is_string($value)) {
            return unserialize($value);
        }
        return $value;
    }

    public function setValueAttr($val)
    {
        if (is_string($val)) {
            return $val;
        }
        return serialize($val);
    }
}
