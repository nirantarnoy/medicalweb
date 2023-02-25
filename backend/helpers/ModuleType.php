<?php

namespace backend\helpers;

class ModuleType
{
//    const ROLE = 1;
//    const RULE = 2;
    private static $data = [
        0 => 'ทั้งหมด',
        1 => 'รับเข้าคลัง',
        2 => 'เบิกจากคลัง'
    ];

    private static $dataobj = [
        ['id'=>0,'name' => 'ทั้งหมด'],
        ['id'=>1,'name' => 'รับเข้าคลัง'],
        ['id'=>2,'name' => 'เบิกจากคลัง'],
    ];
    public static function asArray()
    {
        return self::$data;
    }
    public static function asArrayObject()
    {
        return self::$dataobj;
    }
    public static function getTypeById($idx)
    {
        if (isset(self::$data[$idx])) {
            return self::$data[$idx];
        }

        return 'Unknown Type';
    }
    public static function getTypeByName($idx)
    {
        if (isset(self::$data[$idx])) {
            return self::$data[$idx];
        }

        return 'Unknown Type';
    }
}
