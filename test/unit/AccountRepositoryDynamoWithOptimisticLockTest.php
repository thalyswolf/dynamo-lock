<?php
namespace Tests;

use App\DB\DynamoDB;
use App\Entity\Account;
use App\Entity\Transaction;
use App\Repository\AccountRepositoryDynamoWithOptimisticLock;
use Exception;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\isInstanceOf;

class AccountRepositoryDynamoWithOptimisticLockTest extends TestCase {
}