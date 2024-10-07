<?php

namespace Framework;

use PDO, \Exception, PDOException;

class Database
{
    public $conn;
    /**
     * constructor for the database class
     *
     * @param array $config
     */
    public function __construct($config)
    {
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset=utf8";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try {
            $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);
        } catch (PDOException $e) {
            throw new Exception("Database connection error: {$e->getMessage()}");
        }
    }
    /**
     * run a query
     *
     * @param string $query
     * @return PDOStatement
     * @throws PDOException
     */
    public function query($query, $prams = [])
    {
        try {
            $stch = $this->conn->prepare($query);
            // bind named parameters
            foreach ($prams as $pram => $value) {
                $stch->bindValue(':' . $pram, $value);
            };
            $stch->execute();
            return $stch;
        } catch (PDOException $e) {
            throw new Exception("query failed to execute: {$e->getMessage()}");
        }
    }
}
