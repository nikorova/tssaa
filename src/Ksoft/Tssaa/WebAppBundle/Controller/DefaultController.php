<?php

namespace Ksoft\Tssaa\LoginBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
   	/**
	 * @Route("index"), requirements={"_method" = "POST"}, defaults={"_format" = "json"}
	 */
    public function indexAction($name)
    {
		$req = $this->getRequest();

		$content = $req->getContent();	
        return new Response($content);
    }
}
