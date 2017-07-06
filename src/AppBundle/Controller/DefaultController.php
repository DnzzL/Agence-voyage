<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	
    	$circuits = $em->getRepository('AppBundle:Circuit')->findAll();
    	
        return $this->render('homepage.html.twig',array(
            'circuits' => $circuits,
        ));
    }
}
