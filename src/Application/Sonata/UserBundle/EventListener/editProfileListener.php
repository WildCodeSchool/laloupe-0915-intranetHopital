<?php

// src/Application/Sonata/UserBundle/EventListener/editProfileListener.php

namespace Application\Sonata\UserBundle\EventListener;

use Application\Sonata\UserBundle\Entity\User;

class editProfileListener
{
    private $mailer;

    private $container;

    public function __construct($mailer, $container)
    {
        $this->mailer = $mailer;
        $this->container = $container;
    }

    public function preUpdate(\Doctrine\ORM\Event\PreUpdateEventArgs $eventArgs)
    {
        if ($eventArgs->getEntity() instanceof User) {
            /**
             * SET DATE_SORTIE ON NULL IF USER IS REACTIVATE AFTER DESACTIVATION (because date_sortie < now)
             */
            if ($eventArgs->hasChangedField('enabled') && $eventArgs->getNewValue('enabled') == true && $eventArgs->getEntity()->getDateSortie() < new \DateTime('now')) {
                $eventArgs->getEntity()->setDateSortie(null);
                $eventArgs->getEntity()->setRaisonSortie(null);
            }

            /**
             * Change in profile => pointeur field to 1 (back to 0 by the admin in the BDD directly)
             */
            if ( $eventArgs->hasChangedField('email') ||
                 $eventArgs->hasChangedField('phone') ||
                 $eventArgs->hasChangedField('adresse') ||
                 $eventArgs->hasChangedField('ville') ||
                 $eventArgs->hasChangedField('zip') ||
                 $eventArgs->hasChangedField('photo_id') ||
                 $eventArgs->hasChangedField('service_id') ||
                 $eventArgs->hasChangedField('enabled') ||
                 $eventArgs->hasChangedField('password') ||
                 $eventArgs->hasChangedField('date_of_birth') ||
                 $eventArgs->hasChangedField('firstname') ||
                 $eventArgs->hasChangedField('lastname') ||
                 $eventArgs->hasChangedField('date_entree') ||
                 $eventArgs->hasChangedField('date_sortie') ||
                 $eventArgs->hasChangedField('raison_sortie') ||
                 $eventArgs->hasChangedField('username') )
            {
                 $eventArgs->getEntity()->setPointeur(true);
            }


            /**
             * SEND MAIL ON PROFILE CHANGES
             */
            if ( $this->container->getParameter('mail.edit_profil.enabled') == true) {
                if ($eventArgs->hasChangedField('email') ||
                    $eventArgs->hasChangedField('phone') ||
                    $eventArgs->hasChangedField('adresse') ||
                    $eventArgs->hasChangedField('ville') ||
                    $eventArgs->hasChangedField('zip')
                ) {

                    if ($this->container->hasParameter('mail.edit_profil'))
                        $mail = $this->container->getParameter('mail.edit_profil');
                    else {
                        $this->container->setParameter('mail.edit_profil.enabled', false);
                    }

                    $message = \Swift_Message::newInstance()
                        ->setSubject('Changements dans le profil de ' . $eventArgs->getEntity())
                        ->setFrom('sacha@ch-laloupe.fr')
                        ->setTo($mail)
                        ->setBody(
                            $this->getMailBody($eventArgs->getEntityChangeSet(), $eventArgs->getEntity()),
                            'text/html'
                        );
                    $this->mailer->send($message);
                }
            }
        }
    }

    private function getMailBody($changes, $user)
    {
        $result = '<h1>Changements dans le profile de '. $user .'</h1>';

        foreach ($changes as $property=>$change) {
            if ( $property === "email" ||
                 $property === "phone" ||
                 $property === "ville" ||
                 $property === "adresse" ||
                 $property === "zip" )
            {
                $result .= "<strong>".$property." :</strong> ".$change[0]." -> ".$change[1]. '<br/><br/>';
            }
        }
        return $result;
    }

}
