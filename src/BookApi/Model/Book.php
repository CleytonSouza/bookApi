<?php
namespace BookApi\Model;

class Book implements Business
{
    protected $isbn;
    protected $title;

    /**
     * @return int 
     */
    public function getIsbn()
    {
        return (string) $this->isbn;
    }

    public function toArray()
    {
        return array(
            "isbn"=> $this->isbn,
            "title"=> $this->title
        );
    }

    public function getTitle()
    {
        return (string) $this->title;
    }

    public function setTitle($a)
    {
        $this->title = $a;
    }
}
