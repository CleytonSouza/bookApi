<?php

namespace BookApi\DAL;

use BookApi\DAL\DAO\Author;
use BookApi\DAL\DAO\Book;
use BookApi\DAL\DAO\Publisher;
use BookApi\Model\Business;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class DAL
{
    private function getBookDAO()
    {
        return new Book();
    }

    private function getAuthorDAO()
    {
        return new Author();
    }

    private function getPublisherDAO()
    {
        return new Publisher();
    }

    public function persist(Business $business)
    {
        if($business instanceof \BookApi\Model\Book){
            return $this->getBookDAO()->insert($business);
        }

        if($business instanceof \BookApi\Model\Author){
            return $this->getAuthorDAO()->insert($business);
        }

        if($business instanceof \BookApi\Model\Publisher){
            return $this->getPublisherDAO()->insert($business);
        }

        return $business;
    }

    public function update(Business $business)
    {
        if($business instanceof \BookApi\Model\Book){
            return $this->getBookDAO()->update($business);
        }

        if($business instanceof \BookApi\Model\Author){
            return $this->getAuthorDAO()->update($business);
        }

        if($business instanceof \BookApi\Model\Publisher){
            return $this->getPublisherDAO()->update($business);
        }

        return $business;
    }

    public function delete(Business $business)
    {
        if($business instanceof \BookApi\Model\Book){
            return $this->getBookDAO()->delete($business);
        }

        if($business instanceof \BookApi\Model\Author){
            return $this->getAuthorDAO()->delete($business);
        }

        if($business instanceof \BookApi\Model\Publisher){
            return $this->getPublisherDAO()->delete($business);
        }

        return $business;
    }

    public function find(Business $business)
    {
        if($business instanceof \BookApi\Model\Book){
            return $this->getBookDAO()->find($business);
        }

        if($business instanceof \BookApi\Model\Author){
            return $this->getAuthorDAO()->find($business);
        }

        if($business instanceof \BookApi\Model\Publisher){
            return $this->getPublisherDAO()->find($business);
        }

        return $business;
    }

    public function all($className)
    {
        if($className == "\\BookApi\\Model\\Book"){
            return $this->getBookDAO()->all();
        }

        if($className == "\\BookApi\\Model\\Author"){
            return $this->getAuthorDAO()->all();
        }

        if($className == "\\BookApi\\Model\\Publisher"){
            return $this->getPublisherDAO()->all();
        }

        throw new InvalidArgumentException("colletion not found",404);
    }
}
