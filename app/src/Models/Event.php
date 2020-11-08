<?php

class Event {
    private $eventName;
    private $standardPrice;
    private $startDate;
    private $endDate;
    private $location;
    private $description;
    private $artists;

    public function __construct(string $eventName, float $standardPrice, string $startDate, string $endDate, string $location, string $description, string $artists) {
        $this->eventName = $eventName;
        $this->standardPrice = $standardPrice;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->location = $location;
        $this->description = $description;
        $this->artists = $artists;
    }

    /**
     * @return string
     */
    public function getStartDate(): string {
        return $this->startDate;
    }

    /**
     * @param string $startDate
     */
    public function setStartDate(string $startDate) {
        $this->startDate = $startDate;
    }

    /**
     * @return string
     */
    public function getEndDate(): string {
        return $this->endDate;
    }

    /**
     * @param string $endDate
     */
    public function setEndDate(string $endDate) {
        $this->endDate = $endDate;
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
        return number_format($this->standardPrice, 2);;
    }

    /**
     * @param mixed $standardPrice
     */
    public function setStandardPrice($standardPrice): void {
        $this->standardPrice = $standardPrice;
    }
}