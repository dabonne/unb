<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Entreprise
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EntrepriseRepository")
 */
class Entreprise extends EntrepriseSuper
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_embauche", type="date", nullable=false)
     */
    private $dateEmbauche;

    /**
     * @var string
     * @ORM\Column(name="poste", type="string", length=255, unique=false)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 5,
     *      max = 255,
     *      minMessage = "Le nom du poste est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "Le nom du poste est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $poste;

    /**
    /**
     * @var string
     * @ORM\Column(name="type_contract", type="string", length=255, unique=false)
     * @Assert\NotBlank(message="Ce champs est obligatoire !")
     * @Assert\Length(
     *      min = 1,
     *      max = 55,
     *      minMessage = "Le type de contrat est trop court il doit avoir au moins {{ limit }} caracters",
     *      maxMessage = "Le type de contrat est trop long il doit avoir au plus {{ limit }} caracters"
     * )
     */
    private $typeContract;



    /**
     * Set poste
     *
     * @param string $poste
     *
     * @return Entreprise
     */
    public function setPoste($poste)
    {
        $this->poste = $poste;
    
        return $this;
    }

    /**
     * Get poste
     *
     * @return string
     */
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * Set typeContract
     *
     * @param string $typeContract
     *
     * @return Entreprise
     */
    public function setTypeContract($typeContract)
    {
        $this->typeContract = $typeContract;
    
        return $this;
    }

    /**
     * Get typeContract
     *
     * @return string
     */
    public function getTypeContract()
    {
        return $this->typeContract;
    }

    /**
     * Set dateEmbauche
     *
     * @param \DateTime $dateEmbauche
     *
     * @return Entreprise
     */
    public function setDateEmbauche($dateEmbauche)
    {
        $this->dateEmbauche = $dateEmbauche;
    
        return $this;
    }

    /**
     * Get dateEmbauche
     *
     * @return \DateTime
     */
    public function getDateEmbauche()
    {
        return $this->dateEmbauche;
    }
}
