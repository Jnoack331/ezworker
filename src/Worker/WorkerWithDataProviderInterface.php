<?php

namespace EzWorker\Worker;

use EzWorker\DataProvider\DataProviderInterface;

interface WorkerWithDataProviderInterface extends WorkerInterface
{
    public function __construct(DataProviderInterface $dataProvider);
}