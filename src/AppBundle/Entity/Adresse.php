<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adresse
 *
 * @ORM\Table(name="adresse")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdresseRepository")
 */
class Adresse
{
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
     * @ORM\Column(name="localite", type="string", length=50, unique=false)
     */
    private $localite;

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
     * Set localite
     *
     * @param string $localite
     *
     * @return Adresse
     */
    public function setLocalite($localite)
    {
        $this->localite = $localite;

        return $this;
    }

    /**
     * Get localite
     *
     * @return string
     */
    public function getLocalite()
    {
        return $this->localite;
    }

    public function __toString()
    {
        return $this->localite;
    }
}
