<?php

namespace EzWorker;

use EzWorker\Configuration\WorkerConfiguration;
use EzWorker\DataProvider\DataProviderInterface;
use EzWorker\Worker\WorkerWithDataProviderInterface;

class WorkerStarter
{
    public function start(WorkerConfiguration $workerConfiguration)
    {
        $workerClass = $workerConfiguration->getWorkerClass();
        if (!class_exists($workerClass)) {
            throw new \RuntimeException(sprintf("Worker class %s does not exist.%s", $workerClass, PHP_EOL));
        }

        $dataProviderConfiguration = serialize(['test']);
        $dataProviderClass = $workerConfiguration->getDataProvider();
        $command = sprintf("php %s/../bin/worker.php '%s' '%s' '%s'", __DIR__, $workerClass, $dataProviderClass, $dataProviderConfiguration);

        $descriptorspec = [
            0 => ["pipe", "r"],
            1 => ["pipe", "w"],
            2 => ["pipe", "a"]
        ];

        $process = proc_open($command, $descriptorspec, $pipes);
    }
}