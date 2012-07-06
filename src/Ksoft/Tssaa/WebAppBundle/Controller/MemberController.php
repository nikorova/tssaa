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
		
				$req = $this->getRequest();
				$content = array();
				try {
					$content = json_decode($reg->getContent(), true);
				} catch (Exception $err) {
					$err_response = array(
						"status" => "failure",
						"exception" => $err,
						"payload" => NULL,
					);
					return new Response(json_encode($err_response));
				}

				$member = new member();
				$member->setLogin($content["login"]);
				$member->setEmail($content["email"]);
			    $member->setPass($content["pass"]);	
				$member->setCreated(new \DateTime());
				
				$em = $this->getDoctrine()->getEntityManager();	
				$em->persist($member);
				$em->flush();
            
				$member_response = array(
					"status" => "success", 
					"payload" => $content["login"],
					"exception" => NULL,
				);
				return new Response(json_encode($member_response));
		}
}
