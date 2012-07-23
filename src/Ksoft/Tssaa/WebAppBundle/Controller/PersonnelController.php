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
		$reqBag = $this->getRequest()->request;

		$clientData = $reqBag->get('clientData');

		$personnel = new Personnel();
		$personnel->setPersonnelName($clientData['name'];
		$personnel->setPhone($clientData['phone'];
		$personnel->setAddress($clientData['address'];
		$personnel->setEmail($clientData['email'];
		$personnel->setSchoolId($clientData['school_id'];

		$em = $this->getDoctrine()->getEntityManager();
		$em->persist($personnel);
		$em->flush();

		return 'Successfully created new personnel entry.'
	}


	/**
	 * @Route("update_personnel/{id}")
	 * @Method("POST")
	 */
	public function updatePersonnelAction($id) {
		$reqBag = $this->getRequest()->request;
		$clientData = $reqBag->get('clientData');

		$em = $this->getDoctrine()->getEntityManager();

		$personnel = $em->getRepository('WebAppBundle:Personnel')
			->find($id);

		$personnel->setName($clientData['name'];
		$personnel->setPhone($clientData['phone'];
		$personnel->setAddress($clientData['address'];
		$personnel->setEmail($clientData['email'];
		$personnel->setSchoolId($clientData['school_id'];

		$em->flush();
	
		return 'Successfully updated record for ' .
			$clientData['name'];
	}

	/**
	 * @Route("remove_personnel/{id}")
	 * @Method("GET")
	 */
	public function removePeronnelAction($id) {
		$em = $this->getDoctrine()->getEntityManager();

		$personnel = $em->getRepository('WebAppBundle:Personnel')
			->find($id);

		$name = $personnel->getName();

		$em->remove($personnel);
		$em->flush();

		return 'Successfully deleted record for ' .
			$name;
	}
}
