<?php

namespace Utils;

class Erro{
    public static function msgErro($cod, $msg){
        print_r(['erro' => $cod, 'msg' => $msg]);

        exit;
    }

    public static function _404(){
        http_response_code(404);

        exit;
    }

    public static function _500(){
        http_response_code(500);

        exit;
    }
}