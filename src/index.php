<?php
include './vendor/autoload.php';

use App\Application\DebitAccount;
use App\DB\DynamoDB;
use App\Repository\AccountRepositoryDynamoWithOptimisticLock;

$debitAccount = new DebitAccount(
    new AccountRepositoryDynamoWithOptimisticLock(
        new DynamoDB()
    )
);

$input = new stdClass();
$input->id = 'A1469CCD-10B8-4D31-83A2-86B71BF39EA8';

$debitAccount->execute($input);