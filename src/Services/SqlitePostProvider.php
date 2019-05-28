<?php

namespace Services;

use Contracts\PostProviderInterface;

class SqlitePostProvider implements PostProviderInterface
{

    public function getUltimos() {
        //abrir conexão com o banco sqlite via PDO
        $conn = new \PDO('sqlite:'.__DIR__."/../../db/posts.db");
        $conn->setAttribute(\PDO::ATTR_ERRMODE, 
                                \PDO::ERRMODE_EXCEPTION);
        //executar o select
        $sth = $conn->query("select * from postagens");    
        $registros = $sth->fetchAll();        
        $conn = null; // fechar conexão
        return $registros;
    }

    public function getById($id){
        //abrir conexão com o banco sqlite via PDO
        $conn = new \PDO('sqlite:'.__DIR__."/../../db/posts.db");
        $conn->setAttribute(\PDO::ATTR_ERRMODE, 
                                \PDO::ERRMODE_EXCEPTION);
        //executar o select
        $sth = $conn->query("select * from postagens where id = {$id}");    
        $registros = $sth->fetch();        
        $conn = null; // fechar conexão
        return $registros; 
    }

}