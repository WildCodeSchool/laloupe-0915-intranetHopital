<?php
// IuchBundle/Listener/BadgeListener.php

namespace IuchBundle\Listener;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use IuchBundle\Entity\Badge;

class BadgeListener
{
    public function preUpdate(PreUpdateEventArgs $eventArgs)
    {
        if ($eventArgs->getEntity() instanceof Badge) {
            if ($eventArgs->hasChangedField('remis') && $eventArgs->getNewValue('remis') === false) {

                $date = new \DateTime('now');

                $eventArgs->getEntity()->setDateRendu($date);

            }
        }
    }
}
