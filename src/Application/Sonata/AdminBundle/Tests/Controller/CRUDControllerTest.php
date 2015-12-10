<?php

namespace Application\Sonata\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;


class CRUDControllerTest extends WebTestCase
{

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

    public function testServiceForm()
    {
        $client = static::createClient();

        $crawler = $this->connection($client, 'testAdmin', 'testAdmin');
        $crawler = $client->request('GET', '/admin/iuch/service/create?uniqid=1201934');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $this->assertEquals('Application\Sonata\AdminBundle\Controller\CRUDController::createAction', $client->getRequest()->attributes->get('_controller'));

        $id = '1201934';

        $form = $crawler->selectButton('Créer')->form();
        // set some values
        $form[$id.'[nom]']          = 'Service';
        $form[$id.'[email]']        ='service@gmail.com';
        $form[$id.'[telephone]']    = '0606060606';

        // submit the form
        $crawler = $client->submit($form);
        $this->assertEquals('Application\Sonata\AdminBundle\Controller\CRUDController::createAction', $client->getRequest()->attributes->get('_controller'));
    }

}
