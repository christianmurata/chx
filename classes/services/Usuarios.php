<?php

namespace Services;

use Utils\Erro;
use Utils\Utils;
use Database\Database;

class Usuarios {

    private $usuario = [
        'email'   => '',
        'nome'    => '',
        'senha'   => '',
        'usuario' => '',
    ];

    private function usuarioExiste($usuario){
        $sql = 'SELECT usuario FROM usuarios WHERE usuario = ?';

        if(empty(Database::selecionarParam($sql, array($usuario))))
            return true;

        return false;
    }

    private function emailExiste($email){
        $sql = 'SELECT email FROM usuarios WHERE email = ?';

        if(empty(Database::selecionarParam($sql, array($email))))
            return true;

        return false;
    }

    public function __construct($usuario){
        if(!Utils::verificaObj($usuario, $this->usuario))
            Erro::msgErro(1010, 'Objeto usuário inválido');

        $this->usuario = $usuario;
    }

    public function cadastrar(){
        // verifica se o email já existe         
        if(!$this->emailExiste($this->usuario['email']))
            Erro::msgErro(1004, 'O email inserido já está cadastrado!');

        // verifica se o username já existe
        if(!$this->usuarioExiste($this->usuario['usuario']))
            Erro::msgErro(1005, 'O nome de usuários inserido já existe!');
        
        // criptografa a senha em MD5
        $this->usuario['senha'] = md5($this->usuario['senha']);

        // se estiver tudo ok, insere de fato...
        $sql    = 'INSERT INTO usuarios (usuario, nome, email, senha) VALUES (?, ?, ?, ?)';
        $params = Utils::arrayKeyValue($this->usuario);

        return Database::executarParam($sql, $params);

    }
        
    public function atualizar(){
        
    }

    public function login(){
        $query  = 'SELECT id, email, nome, usuario, senha, privileges FROM usuarios WHERE email = ? OR usuario = ?';
        $params = array($this->usuario['email'], $this->usuario['usuario']);

        $usuario = Database::selecionarParam($query, $params);
        
        // apenas o primeiro item do array importa
        $usuario = array_shift($usuario);

        // caso exista algum usuário com o usuário ou email...
        if(!empty($usuario)){
            // verifica se as senha conferem
            if(md5($this->usuario['senha']) != $usuario['senha'])
                return false;

            // adiciona o id de usuário e os privilégios
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['privilegios'] = $usuario['privileges'];
            
            // adiciona as informações do usuário a session
            $_SESSION['usuario'] = Utils::arrayPatternKey($this->usuario, $usuario);

            return true;
        }

        return false;

    }

    public function logout(){
        unset($_SESSION);
        session_destroy();
    }

}