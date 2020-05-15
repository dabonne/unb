<?php

/*
 * This file is part of the EasyAdminBundle.
 *
 * (c) Javier Eguiluz <javier.eguiluz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Controller\Annonce;

use AppBundle\Entity\Annonce;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

/**
 * The controller used to render all the default EasyAdmin actions.
 *
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class AnnonceController extends BaseAdminController
{
    /**
     * @param Annonce $entity
     */
    protected function prePersistEntity($entity)
    {
        $em = $this->getDoctrine()->getManager();
        $etudiants = $em->getRepository('AppBundle:Etudiant')->findAll();
        $entity->getDateFin()? $date = $entity->getDateFin(): $date = '';
        if ($entity->getNatures() != null){
            foreach ($etudiants as $etudiant){
                foreach ($etudiant->getDiplomes() as $diplomes){
                    if (in_array($diplomes->getNature(),$entity->getNatures()->toArray(),true)){
                        $mailer = $this->get('mailer');
                        $message = \Swift_Message::newInstance()
                            ->setSubject(''.$entity->getIntitule() )
                            ->setFrom(array('dabonnehoda@gmail.com' => 'UNB-LIVE-REZO'))
                            ->setTo('dabonnehoda@gmail.com')
                            ->setCharset('utf-8')
                            ->setContentType('text/html')
                            ->setBody($this->renderView('email/annonceEmail.html.twig', array(
                                'date' => $date,
                                'message' => $entity->getInformation())));
                        $attachment = \Swift_Attachment::fromPath("%kernel.root_dir%/../web/uploads/annonces/pieces".$entity->getAttachement());
                        if ($attachment) {
                            $message->attach(($attachment));
                            $mailer->send($message);
                        } else {
                            $mailer->send($message);
                        }
                    }
                }

            }
        }
    }
    protected function preUpdateEntity($entity /*, bool $ignoreDeprecations = false */)
    {
        $em = $this->getDoctrine()->getManager();
        $etudiants = $em->getRepository('AppBundle:Etudiant')->findAll();
        $entity->getDateFin()? $date = $entity->getDateFin(): $date = '';
        if ($entity->getNatures() != null){
            foreach ($etudiants as $etudiant){
                foreach ($etudiant->getDiplomes() as $diplomes){
                    if (in_array($diplomes->getNature(),$entity->getNatures()->toArray(),true)){
                        $mailer = $this->get('mailer');
                        $message = \Swift_Message::newInstance()
                            ->setSubject(''.$entity->getIntitule() )
                            ->setFrom(array('dabonnehoda@gmail.com' => 'UNB-LIVE-REZO'))
                            ->setTo('dabonnehoda@gmail.com')
                            ->setCharset('utf-8')
                            ->setContentType('text/html')
                            ->setBody($this->renderView('email/annonceEmail.html.twig', array(
                                'date' => $date,
                                'message' => $entity->getInformation())));
                        $attachment = \Swift_Attachment::fromPath("%kernel.root_dir%/../web/uploads/annonces/pieces".$entity->getAttachement());
                        if ($attachment) {
                            $message->attach(($attachment));
                            $mailer->send($message);
                        } else {
                            $mailer->send($message);
                        }
                    }
                }

            }
        }
    }
}

