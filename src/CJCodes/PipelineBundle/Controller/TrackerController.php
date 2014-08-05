<?php

namespace CJCodes\PipelineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;

use CJCodes\PipelineBundle\Event\TrackerIncrementEvent;
use CJCodes\PipelineBundle\Event\TrackerCreateEvent;
use CJCodes\PipelineBundle\PipelineEvents;

class TrackerController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $trackers = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('CJCodesPipelineBundle:Tracker')
            ->findAll();

        return array(
            'trackers' => $trackers,
        );
    }

    /**
     * @Route("/tracker/{type}/{increment}/{direction}")
     */
    public function trackerAction($type, $increment, $direction)
    {
        // Useful variables
        $dispatcher = $this->container->get('event_dispatcher');
        $manager = $this->get('cjcodes.pipeline.tracker_manager');

        // Set the increment to + or -
        if ($direction == 'up') {
            $increment = intval($increment);
        } elseif ($direction == 'down') {
            $increment = -intval($increment);
        } else {
            return $this->generateJSON(false, 'Invalid increment direction: ' . $direction);
        }

        // Find the tracker by name
        $tracker = $manager->getTracker($type);

        // If the tracker is newly created...
        if ($tracker->isNew()) {
            // Dispatch the new tracker event
            $event = new TrackerCreateEvent($tracker);
            $dispatcher->dispatch(PipelineEvents::TRACKER_CREATE, $event);
        }

        // Do the actual increment (so simple, right?)
        $tracker->increment($increment);

        // Dispatch the increment event
        $event = new TrackerIncrementEvent($tracker, $direction);
        $dispatcher->dispatch(PipelineEvents::TRACKER_INCREMENT, $event);

        // save the tracker to the DB
        $manager->save($tracker);

        return $this->generateJSON();
    }

    /**
     * Allow a tracker to be incremented/decremented simply by passing in
     * a + or - number instead of specifying a direction.
     *
     * @Route("/tracker/{type}/{increment}")
     */
    public function trackerWithoutDirectionAction($type, $increment)
    {
        $direction = 'up';

        if (intval($increment) < 0) {
            $direction = 'down';
        }

        return $this->trackerAction($type, abs($increment), $direction);
    }

    private function generateJSON($success = true, $error = false)
    {
        $return = array('success' => $success);

        if ($error) {
            $return['error'] = $error;
        }

        return new JsonResponse($return);
    }
}
