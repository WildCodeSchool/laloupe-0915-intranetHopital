<?php

// src/IuchBundle/DataFixtures/ORM/LoadCharteData.php

namespace IuchBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use IuchBundle\Entity\Charte;

class LoadCharteData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $Charte1 = new Charte();
        $Charte1->setNom('Charte 1');
        $Charte1->setDescription('desc1');
        $Charte1->setFileName('charte1.pdf');
        $Charte1->setCharteFile('charte1.pdf');
        $Charte1->setService(
            $this->getReference('1')
        );

        $Charte2 = new Charte();
        $Charte2->setNom('Charte 2');
        $Charte2->setDescription('desc2');
        $Charte2->setFileName('charte2.pdf');
        $Charte2->setCharteFile('charte2.pdf');
        $Charte2->setService(
            $this->getReference('2')
        );

        $Charte3 = new Charte();
        $Charte3->setNom('Charte 3');
        $Charte3->setDescription('desc3');
        $Charte3->setFileName('charte3.pdf');
        $Charte3->setCharteFile('charte3.pdf');
        $Charte3->setService(
            $this->getReference('3')
        );

        $manager->persist($Charte1);
        $manager->persist($Charte2);
        $manager->persist($Charte3);
        $manager->flush();
    }

    public function getOrder()
    {
        return 2; // ordre d'appel
    }
}