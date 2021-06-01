<?php

namespace App\Helpers;

use ReflectionClass;

abstract class BaseName
{
    public static function getName($val)
    {
        $tmp = new ReflectionClass(get_called_class());
        $a = $tmp->getConstants();
        return $a[$val]['name'];
    }

    public static function getKey($val)
    {
        $tmp = new ReflectionClass(get_called_class());
        $a = $tmp->getConstants();
        return $a[$val]['key'];
    }

}