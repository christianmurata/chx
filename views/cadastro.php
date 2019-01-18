<?php

use Utils\Erro;
use Utils\Utils;
use Services\Usuarios;

function _get($args){
    // verifica se o usuário está logado
    if($_SESSION['usuario'])
        header('location: /dashbord');

    $template = template('cadastro');
    print $template;
}

function _post($args){
    $dados = $_POST;

    // verifica se não foi passado nenhum valor vazio
    foreach ($dados as $key => $value){
        if(empty($value))
            Erro::msgErro(1000, "Preencha o campo $key!");
    }

    // verifica se o email é está em um formato válido
    if(!Utils::verificaEmail($dados['email']))
        Erro::msgErro(1001, 'Email inválido!');

    // verifica se o nome é valido
    if(strlen($dados['nome'] > 50))
        Erro::msgErro(1002, 'Nome longo demais (MAX. 50 caracters)!');
    
    // verifica se as senhas conferem
    if($dados['senha'] != $dados['cenha'])
        Erro::msgErro(1003, 'As senha não conferem!');

    // remove a senha de confirmação do array
    unset($dados['cenha']);
    
    $usuario = new Usuarios($dados);

    // se houver algum erro no cadastro carrega o template de erro
    if(!$usuario->cadastrar()){
        $template = template('erro');
        print $template;

        return;
    }

    // sucesso! Redireciono para o login
    header('location: /login');
}