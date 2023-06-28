<?php

namespace Test;

use EzWorker\DataProvider\DataProviderInterface;
use EzWorker\Worker\WorkerWithDataProviderInterface;

class WorkerWithDataProvider implements WorkerWithDataProviderInterface
{
    public function __construct(DataProviderInterface $dataProvider)
    {
        var_dump($dataProvider->getData());
    }

    public function execute(): void
    {
        echo 'test after test' . PHP_EOL;
    }
}