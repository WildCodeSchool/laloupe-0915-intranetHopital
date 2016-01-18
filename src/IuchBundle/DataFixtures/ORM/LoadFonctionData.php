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
        $fonction1->setNom('A.M.P CL. NORM.');

        $fonction2 = new Fonction();
        $fonction2->setNom('ADJOINT 1ERE CLASS');

        $fonction3 = new Fonction();
        $fonction3->setNom('ADJOINT 2EM CL');

        $fonction4 = new Fonction();
        $fonction4->setNom('CADRE DE SANTE');

        $fonction5 = new Fonction();
        $fonction5->setNom('IDE COORDINATRICE');

        $fonction6 = new Fonction();
        $fonction6->setNom('MAITRE OUVRIER');

        $fonction7 = new Fonction();
        $fonction7->setNom('MASSEUR KINE CL. SUP');

        $fonction8 = new Fonction();
        $fonction8->setNom('OUVRI PROF. QUALIFIE');

        $fonction9 = new Fonction();
        $fonction9->setNom('P.H TEMPS PLEIN');

        $fonction10 = new Fonction();
        $fonction10->setNom('testFonction');

        $manager->persist($fonction1);
        $manager->persist($fonction2);
        $manager->persist($fonction3);
        $manager->persist($fonction4);
        $manager->persist($fonction5);
        $manager->persist($fonction6);
        $manager->persist($fonction7);
        $manager->persist($fonction8);
        $manager->persist($fonction9);
        $manager->persist($fonction10);
        $manager->flush();

        $this->addReference('10', $fonction1);
        $this->addReference('11', $fonction2);
        $this->addReference('12', $fonction3);
        $this->addReference('13', $fonction4);
        $this->addReference('14', $fonction5);
        $this->addReference('15', $fonction6);
        $this->addReference('16', $fonction7);
        $this->addReference('17', $fonction8);
        $this->addReference('18', $fonction9);
        $this->addReference('19', $fonction10);
    }
    public function getOrder()
    {
        return 1; // ordre d'appel
    }
}
