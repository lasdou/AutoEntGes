<?php

namespace Tests\Functionnal\AppBundle\Controller;

class PaysControllerTest extends ParentController
{
    public function testCompleteScenario()
    {
        parent::logIn();
        // Create a new entry in the database
        $crawler = $this->client->request('GET', '/pays/');

        //$crawler = $this->client->click($crawler->filter('#paysActionsPaysTest')->selectLink('Editer')->link());

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /pays/");
        $crawler = $this->client->click($crawler->selectLink('Créer un nouveau pays')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Créer')->form(array(
            'appbundle_pays[nom]'  => 'Pays Test',
        ));

        $crawler = $this->client->submit($form);

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Pays Test")')->count(), 'Missing element td:contains("Pays Test")');

        // Edit the entity
        $crawler = $this->client->click($crawler->selectLink('Mettre à jour')->link());

        $form = $crawler->selectButton('modifier')->form(array(
            'appbundle_pays[nom]'  => 'Pays Foo',
        ));

        $crawler = $this->client->submit($form);

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Pays Foo")')->count(), 'Missing element td:contains("Pays Foo")');

        $crawler = $this->client->click($crawler->filter('#paysActionsPaysFoo')->selectLink('Afficher')->link());

        // Delete the entity
        $this->client->submit($crawler->selectButton('Supprimer')->form());

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $this->client->getResponse()->getContent());
    }
}
