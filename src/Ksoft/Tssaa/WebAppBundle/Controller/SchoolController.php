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
        $logger = $this->get('logger');
        
        $req = Request::createFromGlobals()->request;
        
        $school = new school();
        $school->setSchoolName($req->get('name'));
        $school->setAddress($req->get('address'));
        $school->setPhone($req->get('phone'));
        $school->setCreated(new \DateTime());

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($school);
        $em->flush();

        $school_data = array(
            "name" => $school->getName(),
            "address" => $school->getAddress(),
            "phone" => $school->getPhone(),
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
}
