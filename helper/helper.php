<?php


function validate($arr)
{
    $flag = !empty($arr);
    foreach ($arr as $key => $value) {
        if(empty($value)) $flag = false;
    }
    return $flag;
}