<?php

use Services\Geral;

function _get($args){
    $geral = new Geral;

    // se as tabelas já existirem retorna para a tela inicial
    if($geral->verifyExistTables()){
        header('location: /');
        exit; // para evitar problemas
    }

    // caso contrário realiza o dump
    if(!$geral->executaDump())
        print "Erro ao realizar o DUMP!";

    print "Dump realizado com sucesso! (RECARREGUE A PÁGINA)";

}