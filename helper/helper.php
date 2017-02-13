<?php


function validate($arr)
{
    $flag = !empty($arr);
    foreach ($arr as $key => $value) {
        if(empty($value))
        {
            if($key != "photo") $flag = false;
        }
    }
    return $flag;
}