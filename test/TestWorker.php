<?php

namespace Test;

use EzWorker\DataProvider\DataProviderInterface;
use EzWorker\Worker\WorkerInterface;

class TestWorker implements WorkerInterface
{
    public function execute(): void
    {
        echo 'test' . PHP_EOL;
    }
}