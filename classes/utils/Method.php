<?php

namespace Utils;

class Method{
    public function __construct($params){
        switch($_SERVER['REQUEST_METHOD']){
            case 'POST':
                _post($params);
                break;
            case 'GET':
                _get($params);
                break;
            default:
                return "Requisição não identificada";
        }
    }
}