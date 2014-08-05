<?php

namespace CJCodes\PipelineBundle\Service;

use Doctrine\ORM\EntityManager;

use CJCodes\PipelineBundle\Entity\Tracker;

class TrackerManager
{
    /**
     * Doctrine's Entity Manager
     *
     * @var EntityManager
     */
    protected $em;

    /**
     * Constructor.
     *
     * @param EntityManager $em Doctrine Entity Manager
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Get a tracker. If none exist, create one, initialize it to 0, and
     * persist it to the DB.
     *
     * @param string $name The name of the tracker
     *
     * @return Tracker The tracker, named after $name
     */
    public function getTracker($name)
    {
        $tracker = $this->em->getRepository('CJCodesPipelineBundle:Tracker')
            ->find($name);

        if (!$tracker) {
            $tracker = new Tracker($name);
            $tracker->setNew();

            $this->em->persist($tracker);
            $this->em->flush();
        }

        return $tracker;
    }

    /**
     * Save a tracker. This is just a simple wrapper to automatically persist
     * and save the entity.
     *
     * @param Tracker $tracker
     */
    public function save(Tracker $tracker)
    {
        $this->em->persist($tracker);
        $this->em->flush();
    }
}
