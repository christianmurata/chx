<?php

use Services\Produtos;
use Services\Categorias;

function _get($args){
    $produto  = new Produtos;
    $produtos = $produto->listar();

    $template = template('home', array(
        'home.produtos' => $produtos,
    ));
    
    print $template;
}

function _post($args){
    echo "post - rota home";
}