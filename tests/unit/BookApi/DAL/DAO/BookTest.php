<?php

namespace BookAPI\DAL\DAO;


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
    	$this->object = new \BookApi\DAL\DAO\Book();
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
     * @covers Book::all
     */
    public function testAll()
    {
        $this->assertInternalType("array", $this->object->all()); 
        $book = $this->object->all()[0];
        $this->assertInstanceof("\\BookApi\\Model\\Book",$book);
    }    

    /**
     * @covers Book::insert
     */
    public function testInsert()
    {
        //$this->assertInstanceof("BookApi\DAL\DAO\Book", $author);        
    }

    /**
     * @covers Book::insert
     */
    public function testUpdate()
    {
        //$this->assertInstanceof("BookApi\DAL\DAO\Book", $author);        
    }

    /**
     * @covers Book::insert
     */
    public function testDelete()
    {
        //$this->assertInstanceof("BookApi\DAL\DAO\Book", $author);        
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

