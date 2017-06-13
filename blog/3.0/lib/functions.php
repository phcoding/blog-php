<?php
/**
 * Created by PhpStorm.
 * User: ph
 * Date: 2016/5/23
 * Time: 0:14
 */

/**限制数值取值
 * @param int $value
 * @param int $lower
 * @param int $upper
 * @param int $ld
 * @param int $ud
 * @return int
 */
function limit($value=0,$lower=0,$upper=PHP_INT_MAX){
    if($value<$lower){
        return $lower;
    }else if($value>$upper){
        return $upper;
    }else {
        return $value;
    }
}

function array_clip($input=[],$keys=[]){
    $result = [];
    foreach ($keys as $key) {
        if(in_array($key,array_keys($input))){
            $result[$key] = $input[$key];
        }else{
            $result[$key] = null;
        }
    }
    return $result;
}