<?php

namespace Test;

use EzWorker\Worker\WorkerInterface;

class DependendWorker implements WorkerInterface
{
    public function execute(): void
    {
        echo 'test after test' . PHP_EOL;
    }
}