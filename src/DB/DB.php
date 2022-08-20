<?php

namespace App\DB;

interface DB {
    public function connect();
    public function update(array $statement);
    public function findOne(array $statement);
    public function beginTransaction();
    public function endTransaction();
}