<?php

namespace CJCodes\PipelineBundle\Event;

use Symfony\Component\EventDispatcher\Event;

use CJCodes\PipelineBundle\Entity\Tracker;

class TrackerIncrementEvent extends Event
{
    /**
     * Tracker that is being incremented
     *
     * @var Tracker
     */
    private $tracker;

    /**
     * Direction of the tracker.
     *
     * @var string
     */
    private $direction;

    public function __construct(Tracker $tracker, $direction)
    {
        $this->tracker = $tracker;
        $this->direction = $direction;
    }

    public function __get($key)
    {
        return ($this->{$key}) ?: null;
    }
}
