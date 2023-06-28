<?php

namespace EzWorker\Worker;

interface WorkerInterface
{
    public function execute(): void;
}