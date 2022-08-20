<?php

namespace App\Application;

use stdClass;

interface ApplicationContract {
    public function execute(stdClass $inputBoundary): stdClass;
}