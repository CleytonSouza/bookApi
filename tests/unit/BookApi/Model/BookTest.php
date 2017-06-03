<?php

namespace BookApi\Model;

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

        $this->object = new Book();

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
     * @covers BookApi\Model\Book::getIsbn
     */
    public function testGetIsbn()
    {
        $this->assertInternalType("string",$this->object->getIsbn());
    }


    /**
     * @covers BookApi\Model\Book::toArray
     */
    public function testToArray()
    {
        $this->assertInternalType("array",$this->object->toArray());
        $this->assertArrayHasKey('isbn', $this->object->toArray());
        $this->assertArrayHasKey('title', $this->object->toArray());
    }

    /**
    /@cover BookApi\Model\Book::getTitle
    */
    public function testGetTitle()
    {
        $this->object->setTitle("Harry Potter");
        $this->assertInternalType('string',$this->object->getTitle());
        $this->assertEquals("Harry Potter",$this->object->getTitle());
    }
}