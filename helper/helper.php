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

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}