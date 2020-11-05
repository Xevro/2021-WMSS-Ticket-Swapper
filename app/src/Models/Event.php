<?php

class Event {
    private $eventName;
    private $standardPrice;
    private $location;
    private $description;
    private $artists;

    public function __construct(string $eventName, double $standardPrice, string $location, string $description, string $artists) {
        $this->eventName = $eventName;
        $this->standardPrice = $standardPrice;
        $this->location = $location;
        $this->description = $description;
        $this->artists = $artists;
    }

    /**
     * @return mixed
     */
    public function getArtists() {
        return $this->artists;
    }

    /**
     * @param mixed $artists
     */
    public function setArtists($artists): void {
        $this->artists = $artists;
    }

    /**
     * @return mixed
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getEventName() {
        return $this->eventName;
    }

    /**
     * @param mixed $eventName
     */
    public function setEventName($eventName): void {
        $this->eventName = $eventName;
    }

    /**
     * @return mixed
     */
    public function getLocation() {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location): void {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getStandardPrice() {
        return $this->standardPrice;
    }

    /**
     * @param mixed $standardPrice
     */
    public function setStandardPrice($standardPrice): void {
        $this->standardPrice = $standardPrice;
    }
}