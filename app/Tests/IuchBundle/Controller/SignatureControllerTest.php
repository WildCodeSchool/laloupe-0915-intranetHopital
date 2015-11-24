<?php

namespace app\Tests\IuchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
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
            'Modifier le profile',
            $client->getResponse()->getContent()
        );
    }

    public function testEditProfile()
    {
        $client = static::createClient();

        $crawler = $this->connection($client, 'erwan', 'erwan');

        $link = $crawler->selectLink('Modifier le profile')->link();
        $crawler = $client->click($link);

        $this->assertEquals('Sonata\UserBundle\Controller\ProfileFOSUser1Controller::editProfileAction', $client->getRequest()->attributes->get('_controller'));

    }




}
