<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Nature
 *
 * @ORM\Table(name="nature")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NatureRepository")
 *  @UniqueEntity(fields="intitule", message="un(e) Cette formation existe deja")
 *  @UniqueEntity(fields="abreviation", message="un(e) Cette abreviation existe deja")
 */
class Nature
{
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Etablissement" , inversedBy="natures")
     */
    private $etablissement;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Diplome" , mappedBy="nature")
     */
    private $diplomes;

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
     * @ORM\Column(name="intitule", type="string", length=100, unique=true)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 5,
     *      max = 70,
     *      minMessage = "Le nom est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "Le nom est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(name="abreviation", type="string", length=50, unique=true)
     * @ORM\Column(name="intitule", type="string", length=100, unique=true)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 5,
     *      max = 70,
     *      minMessage = "Le nom est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "Le nom est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $abreviation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="date")
     */
    private $dateCreation;

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->intitule;
    }

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
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Nature
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
     * Set abreviation
     *
     * @param string $abreviation
     *
     * @return Nature
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

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Nature
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set etablissement
     *
     * @param \AppBundle\Entity\Etablissement $etablissement
     *
     * @return Nature
     */
    public function setEtablissement(\AppBundle\Entity\Etablissement $etablissement = null)
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    /**
     * Get etablissement
     *
     * @return \AppBundle\Entity\Etablissement
     */
    public function getEtablissement()
    {
        return $this->etablissement;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->diplomes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add diplome
     *
     * @param \AppBundle\Entity\Diplome $diplome
     *
     * @return Nature
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
}
