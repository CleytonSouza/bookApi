<?php

namespace BookApi\Model;

use BookApi\DAL\Publisher;

class PublisherTest extends \PHPUnit\Framework\TestCase

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

        $this->object = new Publisher();

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
     * @covers BookApi\Model\Book::getAuthors
     */
    public function getAuthors()

    {
        $authors = $this->object->getAuthors();

        $this->assertInternalType("array",$authors);

        $author = $authors[0];

        $this->assertInstanceof("BookApi\Model\Author",$author);

    }

}