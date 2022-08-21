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
    
    private function makeDynamoDbStub($expectedResult)
    {
        $stub = $this->createMock(DynamoDB::class);
        $stub->method('connect')->willReturn(null);
        $stub->method('findOne')->willReturn($expectedResult);
        $stub->method('update')->willReturn($expectedResult);
        return $stub;
    }
}