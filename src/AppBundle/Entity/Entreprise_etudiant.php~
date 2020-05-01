<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entreprise_etudiant
 *
 * @ORM\Table(name="entreprise_etudiant")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Entreprise_etudiantRepository")
 */
class Entreprise_etudiant
{

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Entreprise" , inversedBy="entrepriseEtudiants")
     */
    private $entreprise;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Etudiant" , inversedBy="entrepriseEtudiants")
     */
    private $etudiant;

    /**
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
     * @ORM\Column(name="poste", type="string", length=255)
     */
    private $poste;

    /**
     * @var string
     *
     * @ORM\Column(name="duree", type="string", length=255)
     */
    private $duree;

    /**
     * @var string
     *
     * @ORM\Column(name="type_contrat", type="string", length=100)
     */
    private $typeContrat;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set poste
     *
     * @param string $poste
     *
     * @return Entreprise_etudiant
     */
    public function setPoste($poste)
    {
        $this->poste = $poste;
    
        return $this;
    }

    /**
     * Get poste
     *
     * @return string
     */
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * Set duree
     *
     * @param string $duree
     *
     * @return Entreprise_etudiant
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;
    
        return $this;
    }

    /**
     * Get duree
     *
     * @return string
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set typeContrat
     *
     * @param string $typeContrat
     *
     * @return Entreprise_etudiant
     */
    public function setTypeContrat($typeContrat)
    {
        $this->typeContrat = $typeContrat;
    
        return $this;
    }

    /**
     * Get typeContrat
     *
     * @return string
     */
    public function getTypeContrat()
    {
        return $this->typeContrat;
    }

    /**
     * Set champs
     *
     * @param string $champs
     *
     * @return Entreprise_etudiant
     */

    /**
     * Set entreprise
     *
     * @param \AppBundle\Entity\entreprise $entreprise
     *
     * @return Entreprise_etudiant
     */
    public function setEntreprise(\AppBundle\Entity\entreprise $entreprise = null)
    {
        $this->entreprise = $entreprise;
    
        return $this;
    }

    /**
     * Get entreprise
     *
     * @return \AppBundle\Entity\entreprise
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }

    /**
     * Set etudiant
     *
     * @param \AppBundle\Entity\Etudiant $etudiant
     *
     * @return Entreprise_etudiant
     */
    public function setEtudiant(\AppBundle\Entity\Etudiant $etudiant = null)
    {
        $this->etudiant = $etudiant;
    
        return $this;
    }

    /**
     * Get etudiant
     *
     * @return \AppBundle\Entity\Etudiant
     */
    public function getEtudiant()
    {
        return $this->etudiant;
    }
}
