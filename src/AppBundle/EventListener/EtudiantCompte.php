<?php
namespace AppBundle\EventListener;
use AppBundle\Entity\Utilisateur;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * Created by PhpStorm.
 * User: dabonne
 * Date: 12/12/2018
 * Time: 22:44
 */
class EtudiantCompte
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        $entityManager = $args->getObjectManager();
        if ($entity instanceof Utilisateur) {
            if($entity->hasRole('ROLE_ADMIN')){
                return;
            }
            $etudiant = $entityManager->getRepository('AppBundle:Etudiant')->findUserEtudiant($entity->getEmail());
            if($etudiant !== null){
                $entity->setEtudiant($etudiant);
                $etudiant->setUser($entity);
            } else return $entity = new Utilisateur(null);
        }
        else return;
    }
}