<?php

namespace Ksoft\Tssaa\WebAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="personnel")
 */
class Personnel {
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string", length=64)
	 */
	protected $name;

	/**
	 * @ORM\Column(type="string", length=16)
	 */
	protected $phone;

	/**
	 * @ORM\Column(type="string", length=64)
	 */
	protected $email;

	/**
	 * @ORM\Column(type="string", length=164)
	 */
	protected $address;

	/**
	 * @ORM\OneToOne(targetEntity="Coach", inversedBy="peronnel")
	 */
	protected $coaching_position;

	/**
	 * @ORM\OnetoMany(targetEntity="School", mappedBy="personnel")
	 */
	protected $school;
}
