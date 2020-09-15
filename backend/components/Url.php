<?php
/**
 * Created by PhpStorm.
 * User: Ergashev Khurshid
 * Date: 15.09.2020
 * Time: 10:36
 */

namespace backend\components;


class Url extends \yii\helpers\Url
{
    public static function hasActive($needles=[], $offset=0) {
        $haystack = self::current();
        $chr = array();
        foreach($needles as $needle) {
            $res = strpos($haystack, $needle, $offset);
            if ($res !== false) $chr[$needle] = $res;
        }
        if(empty($chr)) return false;
        return min($chr);
    }
}