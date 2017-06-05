<?php

namespace BookApi\Model;

use BookApi\Model\Book;

class AuthorTest extends \PHPUnit\Framework\TestCase
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
        $this->object = new Author();
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
     * @covers       BookApi\Model\Book::getAuthors
     * @dataProvider additionProviderBook
     */
    public function testGetBooks()
    {
        $books = $this->object->books();

        $this->assertInternalType("array", $books);

        $book = $books[0];

        $this->assertInstanceof("BookApi\Model\Book", $book);
    }


    public function additionProviderBook()
    {
        $book = new Book();
        return array($book);
    }
}
