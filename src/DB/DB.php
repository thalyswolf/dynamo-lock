<?php

namespace App\DB;

interface DB {
    public function connect();
    public function execute();
    public function findOne();
    public function beginTransaction();
    public function endTransaction();
}