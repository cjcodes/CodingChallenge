<?php

namespace CJCodes\PipelineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tracker
 *
 * @ORM\Table(name="tracker")
 * @ORM\Entity
 */
class Tracker
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string")
     * @ORM\Id
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="value", type="integer")
     */
    private $value;

    /**
     * Whether or not this is a newly created tracker.
     *
     * @var boolean
     */
    private $new = false;


    /**
     * Create a new Tracker.
     *
     * @param string $name The name of the tracker (also ID)
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->value = 0;
    }

    /**
     * Convert this tracker to a string.
     *
     * @return string The string representation of this tracker (name)
     */
    public function __toString()
    {
        return $this->name . ': ' . $this->getValue();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set value
     *
     * @param integer $value
     * @return Tracker
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Increment the value
     *
     * @param int $value
     * @return Tracker
     */
    public function increment($value)
    {
        $this->value += $value;

        return $this;
    }

    /**
     * Flag this tracker as new.
     *
     * @return Tracker
     */
    public function setNew()
    {
        $this->new = true;
    }

    /**
     * Check if this is a new tracker.
     *
     * @return boolean
     */
    public function isNew()
    {
        return $this->new;
    }
}
