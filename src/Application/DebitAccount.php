<?php

namespace App\Application;

use App\Entity\Transaction;
use App\Repository\AccountContract;
use stdClass;

class DebitAccount implements ApplicationContract {
    
    public function __construct(private AccountContract $accountRepository)
    {}

    public function execute(stdClass $inputBoundary): stdClass
    {
        $account = $this->accountRepository->getById($inputBoundary->accountId);
        $transaction = new Transaction($inputBoundary->amount, $account);
        $transaction = $this->accountRepository->debit($transaction);
        return new stdClass;
    }

}