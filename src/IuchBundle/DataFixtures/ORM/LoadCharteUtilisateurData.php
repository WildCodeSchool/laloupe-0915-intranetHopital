<?php

// src/IuchBundle/DataFixtures/ORM/LoadCharteUtilisateurData.php

namespace IuchBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use IuchBundle\Entity\Charte_utilisateur;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadCharteUtilisateurData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface

{
    public function load(ObjectManager $manager)
    {
        $charte_utilisateur1 = new Charte_utilisateur();
        $charte_utilisateur1->setSignature(true);
        $charte_utilisateur1->setDateSignature(new \DateTime('now'));
        $charte_utilisateur1->setCharte($this->getReference('103'));
        $charte_utilisateur1->setUser($this->getReference('202'));

        $charte_utilisateur2 = new Charte_utilisateur();
        $charte_utilisateur2->setSignature(true);
        $charte_utilisateur2->setDateSignature(new \DateTime('now'));
        $charte_utilisateur2->setCharte($this->getReference('104'));
        $charte_utilisateur2->setUser($this->getReference('205'));

        $charte_utilisateur3 = new Charte_utilisateur();
        $charte_utilisateur3->setSignature(true);
        $charte_utilisateur3->setDateSignature(new \DateTime('now'));
        $charte_utilisateur3->setCharte($this->getReference('103'));
        $charte_utilisateur3->setUser($this->getReference('205'));

        $charte_utilisateur4 = new Charte_utilisateur();
        $charte_utilisateur4->setSignature(true);
        $charte_utilisateur4->setDateSignature(new \DateTime('now'));
        $charte_utilisateur4->setCharte($this->getReference('108'));
        $charte_utilisateur4->setUser($this->getReference('203'));

        $charte_utilisateur5 = new Charte_utilisateur();
        $charte_utilisateur5->setSignature(true);
        $charte_utilisateur5->setDateSignature(new \DateTime('now'));
        $charte_utilisateur5->setCharte($this->getReference('108'));
        $charte_utilisateur5->setUser($this->getReference('205'));

        $charte_utilisateur6 = new Charte_utilisateur();
        $charte_utilisateur6->setSignature(true);
        $charte_utilisateur6->setDateSignature(new \DateTime('now'));
        $charte_utilisateur6->setCharte($this->getReference('104'));
        $charte_utilisateur6->setUser($this->getReference('209'));

        $charte_utilisateur7 = new Charte_utilisateur();
        $charte_utilisateur7->setSignature(true);
        $charte_utilisateur7->setDateSignature(new \DateTime('now'));
        $charte_utilisateur7->setCharte($this->getReference('107'));
        $charte_utilisateur7->setUser($this->getReference('205'));

        $charte_utilisateur8 = new Charte_utilisateur();
        $charte_utilisateur8->setSignature(true);
        $charte_utilisateur8->setDateSignature(new \DateTime('now'));
        $charte_utilisateur8->setCharte($this->getReference('104'));
        $charte_utilisateur8->setUser($this->getReference('204'));

        $charte_utilisateur9 = new Charte_utilisateur();
        $charte_utilisateur9->setSignature(true);
        $charte_utilisateur9->setDateSignature(new \DateTime('now'));
        $charte_utilisateur9->setCharte($this->getReference('104'));
        $charte_utilisateur9->setUser($this->getReference('206'));

        $charte_utilisateur10 = new Charte_utilisateur();
        $charte_utilisateur10->setSignature(true);
        $charte_utilisateur10->setDateSignature(new \DateTime('now'));
        $charte_utilisateur10->setCharte($this->getReference('103'));
        $charte_utilisateur10->setUser($this->getReference('206'));

        $charte_utilisateur11 = new Charte_utilisateur();
        $charte_utilisateur11->setSignature(true);
        $charte_utilisateur11->setDateSignature(new \DateTime('now'));
        $charte_utilisateur11->setCharte($this->getReference('103'));
        $charte_utilisateur11->setUser($this->getReference('203'));

        $charte_utilisateur12 = new Charte_utilisateur();
        $charte_utilisateur12->setSignature(true);
        $charte_utilisateur12->setDateSignature(new \DateTime('now'));
        $charte_utilisateur12->setCharte($this->getReference('104'));
        $charte_utilisateur12->setUser($this->getReference('210'));

        $charte_utilisateur13 = new Charte_utilisateur();
        $charte_utilisateur13->setSignature(true);
        $charte_utilisateur13->setDateSignature(new \DateTime('now'));
        $charte_utilisateur13->setCharte($this->getReference('103'));
        $charte_utilisateur13->setUser($this->getReference('204'));


        $manager->persist($charte_utilisateur1);
        $manager->persist($charte_utilisateur2);
        $manager->persist($charte_utilisateur3);
        $manager->persist($charte_utilisateur4);
        $manager->persist($charte_utilisateur5);
        $manager->persist($charte_utilisateur6);
        $manager->persist($charte_utilisateur7);
        $manager->persist($charte_utilisateur8);
        $manager->persist($charte_utilisateur9);
        $manager->persist($charte_utilisateur10);
        $manager->persist($charte_utilisateur11);
        $manager->persist($charte_utilisateur12);
        $manager->persist($charte_utilisateur13);

        $manager->flush();

    }
    public function getOrder()
    {
        return 5; // ordre d'appel
    }
}
