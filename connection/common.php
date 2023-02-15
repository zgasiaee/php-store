<?php

function sanitize($value){
    $level_1=trim($value);
    $level_2=strip_tags($level_1);
    return $level_2;
}

function hashData($value,$type){
    switch ($type){
        case "crc32":
            return crc32($value);
        case "md5":
            return md5($value);
        case "sha1":
            return sha1($value);
    }
    return $value;
}

function browser($user){

    if(strpos($user,"Edg/")){
        return "edge";
    }
    else if(strpos($user,"Opera") || strpos($user,"OPR/")){
        return "opera";
    }
    else if(strpos($user,"Chrome") ){
        return "chrome";
    }
    else if(strpos($user,"Safari") ){
        return "safari";
    }
    else if(strpos($user,"Firefox") ){
        return "firefox";
    }
    else if(strpos($user,"MSIE") || strpos($user,"Trident/7") ){
        return "microsoft";
    }


}
