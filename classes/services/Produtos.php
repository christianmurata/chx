<?php

Namespace Services;

use Utils\Erro;
use Utils\Utils;
use Utils\Upload;
use Database\Database;

Class Produtos {

    private $produto = [
        'usuario'    => '',
        'categoria'  => '',
        'titulo'     => '',
        'descricao'  => '',
        'valor'      => '', 
        'quantidade' => '',

        'imagem'     => '',
    ];

    public function listar(){
        $query = 'SELECT * FROM produtos';

        return Database::selecionar($query);
    }

    public function cadastrar($produto){
        if(!Utils::verificaObj($produto, $this->produto))
            return false;

        // upload da imagem
        $upload = new Upload();

        if(!$img = $upload->save()) // erro upload
            return false;

        $produto['imagem'] = $img;

        // inserção do produto
        $query  = 'INSERT INTO produtos (idusuario, idcategoria, titulo, descricao, '
            . 'valor, quantidade, imagem) VALUES (?, ?, ?, ?, ?, ?, ?)';
        $params = Utils::arrayPatternKey($this->produto, $produto);
        $params = Utils::arrayKeyValue($params);

        return Database::executarParam($query, $params);
    }

}

