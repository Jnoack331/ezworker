<?php

require __DIR__ . '/../vendor/autoload.php';

use EzWorker\DataProvider\DataProviderInterface;
use EzWorker\Worker\WorkerInterface;
use EzWorker\Worker\WorkerWithDataProviderInterface;

$workerClass  = $argv[1] ?? '';
$dataProviderClass = $argv[2] ?? '';
$dataProviderArguments = $argv[3] ?? '';
$workerImplements = class_implements($workerClass) ?? [];
$dataProviderImplements = class_implements($workerClass) ?? [];

if (!class_exists($workerClass) || (class_exists($workerClass) && !in_array(WorkerInterface::class, $workerImplements))) {
    echo sprintf("Worker class '%s' does not exist.%s", $workerClass, PHP_EOL);
    exit(255);
}


if (in_array(WorkerWithDataProviderInterface::class, $workerImplements) && empty($dataProviderClass)) {
    echo sprintf("DataProvider expected but not set in configuration for worker '%s'.%s", $workerClass, PHP_EOL);
    exit(255);
} else if (in_array(WorkerWithDataProviderInterface::class, $workerImplements) && !class_exists($dataProviderClass)) {
    echo sprintf("DataProvider class '%s' does not exist for worker '%s' .%s", $dataProviderClass, $workerClass, PHP_EOL);
    exit(255);
} else if (in_array(DataProviderInterface::class, $dataProviderImplements)) {
    echo sprintf("DataProvider class '%s' does not implement DataProviderInterface for worker '%s'.%s", $dataProviderClass, $workerClass, PHP_EOL);
    exit(255);
}

if (in_array(WorkerWithDataProviderInterface::class, $workerImplements)) {
    if (!empty($dataProviderArguments)) {
        $arguments = unserialize($dataProviderArguments);
        $dataProviderClass = new $dataProviderClass($arguments);
    } else {
        $dataProviderClass = new $dataProviderClass();
    }

    /** @var WorkerInterface $worker */
    $worker = new $workerClass($dataProviderClass);
    $worker->execute();
} else {
    /** @var WorkerInterface $worker */
    $worker = new $workerClass();
    $worker->execute();
}
