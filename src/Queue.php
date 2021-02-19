<?php

namespace Idanoo\Resque;

/**
 * Queue
 *
 * @author Holger Reinhardt <hlgrrnhrdt@gmail.com>
 */
class Queue
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function size()
    {
        return \Resque\Resque::size($this->name);
    }

    /**
     * @return Job[]
     */
    public function jobs()
    {
        $result = \Resque\Resque::redis()->lrange('queue:' . $this->name, 0, -1);
        $jobs = [];
        foreach ($result as $job) {
            $jobs[] = (new \Resque\Job\Job($this->name, \json_decode($job, true)))->getInstance();
        }

        return $jobs;
    }
}
