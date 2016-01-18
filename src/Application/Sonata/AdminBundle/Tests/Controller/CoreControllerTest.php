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

     /*public function testShowAdminDashboard()
     {
         $client = static::createClient();

         $crawler = $this->connection($client, 'admin', 'admin');
         $crawler = $client->request('GET', '/admin/dashboard');
         $this->assertTrue(200 === $client->getResponse()->getStatusCode());
         $this->assertEquals('Sonata\AdminBundle\Controller\CoreController::dashboardAction', $client->getRequest()->attributes->get('_controller'));

         // Testing the aside's links
         $this->assertGreaterThan(0, $crawler->filter('html:contains("Photos")')->count());
         $this->assertGreaterThan(0, $crawler->filter('html:contains("Utilisateurs")')->count());
         $this->assertGreaterThan(0, $crawler->filter('html:contains("Services")')->count());
         $this->assertGreaterThan(0, $crawler->filter('html:contains("Fonctions")')->count());
         $this->assertGreaterThan(0, $crawler->filter('html:contains("Chartes")')->count());
         $this->assertGreaterThan(0, $crawler->filter('html:contains("Chartes signées")')->count());
         $this->assertGreaterThan(0, $crawler->filter('html:contains("Tenues données/rendues")')->count());
         $this->assertGreaterThan(0, $crawler->filter('html:contains("Clés données/rendues")')->count());
         $this->assertGreaterThan(0, $crawler->filter('html:contains("Badge donnés/rendus")')->count());
     }

     public function testShowRHDashboard()
     {
         $client = static::createClient();

         $crawler = $this->connection($client, 'testRH', 'testRH');
         $crawler = $client->request('GET', '/admin/dashboard');
         $this->assertTrue(200 === $client->getResponse()->getStatusCode());
         $this->assertEquals('Sonata\AdminBundle\Controller\CoreController::dashboardAction', $client->getRequest()->attributes->get('_controller'));

         // Testing the aside's links
         $this->assertGreaterThan(0, $crawler->filter('html:contains("Utilisateurs")')->count());
         $this->assertGreaterThan(0, $crawler->filter('html:contains("Services")')->count());
         $this->assertGreaterThan(0, $crawler->filter('html:contains("Fonctions")')->count());
     }

     public function testShowBlanchisserieDashboard()
     {
         $client = static::createClient();

         $crawler = $this->connection($client, 'blanchisserie', 'blanchisserie');
         $crawler = $client->request('GET', '/admin/dashboard');
         $this->assertTrue(200 === $client->getResponse()->getStatusCode());
         $this->assertEquals('Sonata\AdminBundle\Controller\CoreController::dashboardAction', $client->getRequest()->attributes->get('_controller'));

         // Testing the aside's links
         $this->assertGreaterThan(0, $crawler->filter('html:contains("Tenues données/rendues")')->count());
     }

     public function testShowSTDashboard()
     {
         $client = static::createClient();

         $crawler = $this->connection($client, 'services-techniques', 'services-techniques');
         $crawler = $client->request('GET', '/admin/dashboard');
         $this->assertTrue(200 === $client->getResponse()->getStatusCode());
         $this->assertEquals('Sonata\AdminBundle\Controller\CoreController::dashboardAction', $client->getRequest()->attributes->get('_controller'));

         // Testing the aside's links
         $this->assertGreaterThan(0, $crawler->filter('html:contains("Clés données/rendues")')->count());
         $this->assertGreaterThan(0, $crawler->filter('html:contains("Badge donnés/rendus")')->count());
     }

     public function testShowQGDRDashboard()
     {
         $client = static::createClient();

         $crawler = $this->connection($client, 'qualité', 'qualité');
         $crawler = $client->request('GET', '/admin/dashboard');
         $this->assertTrue(200 === $client->getResponse()->getStatusCode());
         $this->assertEquals('Sonata\AdminBundle\Controller\CoreController::dashboardAction', $client->getRequest()->attributes->get('_controller'));

         // Testing the aside's links
         $this->assertGreaterThan(0, $crawler->filter('html:contains("Photos")')->count());
     }*/
}
