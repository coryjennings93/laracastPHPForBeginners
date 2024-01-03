<?php

namespace Core;

use PDO;
use PDOException;

class Database
{
    public $connection;
    public $statement;

    public function __construct($config, $username = 'root', $password = 'password')
    {
        // Connect to MySQL database

        // PDO 
        $dsn = "mysql:" . http_build_query($config, '', ';');

        // makes connection to the database
        try {
            $this->connection = new PDO($dsn, $username, $password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function query($query, $params = [])
    {


        // prepare a new query
        $this->statement = $this->connection->prepare($query);

        // executes the query
        $this->statement->execute($params);

        return $this;
    }


    public function getQueryResults()
    {
        return $this->statement->fetchAll();
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();

        // runs if the id is not found
        if (!$result) {
            abort();
        }

        return $result;
    }
}
