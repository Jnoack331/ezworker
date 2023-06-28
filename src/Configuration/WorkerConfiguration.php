<?php

namespace EzWorker\Configuration;

class WorkerConfiguration
{
    private ?WorkerConfiguration $dependsOn = null;
    private string $dataProvider = '';
    private string $workerClass = '';

    public function __construct(string $workerClass)
    {
        $this->workerClass = $workerClass;
    }

    public function dependsOn(WorkerConfiguration $workerConfiguration): self
    {
        $this->dependsOn = $workerConfiguration;
        return $this;
    }

    public function dataProvider(string $providerClass): self
    {
        $this->dataProvider = $providerClass;
        return $this;
    }

    public function getDependsOn(): ?WorkerConfiguration
    {
        return $this->dependsOn;
    }

    public function getDataProvider(): string
    {
        return $this->dataProvider;
    }

    public function getWorkerClass(): string
    {
        return $this->workerClass;
    }
}