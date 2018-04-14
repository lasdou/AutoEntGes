<?php
// tests/AppBundle/Form/Type/TestedTypeTest.php
namespace Tests\Unit\AppBundle\Form\Type;

use AppBundle\Entity\Civilite;
use AppBundle\Entity\Client;
use AppBundle\Entity\Pays;
use AppBundle\Form\CiviliteType;
use AppBundle\Form\ClientType;
use AppBundle\Form\PaysType;
use Symfony\Component\Form\Test\TypeTestCase;

class ClientTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'nom' => 'toto',
            'telephone' => '0612345678',
            'email' => 'test@test.net',
        );

        $objectToCompare = new Client();
        // $objectToCompare will retrieve data from the form submission; pass it as the second argument
        $form = $this->factory->create(ClientType::class, $objectToCompare);

        $object = new Client();
        $object->setNom($formData['nom']);
        $object->setEmail($formData['email']);
        $object->setTelephone($formData['telephone']);

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        // check that $objectToCompare was modified as expected when the form was submitted
        $this->assertEquals($object, $objectToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}