<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\etudiant")
     */
    private $etudiant;

    /**
     * @var string
     *
     * @ORM\Column(name="matricule", type="string", length=8, unique=true, nullable=true)
     */
    private $matricule;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        $this->setEnabled(true);
    }

    /**
     * Set etudiant
     *
     * @param \AppBundle\Entity\etudiant $etudiant
     *
     * @return User
     */
    public function setEtudiant(\AppBundle\Entity\etudiant $etudiant = null)
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    /**
     * Get etudiant
     *
     * @return \AppBundle\Entity\etudiant
     */
    public function getEtudiant()
    {
        return $this->etudiant;
    }
    public function __toString()
    {
        return $this->username;
    }

    /**
     * Set matricule
     *
     * @param string $matricule
     *
     * @return User
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
}
