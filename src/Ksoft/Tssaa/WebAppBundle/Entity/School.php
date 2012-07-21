<?php

namespace Ksoft\Tssaa\WebAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="school")
 */
class School {
   
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=256)
     */
    protected $address;

    /**
     * @ORM\Column(type="string", length=16)
     */
    protected $phone; 

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;

	/**
	 * @ORM\OneToMany(targetEntity="Personnel", mappedBy="school")
	 */
	protected $personnel;

	public function __construct() {
		$this->personnel = new ArrayCollection();
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
    public function setSchoolName($name)
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
     * Set created
     *
     * @param string $created
     */
    public function setCreated($created)
    {
        $this->created= $created;
    }

    /**
     * Get created
     *
     * @return datetime
     */
    public function getCreated()
    {
        return $this->created;
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
     * Set personnel
     *
     * @param Ksoft\Tssaa\WebAppBundle\Entity\Personnel $personnel
     */
    public function setPersonnel(\Ksoft\Tssaa\WebAppBundle\Entity\Personnel $personnel)
    {
        $this->personnel = $personnel;
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
}
