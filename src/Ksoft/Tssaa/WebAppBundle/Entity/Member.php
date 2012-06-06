<?php

namespace Ksoft\Tssaa\WebAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="member")
 */
class Member {
		/**
		 * @ORM\Id
		 * @ORM\Column(type="integer")
		 * @ORM\GeneratedValue(strategy="AUTO")
		 */
		protected $id;

		/**
		 * @ORM\Column(type="string", length=64)
		 */
		protected $login;

		/**
		 * @ORM\Column(type="string", length=150)
		 */
		protected $email;

		/**
		 * @ORM\Column(type="datetime")
		 */
		protected $created;

		/**
		 * @ORM\Column(type="string")
		 */
		protected $pass;

		public function getId(){
				return $this->id;
		}

		public function setId($id){
				$this->id = $id;
		}

		public function getLogin(){
				return $this->login;
		}

		public function setLogin($login){
				$this->login = $login;	
		}

		public function getEmail(){
				return $this->email;
		}

		public function setEmail($email){
				$this->email = $email;
		}

		public function getCreated(){
				return $this->created;
		}

		public function setCreated($created){
				$this->created = $created;
		}

		public function getPass(){
				return $this->pass;
		}

		public function setPass($pass){
				$this->pass = $pass;
		}

}


