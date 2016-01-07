<?php

namespace Application\Sonata\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class UserCRUDTest extends WebTestCase
{
    protected $id;

    public function getId() {
        return $this->id;
    }

    public function __construct()
    {
        $this->id = uniqid();
    }

    private function connection($client, $username, $password)
    {
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('_submit')->form();

        // set some values
        $form['_username'] = $username;
        $form['_password'] = $password;

        // submit the form
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        return $crawler;
    }

    public function createService($values = array())
    {
        $id = $this->getId();

        $client = static::createClient();
        $crawler = $this->connection($client, 'admin', 'admin');
        $crawler = $client->request('GET', '/admin/iuch/service/create?uniqid='.$id);
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $this->assertEquals('Application\Sonata\AdminBundle\Controller\CRUDController::createAction', $client->getRequest()->attributes->get('_controller'));

        $form = $crawler->selectButton('btn_create_and_list')->form(array_merge(array(
            $id.'[uf]'          =>  '0000',
            $id.'[nom]'          => 'Service',
            $id.'[email]'        => 'service@gmail.com',
            $id.'[telephone]'    => '0606060606'
        ), $values));

        $client->submit($form);

        return $client;
    }

    public function createFonction($values = array())
    {
        $id = $this->getId();

        $client = static::createClient();
        $crawler = $this->connection($client, 'admin', 'admin');
        $crawler = $client->request('GET', '/admin/iuch/service/create?uniqid='.$id);
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $this->assertEquals('Application\Sonata\AdminBundle\Controller\CRUDController::createAction', $client->getRequest()->attributes->get('_controller'));

        $form = $crawler->selectButton('btn_create_and_list')->form(array_merge(array(
            $id.'[nom]'          => 'Fonction'
        ), $values));

        $client->submit($form);

        return $client;
    }

    public function CreateUser($values = array())
    {
        $client = $this->createService();
        $client = $this->createFonction();

        $id = $this->getId();

        $client = static::createClient();
        $this->connection($client, 'admin', 'admin');
        $crawler = $client->request('GET', '/admin/sonata/user/user/create?uniqid='.$id);
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $this->assertEquals('Application\Sonata\AdminBundle\Controller\CRUDController::createAction', $client->getRequest()->attributes->get('_controller'));

        $form = $crawler->selectButton('btn_create_and_list')->form(array_merge(array(
            $id.'[username]'          =>  '111111',
            $id.'[firstname]'         => 'Prénom',
            $id.'[lastname]'          => 'Nom',
            $id.'[date_entree][day]'       => '1',
            $id.'[date_entree][month]'       => '1',
            $id.'[date_entree][year]'       => '2000'
        ), $values));

        $client->submit($form);

        return $client;
    }

    public function testServiceValidCreate()
    {
        $client = $this->createUser();
        $client->followRedirect();

        $this->assertEquals('Application\Sonata\AdminBundle\Controller\CRUDController::listAction', $client->getRequest()->attributes->get('_controller'));

        $kernel = static::createKernel();
        $kernel->boot();
        $em = $kernel->getContainer()->get('doctrine.orm.entity_manager');

        $query = $em->createQuery('SELECT count(u.id) from ApplicationSonataUserBundle:User u WHERE u.username = :username AND u.firstname = :firstname AND u.lastname = :lastname AND u.date_entree = :date_entree');
        $query->setParameter('username', '111111');
        $query->setParameter('firstname', 'Prénom');
        $query->setParameter('lastname', 'Nom');
        $query->setParameter('date_entree', '2000-01-01');
        $this->assertTrue(0 < $query->getSingleScalarResult());
    }

    /*public function testServiceInvalidCreate()
    {
        $id = $this->getId();

        $client = $this->createService(array($id.'[uf]' => 'plop', $id.'[email]' => 'service', $id.'[telephone]' => 'diojefoijo'));
        $crawler = $client->getCrawler();

        $this->assertEquals('Application\Sonata\AdminBundle\Controller\CRUDController::createAction',
            $client->getRequest()->attributes->get('_controller'));

        $this->assertGreaterThan(0, $crawler->filter('html:contains("Veuillez rentrer un uf valide (4 chiffres)")')->count());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Veuillez rentrer un email valide.")')->count());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Veuillez rentrer un numéro de téléphone valide.")')->count());
    }*/

    /*public function testDeleteService()
    {
        $client = $this->createService(array($this->getId().'[uf]' => '4321', $this->getId().'[nom]' => 'plop'));
        $client->followRedirect();

        $crawler = $client->getCrawler();

        $link = $crawler
            ->filter('td:contains("plop")')
            ->siblings()
            ->eq(5)
            ->children()
            ->children()
            ->eq(2)
            ->link();
        ;

        // and click it
        $crawler = $client->click($link);

        $this->assertEquals('Application\Sonata\AdminBundle\Controller\CRUDController::deleteAction', $client->getRequest()->attributes->get('_controller'));

        $form = $crawler->selectButton('Oui, supprimer')->form();
        $client->submit($form);

        $kernel = static::createKernel();
        $kernel->boot();
        $em = $kernel->getContainer()->get('doctrine.orm.entity_manager');

        $query = $em->createQuery('SELECT count(s.id) from IuchBundle:Service s WHERE s.nom = :nom');
        $query->setParameter('nom', 'plop');
        $this->assertTrue(0 == $query->getSingleScalarResult());
    }*/
}
