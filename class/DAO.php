<?php

class DAO 
{
    private $conexao;
    public static $conn;

    public function __construct()
    {
        DAO::$conn  = new PDO("mysql:host=localhost;dbname=biblioteca", 'root', 'root');
        
    }

    public static function list($sql)
    {   
        $query   = $sql;
        $stmt    = DAO::$conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function searchForId($sql, $id)
    {   
        $query   = $sql;
        $stmt    = DAO::$conn->prepare($query);
        $stmt->bindParam(":ID", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function insert($sql, $data)
    {   
        $query   = $sql;
        $stmt    = DAO::$conn->prepare($query);
        $stmt->execute($data);
    }

    public static function edit($sql, $data)
    {   
        $query   = $sql;
        $stmt    = DAO::$conn->prepare($query);
        $stmt->execute($data);
    }

    public static function delete($id)
    {
        $query   = "DELETE FROM livros WHERE id_livro = :ID";
        $stmt    = DAO::$conn->prepare($query);
        $stmt->bindParam(":ID", $id);
        $stmt->execute();
    }
}