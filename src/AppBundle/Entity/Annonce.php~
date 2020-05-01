<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Annonce
 *
 * @ORM\Table(name="annonce")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AnnonceRepository")
 * @Vich\Uploadable
 */
class Annonce
{
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Nature",cascade={"persist"})
     */
    private $natures;

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
     * @ORM\Column(name="intitule", type="string", length=255)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 2,
     *      max = 240,
     *      minMessage = "L'objet est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "L'objet matricule est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(name="information", type="text", nullable=true)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 5,
     *      max = 5000,
     *      minMessage = "L'information est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "L'information est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $information;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string",length=10, nullable=true)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date", nullable=true)
     */
    private $dateFin;



    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $piece;

    /**
     * @Vich\UploadableField(mapping="annonces_pieces", fileNameProperty="piece")
     * @var File
     */
    private $pieceFile;

    public function setPieceFile(File $piece = null)
    {
        $this->pieceFile = $piece;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($piece) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getPieceFile()
    {
        return $this->pieceFile;
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

    public function __construct()
    {
        $this->date = new \DateTime('now');
        $this->natures = new ArrayCollection();
    }


    /**
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Annonce
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
     * Set information
     *
     * @param string $information
     *
     * @return Annonce
     */
    public function setInformation($information)
    {
        $this->information = $information;

        return $this;
    }

    /**
     * Get information
     *
     * @return string
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Annonce
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Annonce
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Annonce
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Add nature
     *
     * @param \AppBundle\Entity\Nature $nature
     *
     * @return Annonce
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
     * Set pieces
     *
     * @param string $pieces
     *
     * @return Annonce
     */
    public function setPiece($piece)
    {
        $this->piece = $piece;

        return $this;
    }

    /**
     * Get pieces
     *
     * @return string
     */
    public function getPiece()
    {
        return $this->piece;
    }
}
