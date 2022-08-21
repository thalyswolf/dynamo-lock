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

    public function testShallGetAccountById()
    {
        $dbResult = [
            'Item' => [
                'id' => ['S' => 'faker_id'],
                'balance' => ['N' => '1000']
            ]
        ];

        $stubDb = $this->makeDynamoDbStub($dbResult);
        $accountRepository = new AccountRepositoryDynamoWithOptimisticLock($stubDb);

        $account = $accountRepository->getById('faker_id');

        $this->assertSame('faker_id', $account->getId());
        $this->assertSame(1000, $account->getBalance());
    }
}