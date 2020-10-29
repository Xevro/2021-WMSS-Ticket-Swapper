<?php


class contact {
    private $id;
    private $name;
    private $client;
    private $email;
    private $phone;

    public function __construct(int $id, string $name, string $client, string $email, int $phone) {
        $this->id = $id;
        $this->name = $name;
        $this->client = $client;
        $this->email = $email;
        $this->phone = $phone;
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getClient() {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client): void {
        $this->client = $client;
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
    public function getPhone() {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void {
        $this->phone = $phone;
    }
}