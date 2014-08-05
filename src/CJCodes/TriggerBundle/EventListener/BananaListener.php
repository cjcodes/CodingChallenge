<?php

namespace CJCodes\TriggerBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use CJCodes\PipelineBundle\PipelineEvents;
use CJCodes\PipelineBundle\Event\TrackerIncrementEvent;

class BananaListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            PipelineEvents::TRACKER_INCREMENT => array('onTrackerIncrement'),
        );
    }

    public function onTrackerIncrement(TrackerIncrementEvent $event)
    {
        if ($event->direction == 'down' && $event->tracker->getName() == 'banana') {
            // TODO
        }
    }
}
