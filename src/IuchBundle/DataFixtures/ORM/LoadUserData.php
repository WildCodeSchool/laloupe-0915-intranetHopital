<?php

// src/IuchBundle/DataFixtures/ORM/LoadUserData.php

namespace IuchBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Application\Sonata\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
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
        $user1->setEnabled(true);

        $user2 = $userManager->createUser();
        $user2->setUsername('relation-humaine');
        $user2->setPlainPassword('relation-humaine');
        $user2->setEmail('rh@email.com');
        $user2->setRoles(array('ROLE_RH'));
        $user2->setEnabled(true);

        $user3 = $userManager->createUser();
        $user3->setUsername('lucie');
        $user3->setPlainPassword('lucie');
        $user3->setEmail('lucie@email.com');
        $user3->setRoles(array('ROLE_USER'));
        $user3->setEnabled(true);

        $user4 = $userManager->createUser();
        $user4->setUsername('erwan');
        $user4->setPlainPassword('erwan');
        $user4->setEmail('erwan@email.com');
        $user4->setRoles(array('ROLE_USER'));
        $user4->setEnabled(true);

        $user5 = $userManager->createUser();
        $user5->setUsername('thierry');
        $user5->setPlainPassword('thierry');
        $user5->setEmail('thierry@email.com');
        $user5->setRoles(array('ROLE_USER'));
        $user5->setEnabled(true);

        // Update the user
        $userManager->updateUser($user1, true);
        $userManager->updateUser($user2, true);
        $userManager->updateUser($user3, true);
        $userManager->updateUser($user4, true);
        $userManager->updateUser($user5, true);

    }
}