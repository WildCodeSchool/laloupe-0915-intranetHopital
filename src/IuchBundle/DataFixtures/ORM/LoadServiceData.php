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
        $service1->setNom('médecine');
        $service1->setEmail('mede@email.com');
        $service1->setTelephone('02.01.02.03.04');

        $service2 = new Service();
        $service2->setNom('cardiologie');
        $service2->setEmail('cardio@email.com');
        $service2->setTelephone('02.11.12.13.14');

        $service3 = new Service();
        $service3->setNom('pédiatrie');
        $service3->setEmail('pedia@email.com');
        $service3->setTelephone('02.21.22.23.24');

        $service4 = new Service();
        $service4->setNom('gérontologie');
        $service4->setEmail('geron@email.com');
        $service4->setTelephone('02.31.32.33.34');

        $service5 = new Service();
        $service5->setNom('neurologie');
        $service5->setEmail('neuro@email.com');
        $service5->setTelephone('02.41.42.43.44');

        $service6 = new Service();
        $service6->setNom('blanchisserie');
        $service6->setEmail('blanc@email.com');
        $service6->setTelephone('02.51.52.53.54');

        $service7 = new Service();
        $service7->setNom('ressources humaines');
        $service7->setEmail('rh@email.com');
        $service7->setTelephone('02.61.62.63.64');

        $manager->persist($service1);
        $manager->persist($service2);
        $manager->persist($service3);
        $manager->persist($service4);
        $manager->persist($service5);
        $manager->persist($service6);
        $manager->persist($service7);
        $manager->flush();

        // store reference to admin role for User relation to Role
        $this->addReference('1', $service1);
        $this->addReference('2', $service2);
        $this->addReference('3', $service3);
        $this->addReference('4', $service4);
        $this->addReference('5', $service5);
        $this->addReference('6', $service6);
        $this->addReference('7', $service7);
    }

    public function getOrder()
    {
        return 1; // ordre d'appel
    }
}