<?php
namespace App\Repository;

use App\DB\DB;
use App\Entity\Account;
use App\Entity\Transaction;

class AccountRepositoryDynamoWithOptimisticLock implements AccountContract {
    
    public function __construct(private DB $db)
    {
        $this->db->connect();
    }

    public function getById(string $id): Account
    {
        $statement = [
            'ConsistentRead' => true,
            'TableName' => 'Accounts',
            'Key' =>[
                'id'   => ['S' => $id]
            ]
        ];

        $result = $this->db->findOne($statement);

        var_dump($result);

        return new Account('asd', 100);
    }
    public function debit(Transaction $transaction): Transaction
    {
        return new Transaction(100, new Account('asd', 100));
    }

}
