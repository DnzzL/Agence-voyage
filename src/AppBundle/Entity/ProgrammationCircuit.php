<?php

/**
 * Classe "Programmation d'un Circuit" du Modèle
 *
 * Entité du Modèle qui gère les programmations de circuits faites (ou ayant été faites) par l'agence de voyage
 *
 * @copyright  2015-2016 Telecom SudParis - Olivier Berger
 * @license    "MIT/X" License - cf. LICENSE file at project root
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProgrammationCircuit
 *
 * @ORM\Table(name="programmation_circuit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProgrammationCircuitRepository")
 */
class ProgrammationCircuit
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_depart", type="date")
     */
    private $dateDepart;

    /**
     * @var int
     *
     * @ORM\Column(name="nombre_personnes", type="smallint")
     */
    private $nombrePersonnes;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="smallint")
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity="Circuit", inversedBy="programmations")
     * (Doctrine OWNING SIDE)
     * @ORM\JoinColumn(name="circuit_id", referencedColumnName="id")
     */
    protected $circuit;

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
     * Set dateDepart
     *
     * @param \DateTime $dateDepart
     *
     * @return ProgrammationCircuit
     */
    public function setDateDepart($dateDepart)
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    /**
     * Get dateDepart
     *
     * @return \DateTime
     */
    public function getDateDepart()
    {
        return $this->dateDepart;
    }

    /**
     * Set nombrePersonnes
     *
     * @param integer $nombrePersonnes
     *
     * @return ProgrammationCircuit
     */
    public function setNombrePersonnes($nombrePersonnes)
    {
        $this->nombrePersonnes = $nombrePersonnes;

        return $this;
    }

    /**
     * Get nombrePersonnes
     *
     * @return int
     */
    public function getNombrePersonnes()
    {
        return $this->nombrePersonnes;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return ProgrammationCircuit
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set circuit
     *
     * @param \AppBundle\Entity\Circuit $circuit
     *
     * @return ProgrammationCircuit
     */
    public function setCircuit(\AppBundle\Entity\Circuit $circuit = null)
    {
        $this->circuit = $circuit;

        return $this;
    }

    /**
     * Get circuit
     *
     * @return \AppBundle\Entity\Circuit
     */
    public function getCircuit()
    {
        return $this->circuit;
    }
}
