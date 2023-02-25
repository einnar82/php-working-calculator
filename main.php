<?php

use App\Command\ComputeWorkingHoursCommand;
use App\Services\WorkingHoursCalculator;
use App\Validator\Command\ComputeWorkingHoursCommandValidator;

require './vendor/autoload.php';

$command = new ComputeWorkingHoursCommand($argv);

return $command(new ComputeWorkingHoursCommandValidator(), new WorkingHoursCalculator()).PHP_EOL;