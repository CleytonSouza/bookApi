<?php

namespace BookApi\Model;

use BookApi\Model\Publisher;

class BookTest extends \PHPUnit\Framework\TestCase
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
        $this->object = new Book(
            new Publisher('Novatec'),
            'PHP Moderno: Novos recursos e boas práticas',
            array(
                new Author('Josh','Lockhart')
            )
        );
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        unset($this->object);
    }

    /**
     * @covers Book::getIsbn
     */
    public function testGetIsbn()
    {
        $this->assertInternalType("string", $this->object->getIsbn());
    }


    /**
     * @covers Book::toArray
     */
    public function testToArray()
    {
        $this->assertInternalType("array", $this->object->toArray());
        $this->assertArrayHasKey("isbn", $this->object->toArray());
        $this->assertArrayHasKey("name", $this->object->toArray());
    }

    /**
     * /@cover Book::getTitle
     */
    public function testGetTitle()
    {
        $this->assertInternalType('string', $this->object->getName());
        $this->assertEquals('PHP Moderno: Novos recursos e boas práticas', $this->object->getName());
    }
}
