<?php

namespace Ksoft\Tssaa\WebAppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Componenent\HttpFoundation\Request;
use Ksoft\Tssaa\WebAppBundle\Entity\Personnel;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PersonnelController extends Controller {
	/**
	 * @Route("get_personnel/{id}")
	 * @Method("GET")
	 */
	public function getPersonnelAction($id) {
		$em = $this->getDoctrine()->getEntityManager();
		$personnel = $em->getRepository('WebAppBundle:Personnel')
			->find($id);
		
		return $response = array(
			'name' 				=> $personnel->getName(),	
			'phone' 			=> $personnel->getPhone(),
			'email' 			=> $personnel->getEmail(),
			'address' 			=> $personnel->getAddress(),
			'school_id'			=> $personnel->getSchoolId(),
			'coaching_position'	=> $personnel->getCoachingPosition(),
			'school'			=> $personnel->getSchool(),
		);
	}

	/**
	 * @Route("create_personnel")
	 * @Method("POST")
	 */
	public function createPersonnelAction() {

	}

	/**
	 * @Route("update_personnel/{id}")
	 * @Method("POST")
	 */
	public function updatePersonnelAction($id) {

	}

	/**
	 * @Route("remove_personnel/{id}")
	 * @Method("GET")
	 */
	public function removePeronnelAction($id) {

	}
}
