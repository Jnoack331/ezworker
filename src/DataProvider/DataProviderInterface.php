<?php

namespace EzWorker\DataProvider;

interface DataProviderInterface
{
    public function __construct(mixed $configuration);
    public function getData(): mixed;
}