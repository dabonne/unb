<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
/**
 * Etudiant
 *
 * @ORM\Table(name="etudiant")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EtudiantRepository")
 * @UniqueEntity(fields="matricule", message="un(e) etudiant a le meme numero matricule !")
 * @UniqueEntity(fields="telephone", message="un(e) etudiant a le meme numero de telephone !")
 * @UniqueEntity(fields="email", message="un(e) etudiant a le meme email !")
 * @Vich\Uploadable
 */
class Etudiant
{
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Diplome" , mappedBy="etudiant")
     */
    private $diplomes;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Certificat" , mappedBy="etudiant")
     */
    private $certificats;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Utilisateur")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Adresse")
     */
    private $adresse;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Etablissement" , inversedBy="etudiants")
     */
    private $etablissement;



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
     * @ORM\Column(name="matricule", type="string", length=255, unique=true)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 5,
     *      max = 8,
     *      minMessage = "Le nemero matricule est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "Le nemero matricule est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $matricule;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=70)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 2,
     *      max = 70,
     *      minMessage = "Le nom est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "Le nom est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=100)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Le prenom est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "Le prenom est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="promotion", type="string", length=25, unique=false)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * * @Assert\Length(
     *      min = 4,
     *      max = 4,
     *      minMessage = "Le prenom est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "Le prenom est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $promotion;

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

    // ... other fields

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $cv;

    /**
     * @Vich\UploadableField(mapping="etudiants_cvs", fileNameProperty="cv")
     * @var File
     */
    private $cvFile;

    public function setCvFile(File $cv = null)
    {
        $this->cvFile = $cv;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($cv) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getCvFile()
    {
        return $this->cvFile;
    }



    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="etudiants_image", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Etudiant
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $image
     *
     * @return Etudiant
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImage()
    {
        return $this->image;
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
     * Set matricule
     *
     * @param string $matricule
     *
     * @return Etudiant
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * Get matricule
     *
     * @return string
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Etudiant
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Etudiant
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set promotion
     *
     * @param string $promotion
     *
     * @return Etudiant
     */
    public function setPromotion($promotion)
    {
        $this->promotion = $promotion;

        return $this;
    }

    /**
     * Get promotion
     *
     * @return string
     */
    public function getPromotion()
    {
        return $this->promotion;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Etudiant
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
     * @return Etudiant
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
     * Constructor
     */

    public function __toString()
    {
        return $this->matricule;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Etudiant
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add diplome
     *
     * @param \AppBundle\Entity\Diplome $diplome
     *
     * @return Etudiant
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
     * Constructor
     */
    public function __construct()
    {
        $this->certificats = new \Doctrine\Common\Collections\ArrayCollection();
        $this->entreprises = new \Doctrine\Common\Collections\ArrayCollection();
        $this->diplomes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add certificat
     *
     * @param \AppBundle\Entity\Certificat $certificat
     *
     * @return Etudiant
     */
    public function addCertificat(\AppBundle\Entity\Certificat $certificat)
    {
        $this->certificats[] = $certificat;

        return $this;
    }

    /**
     * Remove certificat
     *
     * @param \AppBundle\Entity\Certificat $certificat
     */
    public function removeCertificat(\AppBundle\Entity\Certificat $certificat)
    {
        $this->certificats->removeElement($certificat);
    }

    /**
     * Get certificats
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCertificats()
    {
        return $this->certificats;
    }

    /**
     * Set adresse
     *
     * @param \AppBundle\Entity\Adresse $adresse
     *
     * @return Etudiant
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

    /**
     * Set etablissement
     *
     * @param \AppBundle\Entity\Etablissement $etablissement
     *
     * @return Etudiant
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
     * Set user
     *
     * @param \AppBundle\Entity\Utilisateur $user
     *
     * @return Etudiant
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

    /**
     * Set cv
     *
     * @param string $cv
     *
     * @return Etudiant
     */
    public function setCv($cv)
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * Get cv
     *
     * @return string
     */
    public function getCv()
    {
        return $this->cv;
    }

}
