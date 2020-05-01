<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Etablissement
 *
 * @ORM\Table(name="etablissement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EtablissementRepository")
 * @UniqueEntity(fields="nom", message=" ce nom existe deja")
 * @UniqueEntity(fields="abreviation", message=" Cette abreviation existe deja")
 * @UniqueEntity(fields="email", message=" Cet email existe deja")
 * @UniqueEntity(fields="telephone", message=" Ce numero existe deja")
 * @UniqueEntity(fields="siteInternet", message=" Cette adresse existe deja")
 */
class Etablissement
{
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Etudiant" , mappedBy="etablissement")
     */
    private $etudiants;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Nature" , mappedBy="etablissement")
     */
    private $natures;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Universite" , inversedBy="etablissements")
     */
    private $universite;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Adresse",cascade={"persist"})
     */
    private $adresse;
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
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Le nom de l'etablissement est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "Le nom de l'etablissement est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $nom;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=255, unique=true, nullable=true)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 10,
     *      max = 70,
     *      minMessage = "L'email est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "L'email est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(name="abreviation", type="string", length=255, unique=true, nullable=true)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 2,
     *      max = 10,
     *      minMessage = "L'abreviation est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "L'abreviation est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $abreviation;

    /**
     * @var string
     * @ORM\Column(name="telephone", type="string", length=20, unique=true, nullable=true)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 8,
     *      max = 15,
     *      minMessage = "Le numero de telephone est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "Le numero de telephone est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $telephone;

    /**
     * @var string
     * @ORM\Column(name="siteInternet", type="string", length=255, unique=true, nullable=true)
     *@Assert\Length(
     *      min = 10,
     *      max = 100,
     *      minMessage = "Le nom du site internet est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "Le nom du site internet est trop long il doit avoir au plus {{ limit }} caracters"
     * )
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
     * @return Etablissement
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
     * Set email
     *
     * @param string $email
     *
     * @return Etablissement
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
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Etablissement
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
     * Set siteInternet
     *
     * @param string $siteInternet
     *
     * @return Etablissement
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
        $this->etudiants = new \Doctrine\Common\Collections\ArrayCollection();
        $this->diplomes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add etudiant
     *
     * @param \AppBundle\Entity\Etudiant $etudiant
     *
     * @return Etablissement
     */
    public function addEtudiant(\AppBundle\Entity\Etudiant $etudiant)
    {
        $this->etudiants[] = $etudiant;

        return $this;
    }

    /**
     * Remove etudiant
     *
     * @param \AppBundle\Entity\Etudiant $etudiant
     */
    public function removeEtudiant(\AppBundle\Entity\Etudiant $etudiant)
    {
        $this->etudiants->removeElement($etudiant);
    }

    /**
     * Get etudiants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtudiants()
    {
        return $this->etudiants;
    }

    /**
     * Add diplome
     *
     * @param \AppBundle\Entity\Diplome $diplome
     *
     * @return Etablissement
     */
    public function addDiplome(\AppBundle\Entity\Diplome $diplome)
    {
        $this->diplomes[] = $diplome;

        return $this;
    }

    /**
     * Remove diplome
     *
     * @param \AppBundle\Entity\Diplome $diplome
     */
    public function removeDiplome(\AppBundle\Entity\Diplome $diplome)
    {
        $this->diplomes->removeElement($diplome);
    }

    /**
     * Get diplomes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDiplomes()
    {
        return $this->diplomes;
    }

    /**
     * Set universite
     *
     * @param \AppBundle\Entity\Universite $universite
     *
     * @return Etablissement
     */
    public function setUniversite(\AppBundle\Entity\Universite $universite = null)
    {
        $this->universite = $universite;

        return $this;
    }

    /**
     * Get universite
     *
     * @return \AppBundle\Entity\Universite
     */
    public function getUniversite()
    {
        return $this->universite;
    }

    /**
     * Set adresse
     *
     * @param \AppBundle\Entity\Adresse $adresse
     *
     * @return Etablissement
     */
    public function setAdresse(\AppBundle\Entity\Adresse $adresse = null)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return \AppBundle\Entity\Adresse
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    public function __toString()
    {
        return $this->nom;
    }

    /**
     * Add nature
     *
     * @param \AppBundle\Entity\Nature $nature
     *
     * @return Etablissement
     */
    public function addNature(\AppBundle\Entity\Nature $nature)
    {
        $this->natures[] = $nature;

        return $this;
    }

    /**
     * Remove nature
     *
     * @param \AppBundle\Entity\Nature $nature
     */
    public function removeNature(\AppBundle\Entity\Nature $nature)
    {
        $this->natures->removeElement($nature);
    }

    /**
     * Get natures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNatures()
    {
        return $this->natures;
    }

    /**
     * Set abreviation
     *
     * @param string $abreviation
     *
     * @return Etablissement
     */
    public function setAbreviation($abreviation)
    {
        $this->abreviation = $abreviation;

        return $this;
    }

    /**
     * Get abreviation
     *
     * @return string
     */
    public function getAbreviation()
    {
        return $this->abreviation;
    }
}
