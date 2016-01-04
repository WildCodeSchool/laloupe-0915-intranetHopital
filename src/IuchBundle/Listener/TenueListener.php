<?php
// IuchBundle/Listener/TenueListener.php

namespace IuchBundle\Listener;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use IuchBundle\Entity\Tenue;

class TenueListener
{
    public function preUpdate(PreUpdateEventArgs $eventArgs)
    {
        if ($eventArgs->getEntity() instanceof Tenue) {
            if ($eventArgs->hasChangedField('nombre_rendu')) {

                $date = new \DateTime('now');

                $eventArgs->getEntity()->setDateRendu( $date);

            }
        }
    }
}
