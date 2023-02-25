<?php

namespace backend\helpers;

class StockType
{
//    const ROLE = 1;
//    const RULE = 2;
    private static $data = [
        0 => 'ทั้งหมด',
        1 => 'เข้า',
        2 => 'ออก'
    ];

    private static $dataobj = [
        ['id'=>0,'name' => 'ทั้งหมด'],
        ['id'=>1,'name' => 'เข้า'],
        ['id'=>2,'name' => 'ออก'],
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
