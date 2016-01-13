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
        $Charte1->setObligatoire(true);

        $Charte2 = new Charte();
        $Charte2->setNom('Charte 2');
        $Charte2->setDescription('desc2');
        $Charte2->setFileName('charte2.pdf');
        $Charte2->setCharteFile('charte2.pdf');
        $Charte2->setService(
            $this->getReference('2')
        );
        $Charte2->setObligatoire(false);

        $Charte3 = new Charte();
        $Charte3->setNom('CHARTE DE LA PERSONNE ACCUEILLI');
        $Charte3->setDescription('Charte de la personnne accueilli');
        $Charte3->setFileName('CHARTE_DE_LA_PERSONNE_ACCUILLIE.pdf');
        $Charte3->setCharteFile('CHARTE_DE_LA_PERSONNE_ACCUILLIE.pdf');
        $Charte3->setService(
            $this->getReference('7')
        );
        $Charte3->setObligatoire(true);

        $Charte4 = new Charte();
        $Charte4->setNom('CHARTE INFORMATIQUE');
        $Charte4->setDescription('Charte Informatique');
        $Charte4->setFileName('CHARTE_INFORMATIQUE.pdf');
        $Charte4->setCharteFile('CHARTE_INFORMATIQUE.pdf');
        $Charte4->setService(
            $this->getReference('7')
        );
        $Charte4->setObligatoire(false);

        $Charte5 = new Charte();
        $Charte5->setNom('Charte 5');
        $Charte5->setDescription('desc5');
        $Charte5->setFileName('charte2.pdf');
        $Charte5->setCharteFile('charte2.pdf');
        $Charte5->setService(
            $this->getReference('7')
        );
        $Charte5->setObligatoire(false);

        $Charte6 = new Charte();
        $Charte6->setNom('Charte 6');
        $Charte6->setDescription('desc6');
        $Charte6->setFileName('charte2.pdf');
        $Charte6->setCharteFile('charte2.pdf');
        $Charte6->setService(
            $this->getReference('7')
        );
        $Charte6->setObligatoire(false);

        $Charte7 = new Charte();
        $Charte7->setNom('Charte 7');
        $Charte7->setDescription('desc7');
        $Charte7->setFileName('charte2.pdf');
        $Charte7->setCharteFile('charte2.pdf');
        $Charte7->setService(
            $this->getReference('7')
        );
        $Charte7->setObligatoire(false);

        $Charte8 = new Charte();
        $Charte8->setNom('Charte 8');
        $Charte8->setDescription('desc8');
        $Charte8->setFileName('charte2.pdf');
        $Charte8->setCharteFile('charte2.pdf');
        $Charte8->setService(
            $this->getReference('8')
        );
        $Charte8->setObligatoire(false);

        $Charte9 = new Charte();
        $Charte9->setNom('Charte 9');
        $Charte9->setDescription('desc9');
        $Charte9->setFileName('charte2.pdf');
        $Charte9->setCharteFile('charte2.pdf');
        $Charte9->setService(
            $this->getReference('5')
        );
        $Charte9->setObligatoire(false);

        $manager->persist($Charte1);
        $manager->persist($Charte2);
        $manager->persist($Charte3);
        $manager->persist($Charte4);
        $manager->persist($Charte5);
        $manager->persist($Charte6);
        $manager->persist($Charte7);
        $manager->persist($Charte8);
        $manager->persist($Charte9);
        $manager->flush();

        // store reference to chartes for User relation to Role
        $this->addReference('101', $Charte1);
        $this->addReference('102', $Charte2);
        $this->addReference('103', $Charte3);
        $this->addReference('104', $Charte4);
        $this->addReference('105', $Charte5);
        $this->addReference('106', $Charte6);
        $this->addReference('107', $Charte7);
        $this->addReference('108', $Charte8);
        $this->addReference('109', $Charte9);

    }

    public function getOrder()
    {
        return 4; // ordre d'appel
    }
}
