<?php

namespace Ksoft\Tssaa\LoginBundle\Controller;

use Ksoft\Tssaa\LoginBundle\Entity\School;

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
}
