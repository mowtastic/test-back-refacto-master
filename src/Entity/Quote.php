<?php

class Quote
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $siteId;

    /**
     * @var int
     */
    private $destinationId;

    /**
     * @var DateTime
     */
    private $dateQuoted;

    public function __construct($id, $siteId, $destinationId, $dateQuoted)
    {
        $this->id = $id;
        $this->siteId = $siteId;
        $this->destinationId = $destinationId;
        $this->dateQuoted = $dateQuoted;
    }

    public static function renderHtml(Quote $quote)
    {
        return '<p>' . $quote->id . '</p>';
    }

    public static function renderText(Quote $quote)
    {
        return (string) $quote->id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getSiteId()
    {
        return $this->siteId;
    }

    /**
     * @param int $siteId
     */
    public function setSiteId($siteId)
    {
        $this->siteId = $siteId;
    }

    /**
     * @return int
     */
    public function getDestinationId()
    {
        return $this->destinationId;
    }

    /**
     * @param int $destinationId
     */
    public function setDestinationId($destinationId)
    {
        $this->destinationId = $destinationId;
    }

    /**
     * @return DateTime
     */
    public function getDateQuoted()
    {
        return $this->dateQuoted;
    }

    /**
     * @param DateTime $dateQuoted
     */
    public function setDateQuoted($dateQuoted)
    {
        $this->dateQuoted = $dateQuoted;
    }

}