<?php

namespace Ksoft\Tssaa\WebAppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
   	/**
	 * @Route("index")
	 */
    public function indexAction($name)
    {
		$req = $this->getRequest();

		$content = $req->getContent();	
        return new Response($content);
    }
}
