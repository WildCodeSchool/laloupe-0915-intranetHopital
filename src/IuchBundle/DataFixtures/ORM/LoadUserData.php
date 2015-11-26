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
        $user2->setFonction(
            $this->getReference('7')
        );

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
        $user3->setFonction(
            $this->getReference('11')
        );
        $user3->setService(
            $this->getReference('1')
        );
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
        $user4->setFonction(
            $this->getReference('8')
        );
        $user4->setService(
            $this->getReference('2')
        );
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
        $user5->setFonction(
            $this->getReference('8')
        );
        $user5->setService(
            $this->getReference('4')
        );

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
        $user6->setFonction(
            $this->getReference('12')
        );


        // On fixe les credential sur Erwan pour passer les tests
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
        $user7->setFonction(
            $this->getReference('11')
        );
        $user7->setService(
            $this->getReference('2')
        );

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


        // Update the user
        $userManager->updateUser($user1, true);
        $userManager->updateUser($user2, true);
        $userManager->updateUser($user3, true);
        $userManager->updateUser($user4, true);
        $userManager->updateUser($user5, true);
        $userManager->updateUser($user6, true);
        $userManager->updateUser($user7, true);
        $userManager->updateUser($user8, true);

    }
    public function getOrder()
    {
        return 4; // ordre d'appel
    }
}