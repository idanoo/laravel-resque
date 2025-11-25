<?php

namespace Idanoo\Resque;

use RuntimeException;

/**
 * Resque
 *
 * @author Holger Reinhardt <hlgrrnhrdt@gmail.com>
 */
class Resque
{
    /**
     * @var string
     */
    protected $prefix;

    /**
     * @var bool
     */
    protected $trackStatus = false;

    /**
     * @param string $prefix
     *
     * @return Resque
     */
    public function setPrefix($prefix)
    {
        \Resque\Redis::prefix($prefix);
        return $this;
    }

    /**
     * @param Job  $job
     * @param bool $trackStatus
     *
     * @return null|\Resque\Job\Status
     */
    public function enqueueOnce(Job $job, $trackStatus = false)
    {
        return $this->enqueue($job, $trackStatus);
    }

    /**
     * @param Job  $job
     * @param bool $trackStatus
     *
     * @return null|\Resque_Job_Status
     */
    public function enqueue(Job $job, $trackStatus = false)
    {
        $id = \Resque\Resque::enqueue($job->queue(), $job->name(), $job->arguments(), $trackStatus);

        if (true === $trackStatus) {
            return new \Resque\Job\Status($id);
        }

        return null;
    }

    /**
     * @return \Resque\Redis
     */
    public function redis()
    {
        return \Resque\Resque::redis();
    }

    /**
     * @return int
     *
     * @throws RuntimeException
     */
    public function fork()
    {
        return \Resque\Resque::fork();
    }
}
