<?php


namespace App\Models;


use DateTimeImmutable;

/**
 * Class Tranche
 * @package App\Models
 */
class Tranche
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var float
     */
    private $interestPercentage;
    /**
     * @var float
     */
    private $maxInvestment;
    /**
     * @var Investment[]
     */
    private $listOfInvestments;

    /**
     * Tranche constructor.
     * @param int $id
     * @param float $interestPercentage
     * @param float $maxInvestment
     * @param Investment[] $listOfInvestments
     */
    public function __construct(int $id, float $interestPercentage, float $maxInvestment, array $listOfInvestments)
    {
        $this->id = $id;
        $this->interestPercentage = $interestPercentage;
        $this->maxInvestment = $maxInvestment;
        $this->listOfInvestments = $listOfInvestments;
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
    public function getInterestPercentage(): float
    {
        return $this->interestPercentage;
    }

    /**
     * @param float $interestPercentage
     */
    public function setInterestPercentage(float $interestPercentage)
    {
        $this->interestPercentage = $interestPercentage;
    }

    /**
     * @return float
     */
    public function getMaxInvestment(): float
    {
        return $this->maxInvestment;
    }

    /**
     * @param float $maxInvestment
     */
    public function setMaxInvestment(float $maxInvestment)
    {
        $this->maxInvestment = $maxInvestment;
    }

    /**
     * @return Investment[]
     */
    public function getListOfInvestments(): array
    {
        return $this->listOfInvestments;
    }

    /**
     * @param int $listOfInvestments
     */
    public function setListOfInvestments(int $listOfInvestments)
    {
        $this->listOfInvestments = $listOfInvestments;
    }

    /**
     * @param Investment $newInvestment
     */
    public function addNewInvestment(Investment $newInvestment)
    {
        $this->listOfInvestments[] = $newInvestment;
    }

    /**
     * @return float
     */
    public function getTotalInvestmentValue(): float
    {
        $total = 0.0;
        foreach ($this->listOfInvestments as $investment) {
            $total += $investment->getValue();
        }
        return $total;
    }

    /**
     * @param int $investorId
     * @return float
     */
    public function getTotalInvestmentValueForInvestor(int $investorId): float
    {
        $total = 0.0;
        foreach ($this->listOfInvestments as $investment) {
            if ($investment->getInvestorId() == $investorId) {
                $total += $investment->getValue();
            }
        }
        return $total;
    }

    /**
     * @param int $investorId
     * @param DateTimeImmutable $endDate
     * @return int
     */
    public function getDaysInvested(int $investorId, DateTimeImmutable $endDate): int
    {
        $total = 0;
        //A way to improve this bit of code
        // would be taking into account how many days each investment has lasted
        // but for simplicity sake we're just going to assume an investor is only going to invest into a tranche
        // once
        //additionally I don't really like the foreach in another foreach either
        //instead I would just query the DB on the investments with this tranche id and the specific investor id

        foreach ($this->listOfInvestments as $investment) {
            if ($investment->getInvestorId() == $investorId) {
                $startDate = $investment->getStartDate();
                $days = $startDate->diff($endDate, true)->format('%a');
                //we're adding +1 due to the diff not including the last day
                //and we're not pushing the end date + 1 to make the code more understandable
                $total += (int)$days + 1;
            }
        }
        return $total;
    }

    /**
     * @param int $investorId
     * @return float
     */
    public function calculateDailyInterestRate(int $investorId): float
    {
        $daysInMonth = [];
        foreach ($this->listOfInvestments as $investment) {
            if ($investment->getInvestorId() == $investorId) {
                $startDate = $investment->getStartDate();
                $daysInMonth[] = cal_days_in_month(CAL_GREGORIAN, (int)$startDate->format('m'), (int)$startDate->format('Y'));
            }
        }

        $averageDaysAMonth = array_sum($daysInMonth) / count($daysInMonth);
        return $this->interestPercentage / $averageDaysAMonth;
    }


}