<?php

use Utils\Erro;
use Utils\Utils;
use Services\Usuarios;
use Services\Categorias;

function _get($param){
    Erro::_404();
}

function _post($param){
    // se a requisição não estiver mapeada
    global $requests;

    if(!isset($requests[$param['data']]))
        Erro::_404();
    
    // OK, a requesição pode ser feita
    if($param['data'] == "categoria"){
        $categoria = new Categorias;
        print_r(json_encode($categoria->listar()));
    }

    if($param['data'] == "produto")
        print_r("request para produto");
}