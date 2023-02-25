<?php

use App\Command\ComputeWorkingHoursCommand;
use App\Services\WorkingHoursCalculator;

require './vendor/autoload.php';

$command = new ComputeWorkingHoursCommand($argv);

return $command(new WorkingHoursCalculator());