<?php

namespace Ksoft\Tssaa\WebAppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Ksoft\Tssaa\WebAppBundle\Entity\Member;

class MemberController extends Controller {
		/**
		 * @Route("add_user"), requirements={"_method" = "POST"}
		 */
		public function addUserAction() {
	    		$logger = $this->get('logger');
		
				$req = Request::createFromGlobals()->request;

				$member = new member();
				$member->setLogin($req->get('login'));
				$member->setEmail($req->get('email'));
			    $member->setPass($req->get('pass'));	
				$member->setCreated(new \DateTime());
				
				$em = $this->getDoctrine()->getEntityManager();	
				$em->persist($member);
				$em->flush();
            
                $member_data = array(
                    "login" => $member->getLogin(),
                    "email" => $member->getEmail(),
                    "pass" => $member->getPass(),
                );

				return new Response(json_encode($member_data));
		}
}
