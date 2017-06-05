<?php
namespace BookApi\Model;

use BookApi\Model\Publisher;

class Book implements Business
{
    /**
     * @var integer
     */
    protected $id;
    /**
     * @var string
     */
    protected $isbn;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var Publisher
     */
    protected $publisher;

    /**
     * @var array
     */
    protected $authors;

    /**
     * Book constructor.
     * @param Publisher $publisher
     * @param $name
     */
    public function __construct(Publisher $publisher,$name,array $authors)
    {
        $this->setPublisher($publisher);
        $this->setName($name);
        $this->setAuthors($authors);
    }

    public function getId()
    {
        return (int) $this->id;
    }

    /**
     * @param $name
     * @return $this
     */
    private function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $isbn
     * @return $this
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
        return $this;
    }

    /**
     * @return string
     */
    public function getIsbn()
    {
        return (string) $this->isbn;
    }

    public function setAuthors(array $authors)
    {
        return $this->authors = $authors;
    }

    /**
     * @return array
     */
    public function getAuthors()
    {
        return array();
    }

    /**
     * @param Publisher $publisher
     */
    private function setPublisher(Publisher $publisher)
    {
        $this->publisher = $publisher;
    }

    /**
     * @return Publisher
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            "id" => $this->getId(),
            "isbn" => $this->getIsbn(),
            "name" => $this->getName(),
            "publisher" => $this->getPublisher()->getId(),
        );
    }
}
