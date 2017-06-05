<?php
namespace BookApi\Model;

class Author implements Business
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * Author constructor.
     * @param $firstName
     * @param $lastName
     */
    public function __construct($firstName,$lastName)
    {
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return (int) $this->id;
    }

    /**
     * @param $firstName
     * @return $this
     */
    private function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param $lastName
     * @return $this
     */
    private function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return array
     */
    public function books()
    {
        return array();
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            "id"=>$this->getId(),
            "firstName"=>$this->getFirstName(),
            "lastName"=>$this->getLastName()
        );
    }
}
