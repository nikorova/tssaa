<?php

namespace Ksoft\Tssaa\WebAppBundle\Controller;

use Ksoft\Tssaa\WebAppBundle\Entity\School;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class SchoolController extends Controller {
    /**
     * @Route("get_school_list")
     */
    public function getSchoolListAction() {
        $repo = $this->getDoctrine()->getRepository("WebAppBundle:School");
        $school_objects = $repo->findAll();

        $schools = array();
        
        foreach ($school_objects as $school){
			$s = array(
				"id" =>	$school->getId(), 	
                "name" => $school->getName(), 
                "phone" => $school->getPhone(), 
				"address" => $school->getAddress()
			);

            $schools[$school->getId()] = $s;
        }

		$get_schools_response = array(
			"status" => "success",
			"exception" => NULL,
			"payload" => $schools,
		);
        return new Response(json_encode($get_schools_response));
    }

    /**
     * @Route("update_school/{id}")
	 * @Method("POST")
     */
    public function updateSchoolAction($id) {
		$fl = new \FireLogger('SchoolController');

        $reqBag = $this->getRequest()->request;        
		$content = $reqBag->get('clientData'); 
		
		
        $em = $this->getDoctrine()->getEntityManager();
        $school = $em->getRepository('WebAppBundle:School')
            ->find($id);


        $school->setSchoolName($content['name']);
        $school->setAddress($content['address']);
        $school->setPhone($content['phone']);

		$em->flush();

		$update_school_response = array(
			'status' => 'success',
			'exception' => NULL,
			'payload' => $content['name'].' updated!', 
		);

        return $update_school_response;
    }

	/**
	 * @Route("get_school_by_id/{id}")
	 * @Method("GET")
	 */
	public function getSchoolByIdAction($id) {
		$em = $this->getDoctrine()->getEntityManager();
		$school = $em->getRepository('WebAppBundle:School')
			->find($id);
		
		$response = array(
			'id'		=> $school->getId(),
			'name'		=> $school->getName(),
			'address'	=> $school->getAddress(),	
			'phone'		=> $school->getPhone(),
		);

		return $response;		
	}
}
