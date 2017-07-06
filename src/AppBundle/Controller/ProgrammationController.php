<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Circuit;
use AppBundle\Entity\ProgrammationCircuit;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Circuit controller.
 */
class ProgrammationController extends Controller {
	
	/**
	 * @Route("/circuit/{id}/prog/new", name="prog_new")
	 *
	 * @Route("/circuit/{id}/prog/{progid}/edit", name="prog_edit")
	 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
	 */
	public function newAction($id = null, $progid = null, Request $request) {
		$circuit = $this->getDoctrine ()->getRepository ( 'AppBundle:Circuit' )->find ( $id );
		
		if (! $circuit) {
			// cause the 404 page not found to be displayed
			throw $this->createNotFoundException ();
		}
		
		if ($progid) {
			$prog = $this->getDoctrine ()->getRepository ( 'AppBundle:ProgrammationCircuit' )->find ( $progid );
			
			
			if (! $prog) {
				// cause the 404 page not found to be displayed
				throw $this->createNotFoundException ();
			}
		} else {
			
			$prog = new ProgrammationCircuit();
		}
		
		$form = $this->createFormBuilder ( $prog )
		->add ( 'dateDepart', DateType::class )
		->add ( 'nombrePersonnes', IntegerType::class )
		->add ( 'prix', IntegerType::class )
		->add ( 'save', SubmitType::class, array (
				'label' => 'Valider' 
		) )->getForm ();
		
		$prog->setCircuit ( $circuit );
		
		$form->handleRequest ( $request );
		
		if ($form->isSubmitted () && $form->isValid ()) {
			
			$entityManager = $this->getDoctrine ()->getManager ();
			$entityManager->persist ( $prog );
			
			
			$entityManager->flush ();
			
			// either way, display the post
			return $this->redirectToRoute ( 'circuit_show', [ 
					'id' => $circuit->getId () 
			] );
		}
		
		return $this->render ( 'backoffice/newprog.html.twig', [ 
				'form' => $form->createView () 
		] );
	}
	
	/**
	 * @Route("/circuit/{id}/prog/{progid}/delete", name="prog_delete")
	 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
	 */
	public function deleteAction($id = null, $progid = null, Request $request) {
		$circuit = $this->getDoctrine ()->getRepository ( 'AppBundle:Circuit' )->find ( $id );
		
		if (! $circuit) {
			// cause the 404 page not found to be displayed
			throw $this->createNotFoundException ();
		}
		
		if ($progid) {
			$prog = $this->getDoctrine ()->getRepository ( 'AppBundle:ProgrammationCircuit' )->find ( $progid );
			
			if (! $prog) {
				// cause the 404 page not found to be displayed
				throw $this->createNotFoundException ();
			}
			$entityManager = $this->getDoctrine ()->getManager ();
			$entityManager->remove ( $prog );
			$entityManager->flush();
			
		}
		return $this->redirectToRoute ( 'circuit_show', [
				'id' => $circuit->getId ()
		] );
	}
}