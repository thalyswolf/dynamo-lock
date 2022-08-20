<?php

namespace App\Entity;

use DomainException;

final class Transaction {
    
    public function __construct(
        private int $amount,
        private Account $account
    )
    {
        if ($amount < 0) throw new DomainException("The negative value is not allowed in transaction amount");
    }

}