<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"partenaire" = "Partenaire", "entreprise" = "Entreprise"})
 * @UniqueEntity("nom", message="Un partenaire avec le meme nom existe.")
 * @UniqueEntity("email", message="Un partenaire avec le meme email existe")
 * @UniqueEntity("email", message="Un partenaire avec le mumero de telephone existe")
 * @UniqueEntity("email", message="Un partenaire avec le meme site existe")
 * EntrepriseSuper
 */
abstract class EntrepriseSuper
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="nom", type="string", length=255, unique=false)
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
     * @ORM\Column(name="ville", type="string", length=255, unique=false)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 3,
     *      max = 70,
     *      minMessage = "Le nom de la ville est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "Le nom de la ville est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255, unique=false)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 3,
     *      max = 70,
     *      minMessage = "Le nom du pays est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "Le nom du pats est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, unique=false)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 3,
     *      max = 70,
     *      minMessage = "Le type est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "Le type est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $type;



    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=20, unique=true)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 8,
     *      max = 20,
     *      minMessage = "Le nemero est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "Le nemero est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 8,
     *      max = 100,
     *      minMessage = "L'email est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "L'email est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(name="domaine", type="string", length=255, unique=false)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 5,
     *      max = 100,
     *      minMessage = "Le domaine est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "Le domaine est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $domaine;

    /**
     * @var string
     *
     * @ORM\Column(name="site_internet", type="string", length=255, unique=false)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 3,
     *      max = 200,
     *      minMessage = "Le site est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "Le site est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $siteInternet;

    /**
     * @var string
     *
     * @ORM\Column(name="status_entreprise", type="string", length=255, unique=false)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 2,
     *      max = 200,
     *      minMessage = "Le status est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "Le status est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $statusEntreprise;



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
     * Set nom
     *
     * @param string $nom
     *
     * @return EntrepriseSuper
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
     * Set ville
     *
     * @param string $ville
     *
     * @return EntrepriseSuper
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
     * Set type
     *
     * @param string $type
     *
     * @return EntrepriseSuper
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return EntrepriseSuper
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
     * @return EntrepriseSuper
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
     * Set domaine
     *
     * @param string $domaine
     *
     * @return EntrepriseSuper
     */
    public function setDomaine($domaine)
    {
        $this->domaine = $domaine;
    
        return $this;
    }

    /**
     * Get domaine
     *
     * @return string
     */
    public function getDomaine()
    {
        return $this->domaine;
    }

    /**
     * Set siteInternet
     *
     * @param string $siteInternet
     *
     * @return EntrepriseSuper
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
     * Set statusEntreprise
     *
     * @param string $statusEntreprise
     *
     * @return EntrepriseSuper
     */
    public function setStatusEntreprise($statusEntreprise)
    {
        $this->statusEntreprise = $statusEntreprise;
    
        return $this;
    }

    /**
     * Get statusEntreprise
     *
     * @return string
     */
    public function getStatusEntreprise()
    {
        return $this->statusEntreprise;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return EntrepriseSuper
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
}
