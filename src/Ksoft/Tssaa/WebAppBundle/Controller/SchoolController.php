<?php

namespace Ksoft\Tssaa\WebAppBundle\Controller;

use Ksoft\Tssaa\WebAppBundle\Entity\School;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SchoolController extends Controller {
    
    /**
     * @Route("add_school"), requirements={"_method" = "POST"}
     */
    public function addSchoolAction() {
		$req = $this->getRequest();

		$content = array();

		try {
			$content = json_decode($req->getContent(), true);
		} catch (Exception $err) {
			$err_response = array(
				"status" => "failure",
				"exception" => $err,
				"payload" => NULL,
			);
			return new Respose(json_encode($err_response));
		}

        $school = new school();
        $school->setSchoolName($content["name"]);
        $school->setAddress($content["address"]);
        $school->setPhone($content["phone"]);
        $school->setCreated(new \DateTime());

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($school);
        $em->flush();

        $school_data = array(
			"status" => "success", 
		   	"exception" => NULL, 
			"payload" => NULL	
        );

        return new Response(json_encode($school_data));
    }

    /**
     * @Route("get_school_list"), requirements={"_method" = "GET"}
     */
    public function getSchoolList() {
        $repo = $this->getDoctrine()->getRepository('WebAppBundle:School');
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
     * @Route("update_school"), requirements={"_method" = "POST"}
     */
    public function updateSchool() {
        $req = $this->getRequest();        
		$content = array();
		
		$update_school_response = array(
			"status" => NULL,
			"exception" => NULL,
			"payload" => NULL,
		);

		try {
			$content = json_decode($req->getContent(), true);
		} catch (Exception $err) {
			$update_school_response["status"] = "failure";
			$update_school_response["exception"] = $err;
			return new Response(json_encode($update_school_response));
		}

        $em = $this->getDoctrine()->getEntityManager();

        $school = $em->getRepository('WebAppBundle:School')
            ->find($content["id"]);

        if (!$school) {
			$update_school_response["status"] = "failure";
			$update_school_response["exception"] = $this->
				createNotFoundException('No school for' . 
                $content["id"]);
			return new Response(json_encode($update_school_response));
        }

        $school->setSchoolName($content["name"]);
        $school->setAddress($content["address"]);
        $school->setPhone($content["phone"]);

		$em->flush();

		$update_school_response["status"] = "success";
        return new Response(json_encode($update_school_response));
    }
}
