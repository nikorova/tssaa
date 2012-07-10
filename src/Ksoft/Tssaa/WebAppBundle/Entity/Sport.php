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
	 * @ORM\ManyToMany(targetEntity="Coach" mappedBy="sports")
	 */
	public $coaches;

	public __contstruct() {
		$this->coaches = new ArrayCollection();
	}

	public function getId() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name; 
	}
}
