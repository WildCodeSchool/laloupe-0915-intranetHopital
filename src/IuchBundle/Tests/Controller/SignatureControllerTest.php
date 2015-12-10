<?php

namespace IuchBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use IuchBundle\Entity\Charte;
use IuchBundle\Entity\Service;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;



class SignatureControllerTest extends WebTestCase
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


    public function testShow()
    {
        $client = static::createClient();

        $this->connection($client, 'erwan', 'erwan');

        $this->assertContains(
            'Erwan',
            $client->getResponse()->getContent()
        );
    }

    public function testEditProfile()
    {
        $client = static::createClient();

        $crawler = $this->connection($client, 'erwan', 'erwan');

        $link = $crawler->selectLink('Erwan')->link();
        $crawler = $client->click($link);
        $link = $crawler->selectLink('Modifier mon profil')->link();
        $crawler = $client->click($link);

        $this->assertEquals('Sonata\UserBundle\Controller\ProfileFOSUser1Controller::editProfileAction', $client->getRequest()->attributes->get('_controller'));

    }

    public function testViewCharte()
    {
        $client = static::createClient();

        $crawler = $this->connection($client, 'erwan', 'erwan');

        $link = $crawler->selectLink('charte2.pdf')->link();
        $crawler = $client->click($link);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function testSignerCharte()
    {
        $client = static::createClient();
        $crawler = $this->connection($client, 'erwan', 'erwan');


        $link = $crawler->selectLink('Signer la charte')->link();
        $crawler = $client->click($link);

        $this->assertEquals('IuchBundle\Controller\SignatureController::SignatureAction', $client->getRequest()->attributes->get('_controller'));
    }



}
