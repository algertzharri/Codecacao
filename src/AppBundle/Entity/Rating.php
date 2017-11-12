<?php

namespace AppBundle\Entity;

/**
 * Rating
 */
class Rating
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $visitorid;

    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $rating;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set visitorid
     *
     * @param string $visitorid
     *
     * @return Rating
     */
    public function setVisitorid($visitorid)
    {
        $this->visitorid = $visitorid;

        return $this;
    }

    /**
     * Get visitorid
     *
     * @return string
     */
    public function getVisitorid()
    {
        return $this->visitorid;
    }

    /**
     * Set uri
     *
     * @param string $uri
     *
     * @return Rating
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * Get uri
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Set rating
     *
     * @param string $rating
     *
     * @return Rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return string
     */
    public function getRating()
    {
        return $this->rating;
    }
}

