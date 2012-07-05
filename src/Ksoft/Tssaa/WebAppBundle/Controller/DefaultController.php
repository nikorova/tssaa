<?php

namespace Ksoft\Tssaa\WebAppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
   	/**
	 * @Route("rest_test")
	 */
    public function restTestAction(){
		$req = $this->getRequest();

		$content = json_decode($req->getContent());	

        return new Response("yo mai name is: ".$content["name"]." and my job is: ".$content["occupation"]);
    }
}
