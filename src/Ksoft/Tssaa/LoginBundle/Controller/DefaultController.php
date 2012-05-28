<?php

namespace Ksoft\Tssaa\LoginBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
   	/**
	 * @Route("index/{name}", requirements={"_method" = "GET"}, defaults={"_format" = "json"}) 
	 */
    public function indexAction($name)
    {
#        return $this->render('KsoftTssaaLoginBundle:Default:index.html.twig', array('name' => $name));
        return new Response(json_encode( array('name' => $name)));
    }
}
