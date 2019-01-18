<?php

use Utils\Erro;
use Utils\Utils;
use Services\Usuarios;

function _get($args){
    $usuario = new Usuarios($_SESSION['usuario']);
    $usuario->logout();

    // logout efetuado com sucesso!
    header('location: /');
}