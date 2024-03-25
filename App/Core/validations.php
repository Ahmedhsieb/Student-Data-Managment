<?php

class validations{
    public static function emptyAndRequired($input){
        if (empty($input)){
            return true;
        }
        return false;
    }

    public static function maxVal($input, $max){
        if (strlen($input) > $max){
            return true;
        }
        return false;
    }

    public static function minVal($input, $min){
        if (strlen($input) < $min){
            return true;
        }
        return false;
    }

    public static function checkInput($input, $max, $min, $value){
        if (self::emptyAndRequired($input)){
            return "$value مطلوب  ";
        }elseif (self::maxVal($input, $max)){
            return "$value يجب ان يكون اقل من $max حرف";
        }elseif (self::minVal($input, $min)){
            $min = $min-1;
            return " $value يجب ان يكون اكبر من $min حرف";
        }
    }

    public static function checkEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function checkWebsite($website){
        return filter_var($website, FILTER_VALIDATE_URL);
    }
}


