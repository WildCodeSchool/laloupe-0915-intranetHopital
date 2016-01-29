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
            // si le matériel est rendu ou perdu/volé alors la date de rendu est rentrée automatiquement à la date de changement.
            if ($eventArgs->getEntity()->getRendu() === true || $eventArgs->getEntity()->getPerduVol() === true) {
                $eventArgs->getEntity()->setDateRendu( new \DateTime('now') );
            }
            // si jamais il y a eu une erreur sur le rendu, alors la date de rendu est de nouveau nulle
            else if ($eventArgs->getEntity()->getRendu() === false) {
                $eventArgs->getEntity()->setDateRendu(null);
            }

            // Si le matériel est perdu alors il n'est pas rendu
            if ($eventArgs->getEntity()->getPerduVol() === true) {
                $eventArgs->getEntity()->setRendu(false);
            }
        }
    }
}
