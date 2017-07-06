<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Circuit;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Circuit controller.
 */
class CircuitController extends Controller {
	/**
	 * Lists all Circuit entities.
	 *
	 * @Route("/circuit", name="circuit_index")
	 * 
	 * @method ("GET")
	 */
	public function indexAction() {
		$em = $this->getDoctrine ()->getManager ();
		
		$circuits = $em->getRepository ( 'AppBundle:Circuit' )->findAll ();
		
		return $this->render ( 'circuit/index.html.twig', array (
				'circuits' => $circuits 
		) );
	}
	
	/**
	 * Finds and displays a Circuit entity.
	 *
	 * @Route("/circuit/{id}", name="circuit_show", requirements={
	 * "id": "\d+"
	 * })
	 * 
	 * @method ("GET")
	 */
	public function showAction(Circuit $circuit) {
		return $this->render ( 'circuit/show.html.twig', array (
				'circuit' => $circuit 
		) );
	}
	
	/**
	 * @Route("/circuit/new", name="circuit_new")
	 *
	 * @Route("/circuit/{id}/edit", name="circuit_edit")
	 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
	 */
	public function newAction($id = null, Request $request) {
		if ($id) {
			$circuit = $this->getDoctrine ()->getRepository ( 'AppBundle:Circuit' )->find ( $id );
			
			if (! $circuit) {
				// cause the 404 page not found to be displayed
				throw $this->createNotFoundException ();
			}
		} else {
			
			$circuit = new Circuit ();
		}
		
		$form = $this->createFormBuilder ( $circuit )->add ( 'description', TextareaType::class )->add ( 'paysDepart', TextType::class )->add ( 'villeDepart', TextType::class )->add ( 'villeArrivee', TextType::class )->add ( 'dureeCircuit', IntegerType::class )->add ( 'save', SubmitType::class, array (
				'label' => 'Valider' 
		) )->getForm ();
		
		$form->handleRequest ( $request );
		
		if ($form->isSubmitted () && $form->isValid ()) {
			
			$entityManager = $this->getDoctrine ()->getManager ();
			$entityManager->persist ( $circuit );
			
			$entityManager->flush ();
			
			// either way, display the post
			return $this->redirectToRoute ( 'circuit_show', [ 
					'id' => $circuit->getId () 
			] );
		}
		
		return $this->render ( 'backoffice/newcircuit.html.twig', [ 
				'form' => $form->createView () 
		] );
	}
	
	/**
	 * @Route("/circuit/{id}/delete", name="circuit_delete")
	 * @Security("is_granted('ROLE_ADMIN')")
	 */
	public function deleteAction($id = null, Request $request) {
		$circuit = $this->getDoctrine ()->getRepository ( 'AppBundle:Circuit' )->find ( $id );
		
		if (! $circuit) {
			// cause the 404 page not found to be displayed
			throw $this->createNotFoundException ();
		}
		
		$entityManager = $this->getDoctrine ()->getManager ();
		$entityManager->remove ( $circuit );
		$entityManager->flush ();
		
		return $this->redirectToRoute ( 'circuit_index', [ 
				'id' => $circuit->getId () 
		] );
	}
}
