<?php

// src/IuchBundle/DataFixtures/ORM/LoadUserData.php

namespace IuchBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Application\Sonata\UserBundle\Entity\User;
use IuchBundle\Entity\Fonction;
use IuchBundle\Entity\Service;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadUserData extends AbstractFixture implements ContainerAwareInterface, FixtureInterface, OrderedFixtureInterface

{
    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {

        // Get our userManager, you must implement `ContainerAwareInterface`
        $userManager = $this->container->get('fos_user.user_manager');

        // Create our user and set details
        $user1 = $userManager->createUser();
        $user1->setUsername('admin');
        $user1->setPlainPassword('admin');
        $user1->setEmail('admin@email.com');
        $user1->setRoles(array('ROLE_SUPER_ADMIN'));
        $user1->setAdresse('18 Rue de la gare');
        $user1->setZip('28400');
        $user1->setVille('La Loupe');
        $user1->setDateEntree(new \DateTime('now'));
        $user1->setFirstname('Admin');
        $user1->setLastname('Admin');
        $user1->setPhone('0233258975');
        $user1->setLastLogin(new \DateTime('now'));

        $user2 = $userManager->createUser();
        $user2->setUsername('ressources-humaines');
        $user2->setPlainPassword('ressources-humaines');
        $user2->setEmail('RH@email.com');
        $user2->setRoles(array('ROLE_RH'));
        $user2->setAdresse('18 Rue de la gare');
        $user2->setZip('28400');
        $user2->setVille('La Loupe');
        $user2->setDateEntree(new \DateTime('now'));
        $user2->setFirstname('Martine');
        $user2->setLastname('Durand');
        $user2->setPhone('0233668548');
        $user2->setFonction($this->getReference('10'));
        $user2->setService($this->getReference('7'));

        $user3 = $userManager->createUser();
        $user3->setUsername('medecin');
        $user3->setPlainPassword('medecin');
        $user3->setEmail('medecin@email.com');
        $user3->setRoles(array('ROLE_USER'));
        $user3->setAdresse('18 Rue de la gare');
        $user3->setZip('28400');
        $user3->setVille('La Loupe');
        $user3->setDateEntree(new \DateTime('now'));
        $user3->setFirstname('Joseph');
        $user3->setLastname('Langlade');
        $user3->setPhone('0235214872');
        $user3->setFonction($this->getReference('14'));
        $user3->setService($this->getReference('1'));
        $user3->setChefService(true);

        $user4 = $userManager->createUser();
        $user4->setUsername('brancardier');
        $user4->setPlainPassword('brancardier');
        $user4->setEmail('brancardier@email.com');
        $user4->setRoles(array('ROLE_USER'));
        $user4->setAdresse('18 Rue de la gare');
        $user4->setZip('28400');
        $user4->setVille('La Loupe');
        $user4->setDateEntree(new \DateTime('now'));
        $user4->setFirstname('Martin');
        $user4->setLastname('Duval');
        $user4->setPhone('0235587596');
        $user4->setFonction($this->getReference('11'));
        $user4->setService($this->getReference('2'));
        $user4->setChefService(true);

        $user5 = $userManager->createUser();
        $user5->setUsername('lucie');
        $user5->setPlainPassword('lucie');
        $user5->setEmail('lucie@email.com');
        $user5->setRoles(array('ROLE_USER'));
        $user5->setAdresse('18 Rue de la gare');
        $user5->setZip('28400');
        $user5->setVille('La Loupe');
        $user5->setDateEntree(new \DateTime('now'));
        $user5->setFirstname('Lucie');
        $user5->setLastname('Mannechez');
        $user5->setPhone('0235587589');
        $user5->setLastLogin(new \DateTime('now'));
        $user5->setFonction($this->getReference('11'));
        $user5->setService($this->getReference('1'));

        $user6 = $userManager->createUser();
        $user6->setUsername('thierry');
        $user6->setPlainPassword('thierry');
        $user6->setEmail('thierry@email.com');
        $user6->setRoles(array('ROLE_USER'));
        $user6->setAdresse('18 Rue de la gare');
        $user6->setZip('28400');
        $user6->setVille('La Loupe');
        $user6->setDateEntree(new \DateTime('now'));
        $user6->setFirstname('Thierry');
        $user6->setLastname('Damey');
        $user6->setPhone('0235587699');
        $user6->setFonction($this->getReference('15'));


        // Fixing credentials for test environment
        $user7 = $userManager->createUser();
        $user7->setUsername('erwan');
        $user7->setPlainPassword('erwan');
        $user7->setEmail('erwan@email.com');
        $user7->setRoles(array('ROLE_USER'));
        $user7->setAdresse('18 Rue de la gare');
        $user7->setZip('28400');
        $user7->setVille('La Loupe');
        $user7->setDateEntree(new \DateTime('now'));
        $user7->setFirstname('Erwan');
        $user7->setLastname('Haquet');
        $user7->setPhone('0235587529');
        $user7->setLastLogin(new \DateTime('now'));
        $user7->setFonction($this->getReference('14'));
        $user7->setService($this->getReference('2'));

        $user8 = $userManager->createUser();
        $user8->setUsername('testAdmin');
        $user8->setPlainPassword('testAdmin');
        $user8->setEmail('testAdmin@email.com');
        $user8->setRoles(array('ROLE_SUPER_ADMIN'));
        $user8->setAdresse('18 Rue de la gare');
        $user8->setZip('28400');
        $user8->setVille('La Loupe');
        $user8->setDateEntree(new \DateTime('now'));
        $user8->setFirstname('testAdmin');
        $user8->setLastname('testAdmin');
        $user8->setPhone('0233258975');
        $user8->setLastLogin(new \DateTime('now'));

        $user9 = $userManager->createUser();
        $user9->setUsername('blanchisserie');
        $user9->setPlainPassword('blanchisserie');
        $user9->setEmail('henri@email.com');
        $user9->setRoles(array('ROLE_BLANCHISSERIE'));
        $user9->setAdresse('18 Rue de la gare');
        $user9->setZip('28400');
        $user9->setVille('La Loupe');
        $user9->setDateEntree(new \DateTime('now'));
        $user9->setFirstname('Durand');
        $user9->setLastname('Henri');
        $user9->setPhone('0233258975');
        $user9->setLastLogin(new \DateTime('now'));
        $user9->setFonction($this->getReference('16'));
        $user9->setService($this->getReference('6'));

        $user10 = $userManager->createUser();
        $user10->setUsername('services-techniques');
        $user10->setPlainPassword('services-techniques');
        $user10->setEmail('maurice@email.com');
        $user10->setRoles(array('ROLE_SERVICE_TECHNIC'));
        $user10->setAdresse('18 Rue de la gare');
        $user10->setZip('28400');
        $user10->setVille('La Loupe');
        $user10->setDateEntree(new \DateTime('now'));
        $user10->setFirstname('Dupont');
        $user10->setLastname('Maurice');
        $user10->setPhone('0233258975');
        $user10->setLastLogin(new \DateTime('now'));
        $user10->setFonction($this->getReference('17'));
        $user10->setService($this->getReference('8'));

        $user11 = $userManager->createUser();
        $user11->setUsername('qualité');
        $user11->setPlainPassword('qualité');
        $user11->setEmail('lea@email.com');
        $user11->setRoles(array('ROLE_QGDR'));
        $user11->setAdresse('18 Rue de la gare');
        $user11->setZip('28400');
        $user11->setVille('La Loupe');
        $user11->setDateEntree(new \DateTime('now'));
        $user11->setFirstname('Cristaline');
        $user11->setLastname('Eleonore');
        $user11->setPhone('0233258975');
        $user11->setLastLogin(new \DateTime('now'));
        $user11->setFonction($this->getReference('18'));
        $user11->setService($this->getReference('9'));

        $user12 = $userManager->createUser();
        $user12->setUsername('testRH');
        $user12->setPlainPassword('testRH');
        $user12->setEmail('testRH@email.com');
        $user12->setRoles(array('ROLE_RH'));
        $user12->setAdresse('18 Rue de la gare');
        $user12->setZip('28400');
        $user12->setVille('La Loupe');
        $user12->setDateEntree(new \DateTime('now'));
        $user12->setFirstname('Martine');
        $user12->setLastname('Durand');
        $user12->setPhone('0233668548');
        $user12->setLastLogin(new \DateTime('now'));
        $user12->setFonction($this->getReference('10'));
        $user12->setService($this->getReference('7'));

        // Update the user
        $userManager->updateUser($user1, true);
        $userManager->updateUser($user2, true);
        $userManager->updateUser($user3, true);
        $userManager->updateUser($user4, true);
        $userManager->updateUser($user5, true);
        $userManager->updateUser($user6, true);
        $userManager->updateUser($user7, true);
        $userManager->updateUser($user8, true);
        $userManager->updateUser($user9, true);
        $userManager->updateUser($user10, true);
        $userManager->updateUser($user11, true);
        $userManager->updateUser($user12, true);

        // store reference to admin role for User relation to Role
        $this->addReference('201', $user1);
        $this->addReference('202', $user2);
        $this->addReference('203', $user3);
        $this->addReference('204', $user4);
        $this->addReference('205', $user5);
        $this->addReference('206', $user6);
        $this->addReference('207', $user7);
        $this->addReference('208', $user8);
        $this->addReference('209', $user9);
        $this->addReference('210', $user10);
        $this->addReference('211', $user11);
        $this->addReference('212', $user12);

    }
    public function getOrder()
    {
        return 4; // ordre d'appel
    }
}