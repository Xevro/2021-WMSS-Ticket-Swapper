<?php


class ticket {

    private $name;
    private $title;

    private $date;
    private $shortDescription;
    private $longDescription;
    private $desiredSituation;
    private $priority;
    private $email;

    public function __construct(string $name, string $title, string $date, string $shortDescription, string $longDescription, string $desiredSituation, string $priority, string $email) {
        $this->name = $name;
        $this->title = $title;
        $this->date = $date;
        $this->shortDescription = $shortDescription;
        $this->longDescription = $longDescription;
        $this->desiredSituation = $desiredSituation;
        $this->priority = $priority;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getTitle(): string {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void {
        $this->title = $title;
    }

    /**
     * @return Date
     */
    public function getDate(): string {
        return $this->date;
    }

    /**
     * @param Date $date
     */
    public function setDate(Date $date): void {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getShortDescription(): string {
        return $this->shortDescription;
    }

    /**
     * @param string $shortDescription
     */
    public function setShortDescription(string $shortDescription): void {
        $this->shortDescription = $shortDescription;
    }

    /**
     * @return string
     */
    public function getLongDescription(): string {
        return $this->longDescription;
    }

    /**
     * @param string $longDescription
     */
    public function setLongDescription(string $longDescription): void {
        $this->longDescription = $longDescription;
    }

    /**
     * @return string
     */
    public function getDesiredSituation(): string {
        return $this->desiredSituation;
    }

    /**
     * @param string $desiredSituation
     */
    public function setDesiredSituation(string $desiredSituation): void {
        $this->desiredSituation = $desiredSituation;
    }

    /**
     * @return string
     */
    public function getPriority(): string {
        return $this->priority;
    }

    /**
     * @param string $priority
     */
    public function setPriority(string $priority): void {
        $this->priority = $priority;
    }

    /**
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void {
        $this->email = $email;
    }


}