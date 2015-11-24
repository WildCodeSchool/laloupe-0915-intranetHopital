<?php

namespace IuchBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class Charte_utilisateurControllerTest extends WebTestCase
{

    public function testShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $this->assertEquals('Sonata\UserBundle\Controller\SecurityFOSUser1Controller::loginAction', $client->getRequest()->attributes->get('_controller'));
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }

    public function  


}
