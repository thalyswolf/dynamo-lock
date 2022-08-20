<?php

namespace App\Repository;

use App\Entity\Account;
use App\Entity\Transaction;

interface AccountContract {
    public function getById(string $id): Account;
    public function debit(Transaction $transaction): Transaction;
}
