<?php

namespace App\Services;
use DateTime;

interface WorkingHoursCalculatorInterface
{
    public function calculateHoursPerWeek(
        DateTime $startDate,
        DateTime $endDate,
        float $hoursPerWeek
    ): self;
    public function sum();

    public function getResult(): array;
}