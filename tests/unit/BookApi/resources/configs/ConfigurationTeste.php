<?php

namespace BookApi\resources\configs;

class ConfigurationTeste extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Sum
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Factory();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        unset($this->object);
    }

    public function testCreateConnection()
    {
        putenv('APPLICATION_DB_HOST=localhost');
        putenv('APPLICATION_DB_NAME=bookapi');
        putenv('APPLICATION_DB_PORT=3306');
        putenv('APPLICATION_DB_USER=application_user');
        putenv('APPLICATION_DB_PASSWORD=123456789');
        putenv('APPLICATION_DB_CHARSET=utf8');

        $this->assertInstanceOf("PDO", $this->object->createConnection());
    }
}
