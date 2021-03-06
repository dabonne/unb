<?php

namespace AppBundle\Repository;

/**
 * UtilisateurRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UtilisateurRepository extends \Doctrine\ORM\EntityRepository
{
    public function findUserEtudiant($mail){
        $query = $this->_em->createQuery('SELECT a FROM AppBundle:Utilisateur a WHERE a.email = :email');
        $query->setParameter('email', $mail);
        return $query->getOneOrNullResult();
    }
}
