<?php

require __DIR__ . "/../vendor/autoload.php";

$configuration = new \EzWorker\Configuration\SchedulingConfiguration();

$workerConfiguration = $configuration->addWorker(\Test\TestWorker::class);
$workerConfiguration = $configuration->addWorker(\Test\DependendWorker::class)
    ->dependsOn($workerConfiguration);
$workerConfiguration = $configuration->addWorker(\Test\WorkerWithDataProvider::class)
    ->dependsOn($workerConfiguration)
    ->dataProvider(\Test\DataProvider\TestDataProvider::class);

$test = new \EzWorker\WorkerScheduler($configuration);

$test->start();