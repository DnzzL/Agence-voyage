<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller {
	/**
	 * @Route("/contact", name="contact")
	 */
	public function nouveautesIndexAction(Request $request) {
		return $this->render ( 'contact/index.html.twig' );
	}
}