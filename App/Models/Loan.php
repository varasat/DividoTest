<?php


namespace App\Models;


use DateTimeImmutable;

/**
 * Class Loan
 * @package App\Models
 */
class Loan
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var DateTimeImmutable
     */
    private $startDate;
    /**
     * @var DateTimeImmutable
     */
    private $endDate;
    /**
     * @var Tranche[]
     */
    private $listOfTranches;

    /**
     * Loan constructor.
     * @param int $id
     * @param DateTimeImmutable $startDate
     * @param DateTimeImmutable $endDate
     * @param Tranche[]
     */
    public function __construct(int $id, DateTimeImmutable $startDate,
                                DateTimeImmutable $endDate, array $listOfTranches)
    {
        $this->id = $id;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->listOfTranches = $listOfTranches;
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

    /**
     * @return DateTimeImmutable
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param DateTimeImmutable $endDate
     */
    public function setEndDate(DateTimeImmutable $endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return Tranche[]
     */
    public function getListOfTranches(): array
    {
        return $this->listOfTranches;
    }

    /**
     * @param Tranche[] $listOfTranches
     */
    public function setListOfTranches($listOfTranches)
    {
        $this->listOfTranches = $listOfTranches;
    }


}