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
	 * @ORM\Column(type="integer")
	 */
	protected $school_id;

	/**
	 * @ORM\OneToOne(targetEntity="Coach", inversedBy="peronnel")
	 */
	protected $coaching_position;

	/**
	 * @ORM\ManyToOne(targetEntity="School", inversedBy="personnel")
	 */
	protected $school;

	/**
	 * @ORM\OneToOne(targetEntity="User", inversedBy="personnel")
	 */
	protected $user;

    public function __construct()
    {
        $this->school = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Set phone
     *
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set address
     *
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set coaching_position
     *
     * @param Ksoft\Tssaa\WebAppBundle\Entity\Coach $coachingPosition
     */
    public function setCoachingPosition(\Ksoft\Tssaa\WebAppBundle\Entity\Coach $coachingPosition)
    {
        $this->coaching_position = $coachingPosition;
    }

    /**
     * Get coaching_position
     *
     * @return Ksoft\Tssaa\WebAppBundle\Entity\Coach 
     */
    public function getCoachingPosition()
    {
        return $this->coaching_position;
    }

    /**
     * Add school
     *
     * @param Ksoft\Tssaa\WebAppBundle\Entity\School $school
     */
    public function addSchool(\Ksoft\Tssaa\WebAppBundle\Entity\School $school)
    {
        $this->school[] = $school;
    }

    /**
     * Get school
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * Set user
     *
     * @param Ksoft\Tssaa\WebAppBundle\Entity\User $user
     */
    public function setUser(\Ksoft\Tssaa\WebAppBundle\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return Ksoft\Tssaa\WebAppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set school_id
     *
     * @param integer $schoolId
     */
    public function setSchoolId($schoolId)
    {
        $this->school_id = $schoolId;
    }

    /**
     * Get school_id
     *
     * @return integer 
     */
    public function getSchoolId()
    {
        return $this->school_id;
    }

    /**
     * Set school
     *
     * @param Ksoft\Tssaa\WebAppBundle\Entity\School $school
     */
    public function setSchool(\Ksoft\Tssaa\WebAppBundle\Entity\School $school)
    {
        $this->school = $school;
    }
}