<?php
namespace Tests;

use App\Entity\Account;
use PHPUnit\Framework\TestCase;

class AccountTest extends TestCase {
    
    public function testShallCreateAccountObject()
    {
        $account = new Account('id', 100);

        $this->assertSame(100, $account->getBalance());
        $this->assertSame('id', $account->getId());
    }

}