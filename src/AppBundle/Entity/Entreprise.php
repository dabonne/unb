<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Entreprise
 *
 * @ORM\Table(name="entreprise")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EntrepriseRepository")
 */
class Entreprise
{

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Entreprise_etudiant" , mappedBy="entreprises")
     */
    private $entrepriseEtudiants;

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
     * @ORM\Column(name="nom", type="string", length=255, unique=false)
     *
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 5,
     *      max = 70,
     *      minMessage = "Le nom est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "Le nom est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255, unique=false)
     *
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 5,
     *      max = 100,
     *      minMessage = "Le nom est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "Le nom est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, unique=false)
     *
     * @ORM\Column(name="intitule", type="string", length=100, unique=true)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 5,
     *      max = 70,
     *      minMessage = "Le nom de la ville est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "Le nom de la ville est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="codePostal", type="string", length=255, nullable=true)
     *
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=20, unique=true)
     *
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 8,
     *      max = 15,
     *      minMessage = "Le numero est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "Le numero est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="siteInternet", type="string", length=255, unique=false, nullable=true)
     */
    private $siteInternet;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Entreprise
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Entreprise
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Entreprise
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }
    /**
     * Set codePostal
     *
     * @param string $codePostal
     *
     * @return Entreprise
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Entreprise
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Entreprise
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set siteInternet
     *
     * @param string $siteInternet
     *
     * @return Entreprise
     */
    public function setSiteInternet($siteInternet)
    {
        $this->siteInternet = $siteInternet;

        return $this;
    }

    /**
     * Get siteInternet
     *
     * @return string
     */
    public function getSiteInternet()
    {
        return $this->siteInternet;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->entreprise_etudiant = new \Doctrine\Common\Collections\ArrayCollection();
    }





    /**
     * Add entrepriseEtudiant
     *
     * @param \AppBundle\Entity\Entreprise_etudiant $entrepriseEtudiant
     *
     * @return Entreprise
     */
    public function addEntrepriseEtudiant(\AppBundle\Entity\Entreprise_etudiant $entrepriseEtudiant)
    {
        $this->entrepriseEtudiants[] = $entrepriseEtudiant;
    
        return $this;
    }

    /**
     * Remove entrepriseEtudiant
     *
     * @param \AppBundle\Entity\Entreprise_etudiant $entrepriseEtudiant
     */
    public function removeEntrepriseEtudiant(\AppBundle\Entity\Entreprise_etudiant $entrepriseEtudiant)
    {
        $this->entrepriseEtudiants->removeElement($entrepriseEtudiant);
    }

    /**
     * Get entrepriseEtudiants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntrepriseEtudiants()
    {
        return $this->entrepriseEtudiants;
    }
}
