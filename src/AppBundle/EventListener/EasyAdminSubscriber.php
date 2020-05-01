<?php
/**
 * Created by PhpStorm.
 * User: dabonne
 * Date: 16/12/2018
 * Time: 16:53
 */

namespace AppBundle\EventListener;

use AppBundle\Entity\Annonce;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class EasyAdminSubscriber
{
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public static function getSubscribedEvents()
    {
        return array(
            'easy_admin.post_persist' => array('setEmail'),
        );
    }

    public function setEmail(GenericEvent $event)
    {
        $entity = $event->getSubject();

        if (!($entity instanceof Annonce)) {
            return;
        }

        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('saoudatouzongo@gmail.com')
            ->setTo('dabonnehoda@gmail.com.com')
            ->setBody('rfgsdgsdfgdfgfg');

        $this->mailer->send($message);
    }
}