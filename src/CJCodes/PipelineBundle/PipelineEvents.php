<?php

namespace CJCodes\PipelineBundle;

final class PipelineEvents
{
    /**
     * The tracker.increment event is fired when a tracker is
     * incremented (up or down).
     *
     * The listener receives an event of type:
     * CJCodes\PipelineBundle\Event\TrackerIncrementEvent
     */
    const TRACKER_INCREMENT = 'tracker.increment';

    /**
     * The tracker.create event is fired whenever a new tracker
     * is created.
     *
     * The listener receives an event of type:
     * CJCodes\PipelineBundle\Event\TrackerCreateEvent
     *
     * @var string
     */
    const TRACKER_CREATE = 'tracker.create';
}
