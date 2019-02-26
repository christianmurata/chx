<?php

namespace Services;

use Database\Database;

class Geral{

    public function verifyExistTables(){
        if(!Database::executar('SELECT 1 FROM usuarios'))
            return false;

        if(!Database::executar('SELECT 1 FROM produtos'))
            return false;

        if(!Database::executar('SELECT 1 FROM categorias'))
            return false;

        return true;
    }

    public function executaDump(){
        return Database::dump();
    }
}