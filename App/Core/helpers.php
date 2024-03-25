<?php

class helpers{
    public static function checkMethod($method){
        if ($_SERVER['REQUEST_METHOD'] == $method){
            return true;
        }
        return false;
    }

    public static function clearInput($input)
    {
        return trim(htmlspecialchars(htmlentities($input)));
    }

    public static function redirect(...$param){
        if (count($param) == 1){
            header("location: $param[0]");
        }elseif (count($param) == 2){
            header("Refresh: $param[1] URL= $param[0]");
        }else{
            echo "<center><h1>Method Not Found</h1></center>";
        }
    }

    public static function handleImage($image, $new_name, $uploaded_file_path){
        $type = $image['type'];
        $ext = explode("/", $type);
        $ext = end($ext);
        $tmp = $image['tmp_name'];
        $file_name = "$new_name.$ext";
        $img_path = "$uploaded_file_path"."$file_name";
        move_uploaded_file($tmp, "../../$img_path");
        return "$img_path";
    }
}


//public static function varOfVar($vars){
//    foreach ($vars as $key => $value){
//        $$key = $value;
//    }
//}