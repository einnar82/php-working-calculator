<?php

namespace App\Services;
use DateInterval;
use DatePeriod;
use DateTime;

class WorkingHoursCalculator implements WorkingHoursCalculatorInterface
{
    private array $result = [];
    public function calculateHoursPerWeek(
        DateTime $startDate,
        DateTime $endDate,
        float $hoursPerWeek
    ): self {
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($startDate, $interval, $endDate->modify( '+1 day' ));

        $result = [];

        foreach ($period as $dayWorked) {
            $hoursWorked = $hoursPerWeek / 5;
            if ($dayWorked->format('N') > 5) {
                // no work on weekends
                $hoursWorked = 0;
            }

            $result[$dayWorked->format('c')] = $hoursWorked;
        }

        $this->result = $result;

        return $this;
    }

    /**
     * @return float|int
     */
    public function sum()
    {
        return array_sum(array_values($this->result));
    }

    public function getResult(): array
    {
        return $this->result;
    }
}