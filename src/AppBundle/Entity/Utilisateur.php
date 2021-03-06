<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as FosUser;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UtilisateurRepository")
 * @UniqueEntity(fields="nomUtiliwsateur", message="Un compte avec le meme nom existe deja !")
 * @UniqueEntity(fields="username", message="Un compte avec le meme nom utilisateur existe deja !")
 * @UniqueEntity(fields="email", message="Un compte avec le meme email existe deja !")
 * @UniqueEntity(fields="etudiant", message="Ce etudiant a un compte")
 */
class Utilisateur extends FosUser
{
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Etudiant")
     */
    private $etudiant;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Partenaire")
     */
    private $partenaire;


    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="nomUtilisateur", type="string", length=100, nullable=true)
     */
    private $nomUtiliwsateur;

    /**
     * @ORM\Column(name="facebook_id", type="integer", nullable=true)
     */
    protected $facebook_id;

    /**
     * @ORM\Column(name="facebook_acces_token", type="integer", nullable=true)
     */
    protected $facebook_access_token;

    public function __construct()
    {
        parent::__construct();
    }

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
     * Set etudiant
     *
     * @param \AppBundle\Entity\Etudiant $etudiant
     *
     * @return Utilisateur
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

    /**
     * Set nomUtiliwsateur
     *
     * @param string $nomUtiliwsateur
     *
     * @return Utilisateur
     */
    public function setNomUtiliwsateur($nomUtiliwsateur)
    {
        $this->nomUtiliwsateur = $nomUtiliwsateur;

        return $this;
    }

    /**
     * Get nomUtiliwsateur
     *
     * @return string
     */
    public function getNomUtiliwsateur()
    {
        return $this->nomUtiliwsateur;
    }

    /**
     * Set facebookId
     *
     * @param integer $facebookId
     *
     * @return Utilisateur
     */
    public function setFacebookId($facebookId)
    {
        $this->facebook_id = $facebookId;
    
        return $this;
    }

    /**
     * Get facebookId
     *
     * @return integer
     */
    public function getFacebookId()
    {
        return $this->facebook_id;
    }

    /**
     * Set facebookAccessToken
     *
     * @param integer $facebookAccessToken
     *
     * @return Utilisateur
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebook_access_token = $facebookAccessToken;
    
        return $this;
    }

    /**
     * Get facebookAccessToken
     *
     * @return integer
     */
    public function getFacebookAccessToken()
    {
        return $this->facebook_access_token;
    }

    /**
     * Set partenaire
     *
     * @param \AppBundle\Entity\Partenaire $partenaire
     *
     * @return Utilisateur
     */
    public function setPartenaire(\AppBundle\Entity\Partenaire $partenaire = null)
    {
        $this->Partenaire = $partenaire;
    
        return $this;
    }


    /**
     * Get partenaire
     *
     * @return \AppBundle\Entity\Partenaire
     */
    public function getPartenaire()
    {
        return $this->partenaire;
    }

    public function __toString()
    {
        return $this->getEmail();
    }
}
