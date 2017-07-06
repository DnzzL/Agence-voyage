<?php

/**
 * Classe "Circuit" du Modèle 
 *
 * Entité du Modèle qui gère les circuits pouvant être (ou ayant pu être) organisés par l'agence de voyage
 *
 * @copyright  2015-2016 Telecom SudParis - Olivier Berger
 * @license    "MIT/X" License - cf. LICENSE file at project root
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Circuit
 *
 * @ORM\Table(name="circuit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CircuitRepository")
 */
class Circuit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="pays_depart", type="string", length=30, nullable=true)
     */
    private $paysDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_depart", type="string", length=30, nullable=true)
     */
    private $villeDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_arrivee", type="string", length=30, nullable=true)
     */
    private $villeArrivee;

    /**
     * @var int
     *
     * @ORM\Column(name="duree_circuit", type="smallint", nullable=true)
     */
    private $dureeCircuit;

    /**
     * Programmations de ce circuit
     * 
     * On définit l'association avec un orphanRemoval pour faciliter la suppression des programmations
     * 
     * @ORM\OneToMany(targetEntity="ProgrammationCircuit", mappedBy="circuit", orphanRemoval=true)
     * (Doctrine INVERSE SIDE)
     */
    protected $programmations;

    /**
     * Étapes de ce circuit
     *
     * On définit l'association avec un orphanRemoval pour faciliter la suppression des étapes
     *  
     * @ORM\OneToMany(targetEntity="Etape", 
     * 					mappedBy="circuit", orphanRemoval=true)
     * (Doctrine INVERSE SIDE)
     */
    protected $etapes;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Circuit
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set paysDepart
     *
     * @param string $paysDepart
     *
     * @return Circuit
     */
    public function setPaysDepart($paysDepart)
    {
        $this->paysDepart = $paysDepart;

        return $this;
    }

    /**
     * Get paysDepart
     *
     * @return string
     */
    public function getPaysDepart()
    {
        return $this->paysDepart;
    }

    /**
     * Set villeDepart
     *
     * @param string $villeDepart
     *
     * @return Circuit
     */
    public function setVilleDepart($villeDepart)
    {
        $this->villeDepart = $villeDepart;

        return $this;
    }

    /**
     * Get villeDepart
     *
     * @return string
     */
    public function getVilleDepart()
    {
        return $this->villeDepart;
    }

    /**
     * Set villeArrivee
     *
     * @param string $villeArrivee
     *
     * @return Circuit
     */
    public function setVilleArrivee($villeArrivee)
    {
        $this->villeArrivee = $villeArrivee;

        return $this;
    }

    /**
     * Get villeArrivee
     *
     * @return string
     */
    public function getVilleArrivee()
    {
        return $this->villeArrivee;
    }

    /**
     * Set dureeCircuit
     *
     * @param integer $dureeCircuit
     *
     * @return Circuit
     */
    public function setDureeCircuit($dureeCircuit)
    {
        $this->dureeCircuit = $dureeCircuit;

        return $this;
    }

    /**
     * Get dureeCircuit
     *
     * @return int
     */
    public function getDureeCircuit()
    {
        return $this->dureeCircuit;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->programmations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->etapes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add programmation
     *
     * @param \AppBundle\Entity\ProgrammationCircuit $programmation
     *
     * @return Circuit
     */
    public function addProgrammation(\AppBundle\Entity\ProgrammationCircuit $programmation)
    {
        $this->programmations[] = $programmation;
        
        $programmation->setCircuit($this);
        
        return $this;
    }

    /**
     * Remove programmation
     *
     * @param \AppBundle\Entity\ProgrammationCircuit $programmation
     * 
     * @return Circuit
     */
    public function removeProgrammation(\AppBundle\Entity\ProgrammationCircuit $programmation)
    {
    	if($programmation->getCircuit() != $this) {
    		return null;
    	}
    	
    	$this->programmations->removeElement($programmation);
        
        return $this;
    }

    /**
     * Get programmations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProgrammations()
    {
        return $this->programmations;
    }

    /**
     * Add etape
     *
     * @param \AppBundle\Entity\Etape $etape
     *
     * @return Circuit
     */
    public function addEtape(\AppBundle\Entity\Etape $etape)
    {
    	$dureeCircuit=$this->getDureeCircuit();
    	
    	$dureeEtape = $etape->getNombreJours();
    	
        $this->etapes[] = $etape;

        $etape->setCircuit($this);
        
        $dureeCircuit += $dureeEtape;
        $this->setDureeCircuit($dureeCircuit);
        
        return $this;
    }

    /**
     * Remove etape
     *
     * @param \AppBundle\Entity\Etape $etape
     * 
     * @return Circuit
     */
    public function removeEtape(\AppBundle\Entity\Etape $etape)
    {
    	if($etape->getCircuit() != $this) {
    		return null;
    	}
        $dureeCircuit = $this->getDureeCircuit();

        $dureeEtape = $etape->getNombreJours();
    	
       	$this->etapes->removeElement($etape);
       	// pas nécessaire car orphanRemoval
       	//$etape->setCircuit(null);
       	
        $dureeCircuit -= $dureeEtape;
        $this->setDureeCircuit($dureeCircuit);
        
        return $this;
    }

    /**
     * Get etapes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtapes()
    {
        return $this->etapes;
    }
}
