<?php

// src/IuchBundle/DataFixtures/ORM/LoadFonctionData.php

namespace IuchBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use IuchBundle\Entity\Fonction;

class LoadFonctionData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $fonction1 = new Fonction();
        $fonction1->setNom('RH');

        $fonction2 = new Fonction();
        $fonction2->setNom('infirmière');

        $fonction3 = new Fonction();
        $fonction3->setNom('aide-soignante');

        $fonction4 = new Fonction();
        $fonction4->setNom('brancardier');

        $fonction5 = new Fonction();
        $fonction5->setNom('médecin');

        $manager->persist($fonction1);
        $manager->persist($fonction2);
        $manager->persist($fonction3);
        $manager->persist($fonction4);
        $manager->persist($fonction5);
        $manager->flush();
    }
}