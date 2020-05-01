<?php
/**
 * Created by PhpStorm.
 * User: dabonne
 * Date: 16/12/2018
 * Time: 09:16
 */

namespace AppBundle\EventListener;


use AppBundle\Entity\Annonce;
use Doctrine\ORM\Event\LifecycleEventArgs;

class AnnonceListener
{
    public function postPersist(LifecycleEventArgs $args, \Swift_Mailer $mailer)
    {
        $entity = $args->getObject();
        $entityManager = $args->getObjectManager();
        if ($entity instanceof Annonce) {
            $message = (new \Swift_Message('Hello Email'))
                ->setFrom('saoudatouzongo@gmail.com')
                ->setTo('dabonnehoda@gmail.com.com')
                ->setBody('rfgsdgsdfgdfgfg');

            $mailer->send($message);
        }
        else return;
    }
}