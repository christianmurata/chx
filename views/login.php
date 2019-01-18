<?php

use Utils\Erro;
use Utils\Utils;
use Services\Usuarios;

function _get($args){
    // verifica se o usuário está logado
    if($_SESSION['usuario'])
        header('location: /dashbord');

    $template = template('login');
    print $template;
}

function _post($args){
    $dados = $_POST;

    // verifica se não foi passado nenhum valor vazio
    foreach ($dados as $key => $value){
        if(empty($value))
            Erro::msgErro(1000, "Preencha o campo $key!");
    }

    // o login pode ser efetuado com email ou usuário
    $dados['nome'] = '';
    $dados['usuario'] = $dados['email'];

    $usuario = new Usuarios($dados);

    if(!$usuario->login()){
        $template = template('login');
        print $template;

        return;
    }

    // login efetuado com sucesso!
    header('location: /dashbord');

}