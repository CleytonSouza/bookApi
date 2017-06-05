<?php

namespace BookApi\Model;

class Publisher implements Business
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * Publisher constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->setName($name);
    }

    /**
     * @return int
     */
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
        return (string) $this->name;
    }

    /**
     * @return array
     */
    public function books()
    {
        return array();
    }

    public function toArray()
    {
        return array(
            "id"=>$this->getId(),
            "name"=>$this->getName()
        );
    }
}
