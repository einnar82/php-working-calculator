<?php

namespace App\Command;

use App\Manager\ResponseManager;
use App\Services\WorkingHoursCalculatorInterface;
use App\Validator\ValidatorInterface;
use DateTime;
use Exception;

class ComputeWorkingHoursCommand
{
    private const SUM_RESPONSE = 'sum';

    private const JSON_RESPONSE = 'json';

    public const ALLOWED_OPERATIONS = [self::JSON_RESPONSE, self::SUM_RESPONSE];

    public function __construct(private array $args)
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(ValidatorInterface $validator, WorkingHoursCalculatorInterface $workingHoursCalculator)
    {
        $validator->validate($this->args);

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
}