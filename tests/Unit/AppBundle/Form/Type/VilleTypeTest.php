<?php
// tests/AppBundle/Form/Type/TestedTypeTest.php
namespace Tests\Unit\AppBundle\Form\Type;

use AppBundle\Entity\Pays;
use AppBundle\Entity\Ville;
use AppBundle\Form\PaysType;
use AppBundle\Form\VilleType;
use Symfony\Component\Form\Test\TypeTestCase;

class VilleTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $paysFrance = new Pays();
        $paysFrance->setNom('titi');
        $formData = array(
            'nom' => 'toto',
            'code_postal' => 12345,
            'pays' => $paysFrance
        );

        $objectToCompare = new Ville();
        // $objectToCompare will retrieve data from the form submission; pass it as the second argument
        $form = $this->factory->create(VilleType::class, $objectToCompare);

        $object = new Ville();
        $object->setNom($formData['nom']);
        $object->setCodePostal($formData['code_postal']);
        $object->setPays($formData['pays']);

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