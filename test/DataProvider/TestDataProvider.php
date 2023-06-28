<?php

namespace Test\DataProvider;

use EzWorker\DataProvider\DataProviderInterface;

class TestDataProvider implements DataProviderInterface
{
    public function __construct(mixed $configuration)
    {
    }

    public function getData(): mixed
    {
        return array_fill(0, 10, 'test');
    }
}