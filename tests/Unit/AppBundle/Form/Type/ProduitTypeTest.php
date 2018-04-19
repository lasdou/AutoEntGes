<?php
// tests/AppBundle/Form/Type/TestedTypeTest.php
namespace Tests\Unit\AppBundle\Form\Type;

use AppBundle\Entity\Pays;
use AppBundle\Entity\Produit;
use AppBundle\Form\PaysType;
use AppBundle\Form\ProduitType;
use Symfony\Component\Form\Test\TypeTestCase;

class ProduitTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'libelle' => 'toto',
            'code' => 'TOT',
            'prix_ht' => 1.25
        );

        $objectToCompare = new Produit();
        // $objectToCompare will retrieve data from the form submission; pass it as the second argument
        $form = $this->factory->create(ProduitType::class, $objectToCompare);

        $object = new Produit();
        $object->setLibelle($formData['libelle']);
        $object->setCode($formData['code']);
        $object->setPrixHt($formData['prix_ht']);

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

    public function testSubmitWrongData()
    {
        $formData = array(
            'libelle' => 'toto',
            'code' => 'TOT',
            'prix_ht' => 'wrong'
        );

        $objectToCompare = new Produit();
        // $objectToCompare will retrieve data from the form submission; pass it as the second argument
        $form = $this->factory->create(ProduitType::class, $objectToCompare);

        $object = new Produit();
        $object->setLibelle($formData['libelle']);
        $object->setCode($formData['code']);
        $object->setPrixHt($formData['prix_ht']);

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        // check that $objectToCompare was modified as expected when the form was submitted
        $this->assertNotEquals($object, $objectToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}