<?php
// tests/AppBundle/Form/Type/TestedTypeTest.php
namespace Tests\Unit\AppBundle\Form\Type;

use AppBundle\Entity\Pays;
use AppBundle\Form\PaysType;
use Symfony\Component\Form\Test\TypeTestCase;

class PaysTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'nom' => 'toto',
        );

        $objectToCompare = new Pays();
        // $objectToCompare will retrieve data from the form submission; pass it as the second argument
        $form = $this->factory->create(PaysType::class, $objectToCompare);

        $object = new Pays();
        $object->setNom($formData['nom']);

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