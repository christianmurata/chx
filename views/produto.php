<?php

use Utils\Erro;
use Services\Produtos;

function _get($args){
    // verifica se o usuário está logado
    if(!$_SESSION['usuario'])
        header('location: /');

    $template = template('produto');
    print $template;
    
}

function _post($args){
    // verifica se não foi passado nenhum valor vazio
    foreach ($args as $key => $value){
        if(empty($value))
            Erro::msgErro(24, "Preencha o campo $key!");
    }

    // adiciona o id do usuario logado e a imagem
    $args['usuario'] = $_SESSION['id'];
    $args['imagem']  = $_FILES['imagem'];

    $produto = new Produtos;
    
    if(!$produto->cadastrar($args))
        Erro::msgErro(25, "Erro ao cadastrar o produto");

    print("Ok");
}