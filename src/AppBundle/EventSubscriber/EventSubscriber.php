<?php
/**
 * Created by PhpStorm.
 * User: dabonne
 * Date: 16/12/2018
 * Time: 09:16
 */

# src/EventSubscriber/EasyAdminSubscriber.php
namespace AppBundle\EventSubscriber;

use AppBundle\Entity\Annonce;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class EventSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            'easy_admin.post_persist' => ['sendMail'],
        ];
    }

    public function sendMail(GenericEvent $event)
    {
        $entity = $event->getSubject();

        if (!($entity instanceof Annonce)) {
            return;
        }

    }
}