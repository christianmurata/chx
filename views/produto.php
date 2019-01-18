<?php

use Services\Produtos;

function _get($args){
    // verifica se o usuário está logado
    if(!$_SESSION['usuario'])
        header('location: /');

    $template = template('produto');
    print $template;
    
}

function _post($args){
    print_r($args);
}