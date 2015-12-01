<?php

// src/IuchBundle/DataFixtures/ORM/LoadFonctionData.php

namespace IuchBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use IuchBundle\Entity\Fonction;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadFonctionData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface

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

        $fonction6 = new Fonction();
        $fonction6->setNom('RSI');

        $fonction7 = new Fonction();
        $fonction7->setNom('blanchisserie');

        $fonction8 = new Fonction();
        $fonction8->setNom('services techniques');

        $manager->persist($fonction1);
        $manager->persist($fonction2);
        $manager->persist($fonction3);
        $manager->persist($fonction4);
        $manager->persist($fonction5);
        $manager->persist($fonction6);
        $manager->persist($fonction7);
        $manager->persist($fonction8);
        $manager->flush();

        $this->addReference('7', $fonction1);
        $this->addReference('8', $fonction2);
        $this->addReference('9', $fonction3);
        $this->addReference('10', $fonction4);
        $this->addReference('11', $fonction5);
        $this->addReference('12', $fonction6);
        $this->addReference('13', $fonction7);
        $this->addReference('14', $fonction8);
    }
    public function getOrder()
    {
        return 3; // ordre d'appel
    }
}