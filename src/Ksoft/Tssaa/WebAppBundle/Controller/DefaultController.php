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
		$req_bag = $this->getRequest()->request;

		$content = $req_bag->get("parameter_bag_test_key");
		
        return new Response($content);
    }
}
