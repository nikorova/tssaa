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
		// fire up the logger
		$logger = $this->get('logger');

		// get login info
		$req = Request::createFromGlobals();
		$login = $req->request->get('login');
		$pass = $req->request->get('pass');
		$logger->debug("Recieved login request:\n  Params:\n  login: $login\n  pass: $pass\n");
		
	  	
		// check against members table
		$repo = $this->getDoctrine()->getRepository('WebAppBundle:Member');
		if ($member = $repo->findOneBy(array('login' => $login, 'pass' => $pass))){
			return new Response(json_encode(array('response' => 'success', 'login' => $login, 'pass' => $pass)));
		} else { 
			return new Response(json_encode(array('response' => 'denied', 'login' => $login, 'pass' => $pass)));
		}
	
	}


	/**
	 * @Route("index/{name}", requirements={"_method" = "GET"}, defaults={"_format" = "json"}) 
	 */
    public function indexAction(){
        return new Response(json_encode( array('name' => $name)));
    }
} 
