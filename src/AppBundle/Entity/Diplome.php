<?php

namespace AppBundle\Entity;

use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Diplome
 *
 * @ORM\Table(name="diplome")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DiplomeRepository")
 * @Vich\Uploadable
 * @UniqueEntity(fields="numeroDiplome", message="un autre diplome porte le meme numero !")
 *
 */
class Diplome
{
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Nature", inversedBy="diplomes")
     */
    private $nature;

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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Etudiant" , inversedBy="diplomes")
     * @ORM\JoinColumn(unique=false)
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
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
     private $fichdiplomes;

    /**
     * @Vich\UploadableField(mapping="diplomes_fichdiplomes",  fileNameProperty="fichdiplomes")
     * @var File
     */
    private $fichdiplomesFile;

    public function setFichdiplomesFile( File $fichdiplomes = null)
    {
        $this->fichdiplomesFile = $fichdiplomes;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($fichdiplomes) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getFichdiplomesFile()
    {
        return $this->fichdiplomesFile;
    }


    /**
     * @var string
     *
     * @ORM\Column(name="numeroDiplome", type="string", length=255, unique=true)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 4,
     *      max = 8,
     *      minMessage = "Le nemero  est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "Le nemero  est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */

    private $numeroDiplome;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $dateDelivrance;

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->numeroDiplome;
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
     * Set numeroDiplome
     *
     * @param string $numeroDiplome
     *
     * @return Diplome
     */
    public function setNumeroDiplome($numeroDiplome)
    {
        $this->numeroDiplome = $numeroDiplome;

        return $this;
    }

    /**
     * Get numeroDiplome
     *
     * @return string
     */
    public function getNumeroDiplome()
    {
        return $this->numeroDiplome;
    }


    /**
     * Set etudiant
     *
     * @param \AppBundle\Entity\Etudiant $etudiant
     *
     * @return Diplome
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
     * Set dateDelivrance
     *
     * @param \DateTime $dateDelivrance
     *
     * @return Diplome
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
     * Set nature
     *
     * @param \AppBundle\Entity\Nature $nature
     *
     * @return Diplome
     */
    public function setNature(\AppBundle\Entity\Nature $nature = null)
    {
        $this->nature = $nature;

        return $this;
    }

    /**
     * Get nature
     *
     * @return \AppBundle\Entity\Nature
     */
    public function getNature()
    {
        return $this->nature;
    }

    /**
     * Set fichdiplomes
     *
     * @param string $fichdiplomes
     *
     * @return Diplome
     */
    public function setFichdiplomes($fichdiplomes)
    {
        $this->fichdiplomes = $fichdiplomes;

        return $this;
    }

    /**
     * Get fichdiplomes
     *
     * @return string
     */
    public function getFichdiplomes()
    {
        return $this->fichdiplomes;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Diplome
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
}
