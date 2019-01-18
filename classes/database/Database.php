<?php

namespace Database;

use \PDO;

class Database
{
    //variable to hold connection object.
    protected static $db;

    protected static function conecta() {
        try {
            // assign PDO object to db variable
            self::$db = new PDO('mysql:host=chx_mysql;dbname=chx', 'root', 'chx');
            self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }catch (PDOException $e) {
            return 'Connection Error: ' . $e->getMessage();
        }
    }

    public static function selecionar($sql){
        self::conecta();

        try{
            $query = self::$db->query($sql);
            
            if($query)
                return $query->fetchAll(PDO::FETCH_ASSOC);

        }catch(PDOException $e){
            return 'Erro ao processar consulta. Erro: <br>'.$e->getMessage().'<br>';
        }
    }

    public static function selecionarParam($sql, $param){
        self::conecta();

        try{
            $stmt = self::$db->prepare($sql);

            foreach($param as $key => $value){              
                $stmt->bindValue($key + 1, $value);
            }

            $query = $stmt->execute();

            if($query)
                return $stmt->fetchAll(PDO::FETCH_ASSOC); 
            
        }catch(PDOException $e){
            return 'Erro ao processar consulta. Erro: <br>'.$e->getMessage().'<br>';
        }
    }

    public static function executarParam($sql, $param){
        self::conecta();

        try{            
            $stmt = self::$db->prepare($sql);
            
            foreach($param as $key => $value){
                $stmt->bindValue($key + 1, $value);
            }
            
            return $stmt->Execute();

        }catch(PDOException $e){
            return 'Erro ao processar consulta. Erro: <br>'.$e->getMessage().'<br>';
        }
    }
}