<?php

namespace Utils;

Class Utils {
    public static function verificaObj($obj, $objKeys){
        if(count($obj) != count($objKeys))
            return false;

        foreach($objKeys as $key => $value){
            if(!isset($obj[$key]))
                return false;
        }
        
        return true;
    }

    public static function verificaEmail($email){
        $dominio = explode('@',$email);

        //verifica se e-mail esta no formato correto de escrita
        if (preg_match('^([a-zA-Z0-9.-_])*([@])([a-z0-9]).([a-z]{2,3})',$email))
            return false;

        //Valida o dominio
        if(!checkdnsrr($dominio[1], 'MX'))
            return false;

        return true;            
    }

    public static function arrayKeyValue($array){
        $arr = array();

        foreach($array as $value){
            $arr[] = $value;
        }

        return $arr;
    }

    public static function slugify($text){
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public static function arrayPatternKey($pattern, $children){
        foreach($pattern as $key => $value){
            $pattern[$key] = $children[$key];
        }

        return $pattern;
    }
}