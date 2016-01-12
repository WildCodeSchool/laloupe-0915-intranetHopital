<?php

namespace Application\Sonata\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Application\Sonata\UserBundle\Entity\User;


class SecurityFOSUser1ControllerTest extends WebTestCase
{

    public function testShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $this->assertEquals('Sonata\UserBundle\Controller\SecurityFOSUser1Controller::loginAction', $client->getRequest()->attributes->get('_controller'));
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }

    public function testLoginAdmin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('_submit')->form();

        // set some values
        $form['_username'] = 'admin';
        $form['_password'] = 'admin';

        // submit the form
        $crawler = $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect('/admin/dashboard'));
    }

    public function testLoginUser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('_submit')->form();

        // set some values
        $form['_username'] = 'erwan';
        $form['_password'] = 'erwan';

        // submit the form
        $crawler = $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect('/'));
    }

    public function testLoginWrong()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('_submit')->form();

        // set some values
        $form['_username'] = 'lucie';
        $form['_password'] = 'WrongPass';

        // submit the form
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertContains(
            'class="alert alert-danger alert-error"',
            $client->getResponse()->getContent()
        );

    }


    public function testLoginNewUser()
    {
        $client = static::createClient();

        $kernel = static::createKernel();
        $kernel->boot();
        $em = $kernel->getContainer()->get('doctrine.orm.entity_manager');

        $fonction = $em->getRepository('IuchBundle:Fonction')->findOneByNom('testFonction');
        $service = $em->getRepository('IuchBundle:Service')->findOneByNom('testService');

        // On Créé un nouvel utilisateur
        $user = new User();
        $user->setUsername('TestUser');
        $user->setPlainPassword('081187');
        $user->setFonction($fonction);
        $user->setService($service);
        $em->persist($user);
        $em->flush();


        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('_submit')->form();

        // set some values
        $form['_username'] = 'TestUser';
        $form['_password'] = '081187';

        // submit the form
        $crawler = $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect('/logout/change-password'));

        // On kill le nouvel utilisateur
        $em->remove($user);
        $em->flush();
    }
}
