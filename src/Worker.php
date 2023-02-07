<?php

namespace Idanoo\Resque;

/**
 * Worker
 *
 * @author Holger Reinhardt <holger.reinhardt@aboutyou.de>
 */
class Worker
{
    /**
     * @var \Resque\Worker
     */
    private $worker;

    /**
     * @param \Resque\Worker $worker
     */
    public function __construct(\Resque\Worker $worker)
    {
        $this->worker = $worker;
    }

    /**
     * @return string
     */
    public function id()
    {
        return (string)$this->worker;
    }

    /**
     * @return bool
     */
    public function stop()
    {
        list(, $pid,) = \explode(':', $this->id());
        return \posix_kill($pid, 3);
    }

    /**
     * @return Queue[]
     */
    public function queues()
    {
        $queues = \array_map(function ($queue) {
            return new Queue($queue);
        }, $this->worker->queues());

        return $queues;
    }
}
