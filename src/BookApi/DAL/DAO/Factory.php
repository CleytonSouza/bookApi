<?php

namespace BookApi\DAL\DAO;

class Factory
{
    protected static $connection;

    /**
     * @return \PDO
     */
    public function createConnection()
    {
        try {
            $hostname = getenv('APPLICATION_DB_HOST');
            $name = getenv('APPLICATION_DB_NAME');
            $port = getenv('APPLICATION_DB_PORT');
            $username = getenv('APPLICATION_DB_USER');
            $password = getenv('APPLICATION_DB_PASSWORD');
            $charset = getenv('APPLICATION_DB_CHARSET') ? getenv('APPLICATION_DB_CHARSET') : 'utf8';

            $connection = new \PDO(
                sprintf('mysql:host=%s;port=%d;dbname=%s;charset=%s',$hostname,$port,$name,$charset),
                $username,$password
            );

            $connection->setAttribute(
                \PDO::ATTR_ERRMODE,
                \PDO::ERRMODE_EXCEPTION
            );
            $connection->exec('SET NAMES utf8');
            return $connection;
        } catch (\PDOException $e) {
            throw new \RuntimeException('Connection failed', 503);
        }
    }
}
