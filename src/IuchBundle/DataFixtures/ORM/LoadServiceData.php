<?php

// src/IuchBundle/DataFixtures/ORM/LoadServiceData.php

namespace IuchBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use IuchBundle\Entity\Service;

class LoadServiceData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $service1 = new Service();
        $service1->setNom('ADMINISTRATION');
        $service1->setEmail('admin@email.com');
        $service1->setTelephone('02.01.02.03.04');
        $service1->setUF('0100');

        $service2 = new Service();
        $service2->setNom('ANIMATION');
        $service2->setEmail('anim@email.com');
        $service2->setTelephone('02.11.12.13.14');
        $service2->setUF('0110');

        $service3 = new Service();
        $service3->setNom('RESSOURCE HUMAINE');
        $service3->setEmail('rh@email.com');
        $service3->setTelephone('02.21.22.23.24');
        $service3->setUF('0120');

        $service4 = new Service();
        $service4->setNom('ECONOMAT-FINANCES');
        $service4->setEmail('eco-finances@email.com');
        $service4->setTelephone('02.31.32.33.34');
        $service4->setUF('0130');

        $service5 = new Service();
        $service5->setNom('ADMISSION-RECETTES');
        $service5->setEmail('admission-recettes@email.com');
        $service5->setTelephone('02.41.42.43.44');
        $service5->setUF('0140');

        $service6 = new Service();
        $service6->setNom('SECMED-QUALITE');
        $service6->setEmail('qgdr@email.com');
        $service6->setTelephone('02.51.52.53.54');
        $service6->setUF('0150');

        $service7 = new Service();
        $service7->setNom('MEDECINE/USLD');
        $service7->setEmail('medecine@email.com');
        $service7->setTelephone('02.61.62.63.64');
        $service7->setUF('0200');

        $service8 = new Service();
        $service8->setNom('BLANCHISSERIE LING');
        $service8->setEmail('blanchisserie@email.com');
        $service8->setTelephone('02.71.72.73.74');
        $service8->setUF('0400');

        $service9 = new Service();
        $service9->setNom('SCE TECH');
        $service9->setEmail('sce-tech@email.com');
        $service9->setTelephone('02.81.82.83.84');
        $service9->setUF('0600');

        $service10 = new Service();
        $service10->setNom('testService');
        $service10->setEmail('sce-tech@email.com');
        $service10->setTelephone('02.81.82.83.84');
        $service10->setUF('9999');

        $manager->persist($service1);
        $manager->persist($service2);
        $manager->persist($service3);
        $manager->persist($service4);
        $manager->persist($service5);
        $manager->persist($service6);
        $manager->persist($service7);
        $manager->persist($service8);
        $manager->persist($service9);
        $manager->persist($service10);
        $manager->flush();

        // store reference to admin role for User relation to Role
        $this->addReference('1', $service1);
        $this->addReference('2', $service2);
        $this->addReference('3', $service3);
        $this->addReference('4', $service4);
        $this->addReference('5', $service5);
        $this->addReference('6', $service6);
        $this->addReference('7', $service7);
        $this->addReference('8', $service8);
        $this->addReference('9', $service9);
        $this->addReference('0', $service10);
    }

    public function getOrder()
    {
        return 2; // ordre d'appel
    }
}
