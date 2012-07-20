<?php

namespace Ksoft\Tssaa\WebAppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\Security\Core\SecurityContextInterface;

require_once('firelogger.php/firelogger.php');

class LoginController extends Controller {
	/**
	 * @Route("login"), requirements={"_method" = "POST"}
	 */
	public function loginAction(){
		$fl = new \FireLogger('LoginController');
		$token = $this->get('security.context')->getToken();

		$fl->info('le token', $token);
		$fl->info('user obj from token', $token->getUsername());

		return ($token);
	}
}
