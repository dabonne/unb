<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Partenaire
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PartenaireRepository")
 * @UniqueEntity(fields="nom", message="Une entreprise du meme nom existe !")
 */
class Partenaire extends EntrepriseSuper
{
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Utilisateur")
     */
    private $user;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_convention", type="date", nullable=false)
     */
    private $dateConvention;


    /**
     * Set dateConvention
     *
     * @param \DateTime $dateConvention
     *
     * @return Partenaire
     */
    public function setDateConvention($dateConvention)
    {
        $this->dateConvention = $dateConvention;
    
        return $this;
    }

    /**
     * Get dateConvention
     *
     * @return \DateTime
     */
    public function getDateConvention()
    {
        return $this->dateConvention;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\Utilisateur $user
     *
     * @return Partenaire
     */
    public function setUser(\AppBundle\Entity\Utilisateur $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\Utilisateur
     */
    public function getUser()
    {
        return $this->user;
    }

    public function __toString()
    {
        return $this->getEmail();
    }
}
