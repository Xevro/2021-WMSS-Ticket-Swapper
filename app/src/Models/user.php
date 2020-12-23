<?php


class user {

    private $firstName;
    private $lastName;
    private $address;
    private $couponCode;
    private $inviteNumber;
    private $email;
    private $dicountAmount;

    public function __construct($firstName, $lastName, $address, $couponCode, $inviteNumber, $email, $dicountAmount) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->couponCode = $couponCode;
        $this->inviteNumber = $inviteNumber;
        $this->email = $email;
        $this->dicountAmount = $dicountAmount;
    }

    /**
     * @return mixed
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName): void {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): void {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getCouponCode() {
        return $this->couponCode;
    }

    /**
     * @param mixed $couponCode
     */
    public function setCouponCode($couponCode): void {
        $this->couponCode = $couponCode;
    }

    /**
     * @return mixed
     */
    public function getInviteNumber() {
        return $this->inviteNumber;
    }

    /**
     * @param mixed $inviteNumber
     */
    public function setInviteNumber($inviteNumber): void {
        $this->inviteNumber = $inviteNumber;
    }

    /**
     * @return mixed
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getDicountAmount() {
        return $this->dicountAmount;
    }

    /**
     * @param mixed $dicountAmount
     */
    public function setDicountAmount($dicountAmount): void {
        $this->dicountAmount = $dicountAmount;
    }
}