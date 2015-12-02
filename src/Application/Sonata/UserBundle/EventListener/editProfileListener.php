<?php

// src/Application/Sonata/UserBundle/EventListener/editProfileListener.php

namespace Application\Sonata\UserBundle\EventListener;

use Application\Sonata\UserBundle\Entity\User;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class editProfileListener
{
    private $mailer;

    public function preUpdate(\Doctrine\ORM\Event\PreUpdateEventArgs $eventArgs)
    {
        if ($eventArgs->getEntity() instanceof User) {

            $service = $eventArgs->getEntity()->getService();

            if (!empty($service->getChefService()))
                $mail = $service->getChefService()->getEmail();
            else {
                $mail = $service->getEmail();
            }

            /**
             * TODO setFrom
             */
            $message = \Swift_Message::newInstance()
                ->setSubject('Changements dans le profil de '. $eventArgs->getEntity())
                ->setFrom('send@example.com')
                ->setTo('luciem92@gmail.com')
                ->addCc($mail)
                ->setBody(
                    $this->getMailBody($eventArgs->getEntityChangeSet(), $eventArgs->getEntity()),
                    'text/html'
                )
            ;
            $this->mailer->send($message);
        }
    }

    public function __construct($mailer)
    {
        $this->mailer = $mailer;
    }

    private function getMailBody($changes, $user)
    {
        $result = '<h1>Changements dans le profile de '. $user .'</h1>';

        foreach ($changes as $property=>$change) {
            if ($property != "updatedAt" && $property != "emailCanonical" && $property != "lastLogin")
            {
                $result .= "<strong>".$property." :</strong> ".$change[0]." -> ".$change[1]. '<br/><br/>';
            }
        }
        return $result;
    }

}