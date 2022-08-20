<?php

namespace App\Entity;

final class Account {
    
    public function __construct(
        private string $id,
        private int $balance
    )
    {}

    public function getId()
    {
        return $this->id;
    }

    public function getBalance()
    {
        return $this->balance;
    }

}