<?php

namespace spec\EzWorker;

use EzWorker\WorkerScheduler;
use PhpSpec\ObjectBehavior;

class WorkerSchedulerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(WorkerScheduler::class);
    }
}
