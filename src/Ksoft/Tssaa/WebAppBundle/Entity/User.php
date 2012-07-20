<?php

namespace Ksoft\Tssaa\WebAppBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User implements UserInterface {
	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=64, unique=true)
	 */
	private $username;

	/**
	 * @ORM\Column(type="string", length=64, unique=true)
	 */
	private $email;

	/**
	 * @ORM\Column(type="string", length=32)
	 */
	private $salt;

	/**
	 * @ORM\Column(type="string", length=64)
	 */
	private $password;

	/**
	 * @ORM\Column(name="is_active", type="boolean")
	 */
	private $isActive;

	/**
	 * @ORM\OneToOne(targetEntity="Personnel", mappedBy="user")
	 */
	protected $personnel;

	public function __construct() {
		$this->isActive = true;
		$this->salt = md5(uniqid(null, true));
	}

	/**
	 * @inheritDoc
	 */
	public function getSalt() {
		return $this->salt;
	}
	
	/**
	 * @inheritDoc
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @inheritDoc
	 */
	public function getRoles() {
		return array('ROLE_USER');
	}

	/**
	 * @inheritDoc
	 */
	public function eraseCredentials() {

	}

	/**
	 * @inheritDoc
	 */
	public function equals(UserInterface $user) {
		return $this->username === $user->getUsername();
	}

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     */
    public function setUsername($username) {
        $this->username = $username;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set salt
     *
     * @param string $salt
     */
    public function setSalt($salt) {
        $this->salt = $salt;
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     */
    public function setIsActive($isActive) {
        $this->isActive = $isActive;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive() {
        return $this->isActive;
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