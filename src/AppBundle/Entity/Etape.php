<?php

/**
 * Classe "Étape de circuit" du Modèle
 *
 * Entité du Modèle qui gère les étapes des circuits pouvant être (ou ayant pu être) organisés par l'agence de voyage
 *
 * @copyright  2015-2016 Telecom SudParis - Olivier Berger
 * @license    "MIT/X" License - cf. LICENSE file at project root
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etape
 *
 * @ORM\Table(name="etape")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EtapeRepository")
 */
class Etape
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
     * @var int
     *
     * @ORM\Column(name="numero_etape", type="smallint")
     */
    private $numeroEtape;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_etape", type="string", length=30)
     */
    private $villeEtape;

    /**
     * @var int
     *
     * @ORM\Column(name="nombre_jours", type="smallint")
     */
    private $nombreJours;

    /**
     * @ORM\ManyToOne(targetEntity="Circuit", inversedBy="etapes")
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
     * Set numeroEtape
     *
     * @param integer $numeroEtape
     *
     * @return Etape
     */
    public function setNumeroEtape($numeroEtape)
    {
        $this->numeroEtape = $numeroEtape;

        return $this;
    }

    /**
     * Get numeroEtape
     *
     * @return int
     */
    public function getNumeroEtape()
    {
        return $this->numeroEtape;
    }

    /**
     * Set villeEtape
     *
     * @param string $villeEtape
     *
     * @return Etape
     */
    public function setVilleEtape($villeEtape)
    {
        $this->villeEtape = $villeEtape;

        return $this;
    }

    /**
     * Get villeEtape
     *
     * @return string
     */
    public function getVilleEtape()
    {
        return $this->villeEtape;
    }

    /**
     * Set nombreJours
     *
     * @param integer $nombreJours
     *
     * @return Etape
     */
    public function setNombreJours($nombreJours)
    {
        $this->nombreJours = $nombreJours;

        return $this;
    }

    /**
     * Get nombreJours
     *
     * @return int
     */
    public function getNombreJours()
    {
        return $this->nombreJours;
    }

    /**
     * Set circuit
     *
     * @param \AppBundle\Entity\Circuit $circuit
     *
     * @return Etape
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
