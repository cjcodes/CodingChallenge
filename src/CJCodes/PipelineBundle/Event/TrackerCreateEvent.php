<?php

namespace CJCodes\PipelineBundle\Event;

use Symfony\Component\EventDispatcher\Event;

use CJCodes\PipelineBundle\Entity\Tracker;

class TrackerCreateEvent extends Event
{
    /**
     * The tracker that was created.
     *
     * @var Tracker
     */
    private $tracker;

    public function __construct(Tracker $tracker)
    {
        $this->tracker = $tracker;
    }

    public function __get($key)
    {
        return ($this->{$key}) ?: null;
    }
}
