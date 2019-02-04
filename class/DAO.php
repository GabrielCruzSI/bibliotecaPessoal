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
        try {
            $host = '127.0.0.1';
            $db   = 'biblioteca';
            $user = 'root';
            $pass = 'root';

            $charset = 'utf8';

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $this->conexao = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        if (!$this->conexao) {
            try {
                $this->conexao = new \PDO("mysql:host=localhost;dbname=biblioteca", 'root', 'root');
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
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
        $stmt->bindParam(1, $id);
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