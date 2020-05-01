<?php

namespace AppBundle\Entity;


use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Certificat
 *
 * @ORM\Table(name="certificat")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CertificatRepository")
 * @UniqueEntity(fields="numeroCertificat", message="un autre certificat porte le meme numero !")
 */
class Certificat
{
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Etudiant" , inversedBy="certificats")
     */
    private $etudiant;
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
     * @ORM\Column(name="abreviation", type="string", length=50, unique=false)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 2,
     *      max = 20,
     *      minMessage = "L'intitule de votre certificat/diplome est court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "L'intitule de votre certificat/diplome est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $abreviation;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=255, unique=false)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 5,
     *      max = 200,
     *      minMessage = "L'intitule de votre certificat/diplome est court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "L'intitule de votre certificat/diplome est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(name="fondation", type="string", length=255, unique=false)
     *
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 2,
     *      max = 200,
     *      minMessage = "Le nom est court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "Le nom est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $fondation;

    /**
     * @var string
     *
     * @ORM\Column(name="nomeroDiplome", type="string", length=100, unique=true)
     *
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 4,
     *      max = 200,
     *      minMessage = "Le numero est court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "Le numero est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $numeroCertificat;

    /**
     * @var \DateTime
     * @ORM\Column(name="date", type="datetime")
     */
    private $dateDelivrance;

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
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Certificat
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set etudiant
     *
     * @param \AppBundle\Entity\Etudiant $etudiant
     *
     * @return Certificat
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
     * Set fondation
     *
     * @param string $fondation
     *
     * @return Certificat
     */
    public function setFondation($fondation)
    {
        $this->fondation = $fondation;

        return $this;
    }

    /**
     * Get fondation
     *
     * @return string
     */
    public function getFondation()
    {
        return $this->fondation;
    }

    /**
     * Set numeroCertificat
     *
     * @param string $numeroCertificat
     *
     * @return Certificat
     */
    public function setNumeroCertificat($numeroCertificat)
    {
        $this->numeroCertificat = $numeroCertificat;

        return $this;
    }

    /**
     * Get numeroCertificat
     *
     * @return string
     */
    public function getNumeroCertificat()
    {
        return $this->numeroCertificat;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->intitule;
    }

    /**
     * Set dateDelivrance
     *
     * @param \DateTime $dateDelivrance
     *
     * @return Certificat
     */
    public function setDateDelivrance($dateDelivrance)
    {
        $this->dateDelivrance = $dateDelivrance;

        return $this;
    }

    /**
     * Get dateDelivrance
     *
     * @return \DateTime
     */
    public function getDateDelivrance()
    {
        return $this->dateDelivrance;
    }

    /**
     * Set abreviation
     *
     * @param string $abreviation
     *
     * @return Certificat
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
