<?php


class company {

    private $name;
    private $address;
    private $zip;
    private $city;
    private $activity;
    private $vat;

    function __construct(string $name, string $address, int $zip, string $city, string $activity, string $vat) {
        $this->name = $name;
        $this->address = $address;
        $this->zip = $zip;
        $this->city = $city;
        $this->activity = $activity;
        $this->vat = $vat;
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
    public function getAddress($Country = 'BE'): string {
        return ($Country = 'FR') ? $this->address . ', ' . $this->city . ' ' . $this->zip : $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void {
        $this->address = $address;
    }

    /**
     * @return int
     */
    public function getZip(): int {
        return $this->zip;
    }

    /**
     * @param int $zip
     */
    public function setZip(int $zip): void {
        $this->zip = $zip;
    }

    /**
     * @return string
     */
    public function getCity(): string {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getActivity(): string {
        return $this->activity;
    }

    /**
     * @param string $activity
     */
    public function setActivity(string $activity): void {
        $this->activity = $activity;
    }

    /**
     * @return string
     */
    public function getVat(): string {
        return $this->vat;
    }

    /**
     * @param string $vat
     */
    public function setVat(string $vat): void {
        $this->vat = $vat;
    }

    public function getFullAddress(?string $country = ''): string {
        if ($country == 'FR') {
            return $this->address . ',' . $this->city . ',' . $this->zip;
        } else {
            return $this->address . ',' . $this->zip . ',' . $this->city;
        }
    }

    public function formatAddress(string $cc = 'BE'): string {

        $adres = explode('\'', $this->getAddress());
        if ($cc == 'BE') {
            return $this->getAddress();
        } else {
            return "format adres moet FR zijn";
        }
    }

}