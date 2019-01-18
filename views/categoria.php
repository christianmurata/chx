<?php

use Utils\Utils;
use Services\Categorias;

function _get($args){
    // verifica se o usuário está logado
    if(!$_SESSION['usuario'])
        header('location: /');

    // cadastar categoria
    $template = template('categoria');
    print $template;
}

function _post($args){
    $dados = $_POST;

    // verifica se não foi passado nenhum valor vazio
    foreach ($dados as $key => $value){
        if(empty($value))
            Erro::msgErro(1000, "Preencha o campo $key!");
    }

    // cria o slug e adiciona ao array
    // $dados['slug'] = Utils::slugify($dados['titulo']);
    
    $categoria = new Categorias;

    if(!$categoria->cadastrar($dados)){
        $template = template('erro');
        print $template;

        return;
    }

    // sucesso! Redireciono para a tela inicial
    header('location: /login');

}