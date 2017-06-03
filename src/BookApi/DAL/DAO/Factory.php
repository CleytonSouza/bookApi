<?php

namespace BookApi\DAL\DAO;

class Factory
{
    /**
     * @return \PDO
     */
    public function createConnection()
    {
        $hostname = "localhost:3306";
        $dbname = "bookApi";
        $username = "root";
        $password = "4linux";

        try {
            $connection = new \PDO(
                "mysql:host=$hostname;dbname=$dbname;charset=utf8",
                $username,
                $password
            );
            $connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
            $connection->exec('SET NAMES utf8');
            return $connection;
        }catch(PDOException $e){
            throw $e;
        }
    }
}