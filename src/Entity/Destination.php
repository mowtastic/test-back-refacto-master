<?php

class Destination
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $countryName;

    /**
     * @var string
     */
    private $conjunction;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $computerName;


    public function __construct($id, $countryName, $conjunction, $computerName)
    {
        $this->id = $id;
        $this->countryName = $countryName;
        $this->conjunction = $conjunction;
        $this->computerName = $computerName;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * @param string $countryName
     */
    public function setCountryName($countryName)
    {
        $this->countryName = $countryName;
    }

    /**
     * @return string
     */
    public function getConjunction()
    {
        return $this->conjunction;
    }

    /**
     * @param string $conjunction
     */
    public function setConjunction($conjunction)
    {
        $this->conjunction = $conjunction;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getComputerName()
    {
        return $this->computerName;
    }

    /**
     * @param string $computerName
     */
    public function setComputerName($computerName)
    {
        $this->computerName = $computerName;
    }
}
