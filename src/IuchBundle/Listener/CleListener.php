<?php
// IuchBundle/Listener/CleListener.php

namespace IuchBundle\Listener;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use IuchBundle\Entity\Cle;

class CleListener
{
    public function preUpdate(PreUpdateEventArgs $eventArgs)
    {
        if ($eventArgs->getEntity() instanceof Cle) {
            if ($eventArgs->hasChangedField('remis') && $eventArgs->getNewValue('remis') === false) {

                $date = new \DateTime('now');

                $eventArgs->getEntity()->setDateRendu($date);

            }
        }
    }
}
