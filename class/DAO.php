<?php

abstract class DAO
{
    /**
     * @var \Zend\Db\Adapter\Driver\Pdo\Pdo
     */
    private $conexao;

    /**
     * DAO constructor.
     */
    public function __construct()
    {
        $this->conexao = new \PDO("mysql:host=localhost;dbname=biblioteca", 'root', 'root');
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        if (!$this->conexao) {
            $this->conexao = new \PDO("mysql:host=localhost;dbname=biblioteca", 'root', 'root');
        }

        return $this->conexao;
    }

    /**
     * @param $sql
     * @return array
     */
    public function list($sql)
    {   
        $query   = $sql;
        $stmt    = $this->getConnection()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * @param $sql
     * @param $id
     * @return mixed
     */
    public function searchForId($sql, $id)
    {   
        $query   = $sql;
        $stmt    = $this->getConnection()->prepare($query);
        $stmt->bindParam(":ID", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * @param $sql
     * @param $data
     */
    public function insert($sql, $data)
    {   
        $query   = $sql;
        $stmt    = $this->getConnection()->prepare($query);
        $stmt->execute($data);
    }

    /**
     * @param $sql
     * @param $data
     */
    public function edit($sql, $data)
    {   
        $query   = $sql;
        $stmt    = $this->getConnection()->prepare($query);
        $stmt->execute($data);
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $query   = "DELETE FROM livros WHERE id_livro = :ID";
        $stmt    = $this->getConnection()->prepare($query);
        $stmt->bindParam(":ID", $id);
        $stmt->execute();
    }
}