<?php

namespace Ksoft\Tssaa\WebAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="sport")
 */
class Sport {
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */	
	protected $id;
	
	/**
	 * @ORM\Column(type="string", length=32)
	 */
	protected $name;

	/**
	 * @ORM\ManyToMany(targetEntity="Coach", mappedBy="sports")
	 */
	public $coaches;

	public function __construct() {
		$this->coaches = new ArrayCollection();
	}

    /**
     * Add coaches
     *
     * @param Ksoft\Tssaa\WebAppBundle\Entity\Coach $coaches
     */
    public function addCoach(\Ksoft\Tssaa\WebAppBundle\Entity\Coach $coaches)
    {
        $this->coaches[] = $coaches;
    }

    /**
     * Get coaches
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCoaches()
    {
        return $this->coaches;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
}