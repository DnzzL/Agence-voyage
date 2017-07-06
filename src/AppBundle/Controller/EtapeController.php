<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Circuit;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Etape;

/**
 * Circuit controller.
 */
class EtapeController extends Controller {
	
	/**
	 * @Route("/circuit/{id}/etape/new", name="etape_new")
	 *
	 * @Route("/circuit/{id}/etape/{etapeid}/edit", name="etape_edit")
	 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
	 */
	public function newAction($id = null, $etapeid = null, Request $request) {
		$circuit = $this->getDoctrine ()->getRepository ( 'AppBundle:Circuit' )->find ( $id );
		
		if (! $circuit) {
			// cause the 404 page not found to be displayed
			throw $this->createNotFoundException ();
		}
		
		if ($etapeid) {
			$etape = $this->getDoctrine ()->getRepository ( 'AppBundle:Etape' )->find ( $etapeid );
			
			
			if (! $etape) {
				// cause the 404 page not found to be displayed
				throw $this->createNotFoundException ();
			}
		} else {
			
			$etape = new Etape ();
		}
		
		$form = $this->createFormBuilder ( $etape )->add ( 'numeroEtape', IntegerType::class )->add ( 'villeEtape', TextType::class )->add ( 'nombreJours', IntegerType::class )->add ( 'save', SubmitType::class, array (
				'label' => 'Valider' 
		) )->getForm ();
		
		$etape->setCircuit ( $circuit );
		
		$form->handleRequest ( $request );
		
		if ($form->isSubmitted () && $form->isValid ()) {
			
			$entityManager = $this->getDoctrine ()->getManager ();
			$entityManager->persist ( $etape );
			
			$entityManager->flush ();
			
			// either way, display the post
			return $this->redirectToRoute ( 'circuit_show', [ 
					'id' => $circuit->getId () 
			] );
		}
		
		return $this->render ( 'backoffice/newetape.html.twig', [ 
				'form' => $form->createView () 
		] );
	}
	
	/**
	 * @Route("/circuit/{id}/etape/{etapeid}/delete", name="etape_delete")
	 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
	 */
	public function deleteAction($id = null, $etapeid = null, Request $request) {
		$circuit = $this->getDoctrine ()->getRepository ( 'AppBundle:Circuit' )->find ( $id );
		
		if (! $circuit) {
			// cause the 404 page not found to be displayed
			throw $this->createNotFoundException ();
		}
		
		if ($etapeid) {
			$etape = $this->getDoctrine ()->getRepository ( 'AppBundle:Etape' )->find ( $etapeid );
			
			if (! $etape) {
				// cause the 404 page not found to be displayed
				throw $this->createNotFoundException ();
			}
			$entityManager = $this->getDoctrine ()->getManager ();
			$entityManager->remove ( $etape );
			$entityManager->flush();
			
		}
		return $this->redirectToRoute ( 'circuit_show', [
				'id' => $circuit->getId ()
		] );
	}
}