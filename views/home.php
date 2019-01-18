<?php

use Services\Produtos;
use Services\Categorias;

function _get($args){
    $template = template('home', array(
        'erro.home' => 'este é um teste legal'
    ));
    
    print $template;
}

function _post($args){
    echo "post - rota home";
}