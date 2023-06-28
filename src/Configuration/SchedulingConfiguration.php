<?php

namespace EzWorker\Configuration;

class SchedulingConfiguration
{
    /** @var WorkerConfiguration[] $workerConfigurations */
    private array $workerConfigurations = [];

    public function addWorker(string $workerClass): WorkerConfiguration
    {
        $workerConfiguration = new WorkerConfiguration($workerClass);
        $this->workerConfigurations[] = $workerConfiguration;
        return $workerConfiguration;
    }

    public function getWorkerConfiguration(): array
    {
        return $this->workerConfigurations;
    }
}