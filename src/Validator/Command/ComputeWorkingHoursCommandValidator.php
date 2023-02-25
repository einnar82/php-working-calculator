<?php

namespace App\Validator\Command;

use App\Command\ComputeWorkingHoursCommand;
use App\Validator\ValidatorInterface;
use Exception;

class ComputeWorkingHoursCommandValidator implements ValidatorInterface
{
    public function validate(array $data): void
    {
        if (count($data) < 5) {
            throw new Exception('arguments must be followed by: {startDate} {endDate} {hoursPerWeek} {format}');
        }

        [, $startDate, $endDate, $hoursPerWeek, $format] = $data;
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$startDate) === false) {
            throw new Exception('start date must YYYY-MM-DD format');
        }

        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$endDate) === false) {
            throw new Exception('end date must YYYY-MM-DD format');
        }

        if (intval($hoursPerWeek) === 0) {
            throw new Exception('hours per week is required');
        }

        if (in_array($format, ComputeWorkingHoursCommand::ALLOWED_OPERATIONS, true) === false) {
            throw new Exception("the $format operation is not allowed");
        }
    }
}