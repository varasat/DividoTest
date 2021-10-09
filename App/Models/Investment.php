<?php


namespace App\Models;

use DateTimeImmutable;

/**
 * Class Investment
 * @package App\Models
 */
class Investment
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var float
     */
    private $value;
    /**
     * @var int
     */
    private $investorId;
    /**
     * @var DateTimeImmutable
     */
    private $startDate;

    /**
     * Investment constructor.
     * @param int $id
     * @param float $value
     * @param int $investorId
     * @param DateTimeImmutable $startDate
     */
    public function __construct(int $id, float $value, int $investorId, DateTimeImmutable $startDate)
    {
        $this->id = $id;
        $this->value = $value;
        $this->investorId = $investorId;
        $this->startDate = $startDate;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue(float $value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getInvestorId(): int
    {
        return $this->investorId;
    }

    /**
     * @param int $investorId
     */
    public function setInvestorId(int $investorId)
    {
        $this->investorId = $investorId;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getStartDate(): DateTimeImmutable
    {
        return $this->startDate;
    }

    /**
     * @param DateTimeImmutable $startDate
     */
    public function setStartDate(DateTimeImmutable $startDate)
    {
        $this->startDate = $startDate;
    }


}