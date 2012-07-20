<?php

namespace Ksoft\Tssaa\WebAppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\Security\Core\SecurityContextInterface;

use Ksoft\Tssaa\WebAppBundle\Entity\Personnel;

require_once('firelogger.php/firelogger.php');

class LoginController extends Controller {
	/**
	 * @Route("login"), requirements={"_method" = "POST"}
	 */
	public function loginAction(){
		$fl = new \FireLogger('LoginController');

		$token = $this->get('security.context')->getToken();

		$fl->log('le token', $token);
		
		$user = $token->getUser();
		$fl->log($personnel = $user->getPersonnel());
		
		$userData = array(
			'id' => $user->getId(),
			'username' => $user->getUsername(),
			'email' 	=> $user->getEmail(),
			'isActive'	=> $user->getIsActive(),
		);

		$personnelData = array(
			'id'	=> $personnel->getId(),
			'name' 	=> $personnel->getName(),
			'phone' => $personnel->getPhone(),
			'email' => $personnel->getEmail(),
			'address'	=> $personnel->getAddress(),
			'coaching_position'	=> $personnel->getCoachingPosition(),
			'school'			=> $personnel->getSchool(),
		);
			
		return array(
			'userData' => $userData, 
			'personnelData' => $personnelData
		);	
	}
}
