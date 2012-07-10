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

	public function getId() {
		return $this->id;
	}

	public function getPeronnel() {
		return $this->personnel;
	}

	public function setPersonnel($personnel) {
		$this->personnel = $personnel;
	}

	public function getTimeCoached() {
		return $this->time_coached;
	}

	public function setTimeCoached($time_coached) {
		$this->time_coached = $time_coached;
	}
}
