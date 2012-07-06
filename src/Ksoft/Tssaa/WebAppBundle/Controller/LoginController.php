<?php

namespace Ksoft\Tssaa\WebAppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class LoginController extends Controller {
	/**
	 * @Route("login"), requirements={"_method" = "POST"}
	 */
	public function loginAction(){
		$logger = $this->get('logger');

		// decode json from request
		$req = $this->getRequest();
		$content = array();
		try {
			$content = json_decode($req->getContent(), true);
		} catch (Exception $err) {
			$err_response = array(
				"status" => "failure",
				"exception" => $err,
				"payload" => NULL,
			);
			return new Response(json_encode($err_response));
		}
			
		$login = $content["login"];
		$pass = $content["pass"]; 

		// log login attempts
		$logger->debug("Recieved login request:\n  Params:\n  login: $login\n  pass: $pass\n");
		
		// check against members table
		$repo = $this->getDoctrine()->getRepository('WebAppBundle:Member');

		$status = NULL;
		$exception = NULL;
		$payload = NULL;
		
		if ($result = $repo->findOneBy(array('login' => $login, 'pass' => $pass))){
			$status = "success";
			$payload = $login;
		} else { 
			$status = "failure";
			$exception = $result;
		}

		$login_response = array(
			"status" => $status,
			"exception" => empty($exception) ? NULL : $exception,
			"payload" => empty($payload) ?  NULL : $payload,
		);

		return new Response(json_encode($login_response));		
	}
}
