<?php
// IuchBundle/Listener/MaterielListener.php

namespace IuchBundle\Listener;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use IuchBundle\Entity\Materiel;

class MaterielListener
{
    public function preUpdate(PreUpdateEventArgs $eventArgs)
    {
        if ($eventArgs->getEntity() instanceof Materiel) {
            if ($eventArgs->hasChangedField('remis') && $eventArgs->getNewValue('remis') === false) {

                $date = new \DateTime('now');

                $eventArgs->getEntity()->setDateRendu($date);
            }
        }
    }
}
