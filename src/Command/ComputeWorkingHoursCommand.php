<?php

namespace App\Command;

use App\Manager\ResponseManager;
use App\Services\WorkingHoursCalculator;
use DateTime;
use Exception;

class ComputeWorkingHoursCommand
{
    private const SUM_RESPONSE = 'sum';

    private const JSON_RESPONSE = 'json';

    private const ALLOWED_OPERATIONS = [self::JSON_RESPONSE, self::SUM_RESPONSE];

    public function __construct(private array $args)
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(WorkingHoursCalculator $workingHoursCalculator)
    {
        $this->validateArguments($this->args);

        [, $startDate, $endDate, $hoursPerWeek, $format] = $this->args;
        $startDate = new DateTime($startDate);
        $endDate = new DateTime($endDate);

        $result = $workingHoursCalculator->calculateHoursPerWeek($startDate, $endDate, $hoursPerWeek);
        $data = $result->getResult();
        $response = match ($format) {
            self::SUM_RESPONSE => $result->sum(),
            default => (new ResponseManager($data, $format))(),
        };

        print_r($response);
    }

    /**
     * @throws Exception
     */
    private function validateArguments(array $args): void
    {
        if (count($args) < 5) {
            throw new Exception('arguments must be followed by: {startDate} {endDate} {hoursPerWeek} {format}');
        }

        [, $startDate, $endDate, $hoursPerWeek, $format] = $args;
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$startDate) === false) {
            throw new Exception('start date must YYYY-MM-DD format');
        }

        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$endDate) === false) {
            throw new Exception('end date must YYYY-MM-DD format');
        }

        if (intval($hoursPerWeek) === 0) {
            throw new Exception('hours per week is required');
        }

        if (in_array($format, self::ALLOWED_OPERATIONS, true) === false) {
            throw new Exception("the $format operation is not allowed");
        }
    }
}