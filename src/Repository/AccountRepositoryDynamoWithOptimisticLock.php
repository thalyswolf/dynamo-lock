<?php
namespace App\Repository;

use App\DB\DB;
use App\Entity\Account;
use App\Entity\Transaction;
use Exception;
use Aws\DynamoDb\Exception\DynamoDbException;

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

        return new Account($result['Item']['id']['S'], (int) $result['Item']['balance']['N']);
    }
    public function debit(Transaction $transaction): Transaction
    {
        try {
            $statementGetAccount = [
                'ConsistentRead' => true,
                'TableName' => 'Accounts',
                'Key' =>[
                    'id'   => ['S' => $transaction->getAccountId()]
                ]
            ];
            $resultAccount = $this->db->findOne($statementGetAccount);
            $account = new Account($resultAccount['Item']['id']['S'], (int) $resultAccount['Item']['balance']['N']);
            if ($account->getBalance() < $transaction->getAmount()) throw new Exception("Insuficient funds");
    
            $debitStatement = [
                'TableName' => 'Accounts',
                'ConditionExpression' => 'version = :version',
                'Key' => [
                    'id' => ['S' => $transaction->getAccountId()]
                ],
                'ExpressionAttributeValues' => [
                    ':amount' => ['N' => (string)$transaction->getAmount()],
                    ':version' => ['N' => (string) $resultAccount['Item']['version']['N']],
                    ':count' =>['N' => '1']
                ],
                'UpdateExpression' => 'SET balance = balance - :amount, version = version + :count',
                'ReturnValues' => 'ALL_NEW'
            ];
    
            $result = $this->db->update($debitStatement);

            $newbalance = $result['Attributes']['balance']['N'];

            // Generate random ID
            $id = random_int(1, 1000000000);
            $statementTransaction = [
                'TableName' => 'Transactions',
                'Item' => [
                    'id' => array('N' => "$id"),
                    'amount' => array('N' => (string) $transaction->getAmount()),
                    'balanceAter' => array('N' => $newbalance),
                    'accountId' => array('S' => $transaction->getAccountId())
                ]
            ];

            $this->db->create($statementTransaction);

        } catch (DynamoDbException $lock) {
            if ($lock->getAwsErrorCode() == 'ConditionalCheckFailedException') return $this->debit($transaction);
        }

        return $transaction;
    }

}
