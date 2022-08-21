<?php
namespace Tests;

use App\Entity\Account;
use App\Entity\Transaction;
use DomainException;
use PHPUnit\Framework\TestCase;

class TransactionTest extends TestCase {
    
    public function testShallCreateTransactionObject()
    {
        $account = new Account('id', 100);
        $transaction = new Transaction(100, $account);
        $this->assertSame('id', $transaction->getAccountId());
        $this->assertSame(100, $transaction->getAmount());
    }
}