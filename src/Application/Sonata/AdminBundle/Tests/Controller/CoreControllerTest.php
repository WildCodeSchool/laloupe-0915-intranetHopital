<?php

namespace Application\Sonata\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class CoreControllerTest extends WebTestCase
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

    public function testShowAdminDashboard()
    {
        $client = static::createClient();

        $crawler = $this->connection($client, 'admin', 'admin');
        $crawler = $client->request('GET', '/admin/dashboard');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
        $this->assertEquals('Sonata\AdminBundle\Controller\CoreController::dashboardAction', $client->getRequest()->attributes->get('_controller'));

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Photos")')->count()
        );

    }
}
