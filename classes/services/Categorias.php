<?php

namespace Services;

use Utils\Erro;
use Utils\Utils;
use Database\Database;

class Categorias{
    
    private $categoria = [
        // 'slug'      => '',
        'titulo'    => '',
        'descricao' => '',
    ];

    public function listar(){
        $query = 'SELECT * FROM categorias';
        
        return Database::selecionar($query);
    }

    public function buscarPorId($id, $excluido = false){
        $query = 'SELECT * FROM categorias WHERE id = ? AND excluido = ?';

        return Database::selecionarParam($query, array($id, $excluido));
    }

    public function cadastrar($categoria){
        if(!Utils::verificaObj($categoria, $this->categoria))
            return false;

        $query  = 'INSERT INTO categorias (titulo, descricao) VALUES (?, ?)';
        $params = Utils::arrayKeyValue($categoria);

        return Database::executarParam($query, $params);        
    }

    public function atualizar($categoria, $id){
        if(!Utils::verificaObj($categoria, $this->categoria))
            return false;

        // adicionando o id ao array
        $categoria['id'] = $id;

        // atualiza a categoria do id
        $query  = 'UPDATE categorias SET titulo = ?, slug = ?, descricao = ? WHERE id = ?';
        $params = Utils::arrayKeyValue($categoria);
        
        return Database::executarParam($query, $params);
    }

    public function tituloDoSlug($titulo){

    }

}