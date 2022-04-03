<?php
require_once "vendor/autoload.php";

use RokPayment\Service\readers\CsvReader;
use RokPayment\Service\commissions\CommissionCalculator;
use RokPayment\Service\Operation;
use RokPayment\Service\OperationRepository;

$filename = $argv[1];

$repository = new OperationRepository();

$reader = new CsvReader($filename, ',');

$data = $reader->getData();

$id = 1;

foreach ($data as $row) {
    $operation = new Operation();
    $operation->setId($id++);
    $operation->setDate($row[0]);
    $operation->setUserId((int) $row[1]);
    $operation->setUserType($row[2]);
    $operation->setOperationType($row[3]);
    $operation->setAmount($row[4]);
    $operation->setCurrency($row[5]);

    $repository->add($operation);
}


$commissionCalculator = new CommissionCalculator($repository);
$results = $commissionCalculator->calculate();

foreach ($results as $result) {
    fwrite(STDOUT, $result);
    fwrite(STDOUT, "\n");
}
