<?php
class ticket{
    private $ticketName;
    private $ticketPrice;
    private $amount;
    private $reasonForSell;

    /**
     * ticket constructor.
     * @param $ticketName
     * @param $ticketPrice
     * @param $amount
     * @param $reasonForSell
     */
    public function __construct($ticketName, $ticketPrice, $amount, $reasonForSell) {
        $this->ticketName = $ticketName;
        $this->ticketPrice = $ticketPrice;
        $this->amount = $amount;
        $this->reasonForSell = $reasonForSell;
    }

    /**
     * @return mixed
     */
    public function getTicketName()
    {
        return $this->ticketName;
    }

    /**
     * @param mixed $ticketName
     */
    public function setTicketName($ticketName): void
    {
        $this->ticketName = $ticketName;
    }

    /**
     * @return mixed
     */
    public function getTicketPrice()
    {
        return $this->ticketPrice;
    }

    /**
     * @param mixed $ticketPrice
     */
    public function setTicketPrice($ticketPrice): void
    {
        $this->ticketPrice = $ticketPrice;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getReasonForSell()
    {
        return $this->reasonForSell;
    }

    /**
     * @param mixed $reasonForSell
     */
    public function setReasonForSell($reasonForSell): void
    {
        $this->reasonForSell = $reasonForSell;
    }

}
?>