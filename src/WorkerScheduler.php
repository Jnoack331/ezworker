<?php

namespace EzWorker;

use EzWorker\Configuration\SchedulingConfiguration;
use EzWorker\Configuration\WorkerConfiguration;

class WorkerScheduler
{
    /** @var WorkerConfiguration[]  */
    protected array $executedConfigurations = [];

    private SchedulingConfiguration $configuration;
    private WorkerStarter $workerStarter;

    public function __construct(SchedulingConfiguration $configuration)
    {
        $this->workerStarter = new WorkerStarter();
        $this->configuration = $configuration;
    }

    public function start()
    {

        $workerConfigurations = $this->configuration->getWorkerConfiguration();

        while (!empty($workerConfigurations)) {
            $workerConfiguration = current($workerConfigurations);
            if ($workerConfiguration === false) {
                reset($workerConfigurations);
            }

            if (empty($workerConfiguration->getDependsOn())) {
                $this->startWorker($workerConfiguration);
                unset($workerConfigurations[key($workerConfigurations)]);
            } elseif ($this->wasConfigurationExecuted($workerConfiguration->getDependsOn())) {
                $this->startWorker($workerConfiguration);
                unset($workerConfigurations[key($workerConfigurations)]);
            } else {
                next($workerConfigurations);
            }
        }

    }

    private function startWorker(WorkerConfiguration $workerConfiguration): void
    {
        $this->workerStarter->start($workerConfiguration);
        $this->executedConfigurations[] = $workerConfiguration;
    }

    public function wasConfigurationExecuted(WorkerConfiguration $schedulingConfiguration): bool
    {
        return \in_array($schedulingConfiguration, $this->executedConfigurations);
    }
}