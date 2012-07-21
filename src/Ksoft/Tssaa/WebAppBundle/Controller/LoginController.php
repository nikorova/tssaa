<?php

namespace Ksoft\Tssaa\WebAppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\Security\Core\SecurityContextInterface;

use Ksoft\Tssaa\WebAppBundle\Entity\Personnel;
use Ksoft\Tssaa\WebAppBundle\Entity\User;

class LoginController extends Controller {
	/**
	 * @Route("login")
	 */
	public function loginAction(){
		$token = $this->get('security.context')->getToken();
		
		$user = $token->getUser();
		$personnel = $user->getPersonnel();

		$userData = array(
			'id' 		=> $user->getId(),
			'username' 	=> $user->getUsername(),
			'email' 	=> $user->getEmail(),
			'isActive'	=> $user->getIsActive(),
		);

		$personnelData = array(
			'id'				=> $personnel->getId(),
			'name' 				=> $personnel->getName(),
			'phone' 			=> $personnel->getPhone(),
			'email' 			=> $personnel->getEmail(),
			'address'			=> $personnel->getAddress(),
			'coaching_position'	=> $personnel->getCoachingPosition(),
			'school'			=> $personnel->getSchoolId(),
		);
			
		return array(
			'userData' => $userData, 
			'personnelData' => $personnelData
		);	
	}
}
