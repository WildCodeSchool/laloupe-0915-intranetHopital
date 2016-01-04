<?php

// src/Application/Sonata/UserBundle/EventListener/editProfileListener.php

namespace Application\Sonata\UserBundle\EventListener;

use Application\Sonata\UserBundle\Entity\User;

class editProfileListener
{
    private $mailer;

    public function preUpdate(\Doctrine\ORM\Event\PreUpdateEventArgs $eventArgs)
    {
        if ($eventArgs->getEntity() instanceof User) {

            if ( $eventArgs->hasChangedField('email') ||
                 $eventArgs->hasChangedField('phone') ||
                 $eventArgs->hasChangedField('adresse') ||
                 $eventArgs->hasChangedField('ville') ||
                 $eventArgs->hasChangedField('zip')  )
            {
                $service = $eventArgs->getEntity()->getService();

                if ($service !== null) {
                    if ($service->getChefService())
                        $mail = $service->getChefService()->getEmail();
                    else {
                        $mail = $service->getEmail();
                    }
                } else {
                    $mail = 'luciem92@gmail.com';
                }

                /**
                 * TODO setFrom
                 */
                $message = \Swift_Message::newInstance()
                    ->setSubject('Changements dans le profil de ' . $eventArgs->getEntity())
                    ->setFrom('send@example.com')
                    ->setTo('luciem92@gmail.com')
                    ->addCc($mail)
                    ->setBody(
                        $this->getMailBody($eventArgs->getEntityChangeSet(), $eventArgs->getEntity()),
                        'text/html'
                    );
                $this->mailer->send($message);
            }
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
            if ( $property == "email" ||
                 $property == "phone" ||
                 $property == "ville" ||
                 $property == "adresse" ||
                 $property == "zip" )
            {
                $result .= "<strong>".$property." :</strong> ".$change[0]." -> ".$change[1]. '<br/><br/>';
            }
        }
        return $result;
    }

}