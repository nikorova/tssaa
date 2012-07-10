<?php

namespace Ksoft\Tssaa\WebAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="coach")
 */
class Coach {
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\OneToOne(targetEntity="Personnel", mappedBy="coaching_position")
	 */
	protected $personnel;

	/**
	 * @ORM\ManyToMany(targetEntity="Sport", inversedBy="coaches")
	 */
	protected $sports;

	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $time_coached;
	
	public function __construct() {
		$this->sports = new ArrayCollection();
	}

    /**
     * Get personnel
     *
     * @return Ksoft\Tssaa\WebAppBundle\Entity\Personnel 
     */
    public function getPersonnel()
    {
        return $this->personnel;
    }

    /**
     * Add sports
     *
     * @param Ksoft\Tssaa\WebAppBundle\Entity\Sport $sports
     */
    public function addSport(\Ksoft\Tssaa\WebAppBundle\Entity\Sport $sports)
    {
        $this->sports[] = $sports;
    }

    /**
     * Get sports
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSports()
    {
        return $this->sports;
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
     * Set time_coached
     *
     * @param datetime $timeCoached
     */
    public function setTimeCoached($timeCoached)
    {
        $this->time_coached = $timeCoached;
    }

    /**
     * Get time_coached
     *
     * @return datetime 
     */
    public function getTimeCoached()
    {
        return $this->time_coached;
    }

    /**
     * Set personnel
     *
     * @param Ksoft\Tssaa\WebAppBundle\Entity\Personnel $personnel
     */
    public function setPersonnel(\Ksoft\Tssaa\WebAppBundle\Entity\Personnel $personnel)
    {
        $this->personnel = $personnel;
    }
}