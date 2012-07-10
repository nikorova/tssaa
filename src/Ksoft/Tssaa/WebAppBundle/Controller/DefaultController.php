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
		// get the request parameter bag from the Request object
		$req_bag = $this->getRequest()->request;

		$content = $req_bag->get("client_data");

		// if command prop is present and == barf, then barf
		if ($i = $content["command"]) {
			if ($i == "barf") {
				throw new \Exception("AH MAI GAWD", $code = 9001);	
			}
		}
		
        return $content;
    }
}
