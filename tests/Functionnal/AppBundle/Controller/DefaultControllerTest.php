<?php

namespace Tests\Functionnal\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DefaultControllerTest extends ParentController
{
    public function testSecuredHello()
    {
        $this->logIn();
        $crawler = $this->client->request('GET', '/accueil');

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        $this->assertStringContainsString('Home page', $crawler->filter('h1')->text());
    }

    public function testLoginForm()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertStringContainsString('Identification', $crawler->filter('div.card-header')->text());

    }

    public function testLoginFormWithValidCredentials()
    {
        $crawler = $this->client->request('GET', '/');

        $form = $crawler->selectButton('Login')->form(array(
            '_username'  => 'admin',
            '_password'  => 'password',
        ));

        $crawler = $this->client->submit($form);

        $this->assertRegExp('/\/accueil/', $this->client->getRequest()->getUri());
        $this->assertContains('Home page', $crawler->filter('h1')->text());
    }

    public function testLoginFormWithWrongCredentials()
    {
        $crawler = $this->client->request('GET', '/');

        $form = $crawler->selectButton('Login')->form(array(
            '_username'  => 'admin',
            '_password'  => 'wrong_password',
        ));

        $crawler = $this->client->submit($form);

        $this->assertContains('Invalid credentials.', $crawler->filter('.alert-danger')->text());
    }


}
