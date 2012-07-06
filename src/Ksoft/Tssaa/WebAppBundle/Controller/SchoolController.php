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
			return new Respose($err);
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
            $id = $school->getId();
            $name = $school->getName();
            $address = $school->getAddress();
            $phone = $school->getPhone();

            $s = array("id" => $id, 
                "name" => $name, 
                "phone" => $phone, 
                "address" => $address);

            $schools[$id] = $s;
        }
        return new Response(json_encode($schools));
    }

    /**
     * @Route("update_school"), requirements={"_method" = "POST"}
     */
    public function updateSchool() {
        $request = Request::createFromGlobals();
        
        // id, name, address, phone
        $em = $this->getDoctrine()->getEntityManager();

        $school = $em->getRepository('WebAppBundle:School')
            ->find($request->get('id'));

        if (!$school) {
            throw $this->createNotFoundException('No school for' . 
                $request->get('id'));
        }

        $school->setSchoolName($request->get('name'));
        $school->setAddress($request->get('address'));
        $school->setPhone($request->get('phone'));

        $em->flush();
        return new Response(json_encode(array('status' => 'success')));
    }
}
